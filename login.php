<?php echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">' ?>
<?php
  require "db.php";

  $data = $_POST;

  if (isset($data['do_login'])) {
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if($user) {
      if(password_verify($data['password'], $user->password)) {
          $_SESSION['logged_user'] = $user;
          echo '<div class="alert alert-success" role="alert">Вы авторизованы. Можете перейти на <a href="/">главную</a> страницу</div>';
      } else {
        $errors[] = 'Неверно введен пароль!';
      }
    } else {
      $errors[] = 'Пользователь с таким логином не найден!';
    }

    if (!empty($errors)) {
      echo '<div class="alert alert-danger" role="alert">'.array_shift($errors).'</div>';
    }
  }
?>

<div class="container" style="width: 500px;">
  <form action="/login.php" method="post">
    <div class="form-group">
      <label for="login">Логин:</label>
      <input class="form-control" type="text" name="login" id="login" value="<?php echo @$data['login'] ?>" placeholder="login">
    </div>
    <div class="form-group">
      <label for="password">Пароль:</label>
      <input class="form-control" type="password" name="password" id="password" value="<?php echo @$data['password'] ?>" placeholder="password">
    </div>
    <p>
      <button class="btn btn-primary" type="submit" name="do_login">Войти</button>
      <a class="btn btn-info" href="/">На главную</a>
    </p>
  </form>
</div>
