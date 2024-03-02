<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php 
                  $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                  if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                  }else{
                    header("location: users.php");
                  }
                ?>
                <div class="col-3 align-items-center">
                    <a href="users.php" class="back-icon"><i class="fas fa-chevron-left"></i></a>
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="details col-5">
                    <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
                <div class="contact-grouplist col">
                    <a href="./php/deleteContact.php?id_user=<?php echo $_SESSION['unique_id']; ?>&id_other_user=<?php echo $row['unique_id']; ?>"
                        class="del-contact">
                        <i class="fas fa-video"></i>
                    </a>
                    <a href="./php/deleteContact.php?id_user=<?php echo $_SESSION['unique_id']; ?>&id_other_user=<?php echo $row['unique_id']; ?>"
                        class="del-contact">
                        <i class="fas fa-phone"></i>
                    </a>
                    <a href="./php/deleteContact.php?id_user=<?php echo $_SESSION['unique_id']; ?>&id_other_user=<?php echo $row['unique_id']; ?>"
                        class="del-contact">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area" enctype="multipart/form-data">
                <div name="btnFile" id="btnFile" class="BtnFile">
                    <i class="fas fa-smile"></i>
                </div>
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Ketik pesan" autocomplete="off">
                <div name="btnFile" id="btnFile" class="BtnFile">
                    <i class="fas fa-paperclip"></i>
                </div>
                <div name="btnFile" id="btnFile" class="BtnFile">
                    <i class="fas fa-microphone"></i>
                </div>
                <input type="file" name="file" id="file" class="file" style="width: 50px; display: none;">
                <button id="sendBtnChat"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script>
    var btnFile = document.getElementById("btnFile");
    var btnj = document.getElementById("file");
    btnFile.addEventListener('click', function() {
        btnj.click();
    });
    </script>
    <script src="javascript/chat.js"></script>
</body>

</html>