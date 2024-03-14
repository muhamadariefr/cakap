<?php
session_start();
include_once "php/config.php";
// if (!isset($_SESSION['unique_id'])) {
//     header("location: login.php");
// }
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                $sqlMember = mysqli_query($conn, "SELECT u.unique_id, u.fname, u.lname, u.img, u.status, mrg.name AS role
                                  FROM member_group mg
                                  INNER JOIN users u ON u.unique_id = mg.id_user
                                  INNER JOIN master_role_group mrg ON mrg.id = mg.id_role
                                  WHERE mg.id_group = {$_GET['idGroup']}");

                if (mysqli_num_rows($sqlMember) > 0) {
                    $resultArray = [];
                    while ($rowMember = mysqli_fetch_assoc($sqlMember)) {
                        $resultArray[] = $rowMember;
                    }
                } else {
                    header("location: users.php");
                    exit();
                }

                $sqlGroup = mysqli_query($conn, "SELECT g.*, mg.id_role 
                                FROM tbl_groups g
                                INNER JOIN member_group mg ON mg.id_user = {$_SESSION['unique_id']}
                                WHERE g.id = {$_GET['idGroup']}");

                if (mysqli_num_rows($sqlGroup) > 0) {
                    $rowGroup = mysqli_fetch_assoc($sqlGroup);
                } else {
                    header("location: users.php");
                    exit();
                }

                $sqlUser = mysqli_query($conn, "SELECT * FROM member_group
                                                WHERE id_user='{$_SESSION['unique_id']}'
                                                AND id_group='{$_GET['idGroup']}'");

                if (mysqli_num_rows($sqlUser) > 0) {
                    $rowUser = mysqli_fetch_assoc($sqlUser);
                } else {
                    header("location: users.php");
                    exit();
                }
                ?>

                <a href="chatGroup.php?idGroup=<?php echo $_GET['idGroup'] ?>" class="back-icon">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <img src="php/images/<?php echo $rowGroup['img']; ?>" alt="">

                <div class="details">
                    <span>
                        <?php echo $rowGroup['name_group'] ?>
                    </span>
                </div>

            </header>

            <div class="chat-box">
                <?php foreach ($resultArray as $member) { ?>
                <div class="card">
                    <div class="user-img-list">
                        <img src="php/images/<?php echo $member['img']; ?>" alt="">
                    </div>
                    <div class="details">
                        <p style="font-size: 12px"><?php echo $member['unique_id']; ?></p>
                        <p style="font-weight: bold"><?php echo $member['fname']; ?> <strong></strong>
                            <?php echo $member['lname']; ?></p>
                        <p style="font-size: 10px;"><?php echo $member['role']; ?></p>
                    </div>
                    <div class="actions">
                        <?php if ($rowUser["id_role"] == 1) { ?>
                        <a href="php/deleteMember.php?idMember=<?php echo $member['unique_id']; ?>&idGroup=<?php echo $_GET["idGroup"]; ?>"
                            class="action-link"><i class="fas fa-trash-alt"></i></a>
                        <br>
                        <?php if ($member['role'] != 'Admin') { ?>
                        <a href="php/setAdminGroup.php?idMember=<?php echo $member['unique_id']; ?>&idGroup=<?php echo $_GET["idGroup"]; ?>"
                            class="action-link"><i class="fas fa-user-cog"></i></a>
                        <br>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div>

            </div>
        </section>
    </div>
    <script src="javascript/listGroup.js"></script>
</body>

</html>