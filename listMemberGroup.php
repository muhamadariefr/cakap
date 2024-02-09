<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
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
                                FROM groups g
                                INNER JOIN member_group mg ON mg.id_user = {$_SESSION['unique_id']}
                                WHERE g.id = {$_GET['idGroup']}");

                if (mysqli_num_rows($sqlGroup) > 0) {
                    $rowGroup = mysqli_fetch_assoc($sqlGroup);
                } else {
                    header("location: users.php");
                    exit();
                }
                ?>


                <a href="chatGroup.php?idGroup=<?php echo $_GET['idGroup'] ?>" class="back-icon"><i
                        class="fas fa-arrow-left"></i></a>

                <img src="php/images/<?php echo $rowGroup['img']; ?>" alt="">

                <div class="details">
                    <span>
                        <?php echo $rowGroup['name_group'] ?>
                    </span>
                </div>

            </header>

            <div class="chat-box">
                <ul>
                    <?php
                    foreach ($resultArray as $member) {
                        ?>
                        <li>
                            <?php echo "Unique ID: " . $member['unique_id']; ?><br>
                            <?php echo "First Name: " . $member['fname']; ?><br>
                            <?php echo "Last Name: " . $member['lname']; ?><br>
                            <?php echo "Image: " . $member['img']; ?><br>
                            <?php echo "Status: " . $member['status']; ?><br>
                            <?php echo "Role ID: " . $member['role']; ?><br>
                            -----------------------
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div>

            </div>
        </section>
    </div>
    <script src="javascript/listGroup.js"></script>
</body>

</html>