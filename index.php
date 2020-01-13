<?php require "db.php"; ?>
<?php echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">;' ?>

<?php if(isset($_SESSION['logged_user'])) : ?>
  <div class="container mt-4">
    Привет, <?php echo $_SESSION['logged_user']->login; ?>
    <hr>
    <a class="btn btn-success" href="/logout.php">Выйти</a>
  </div>
<?php else : ?>
  <div class="container mt-4">
    <a class="btn btn-primary btn-lg btn-block" href="/login.php">Авторизация</a>
    <a class="btn btn-secondary btn-lg btn-block" href="/signup.php">Зарегистрироваться</a>
  </div>
<?php endif; ?>
