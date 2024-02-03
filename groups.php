<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}

?>

<?php if (isset($SESSION['message'])) { ?>
  <script>
    alert('<?= $SESSION['message'] ?>');
  </script>
<?php } ?>

<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <button type="button" class="" style="border: none; background: transparent; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModalProfile('<?= $row['unique_id'] ?>')">
            <img src="php/images/<?php echo $row['img']; ?>" alt="">
          </button>
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p style="color: #000;"><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="users.php" class="logout">Contact</a>
        <a href="addGroupForm.php?user_id=<?php echo $row['unique_id']; ?>" class="logout">Add Group</a>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Pilih kontak untuk mulai obrolan</span>
        <input type="text" placeholder="Masukan nama kontak...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

  <script src="javascript/group.js"></script>

</body>

</html>