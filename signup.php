<?php echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">' ?>
<?php
  require "db.php";

  $data = $_POST;

  if (isset($data['do_signup'])) {
    $errors = array();

    if (trim($data['login']) == '') {
      $errors[] = 'Введите <strong>логин</strong>!';
    }

    if (trim($data['email']) == '') {
      $errors[] = 'Введите <strong>Email!</strong>';
    }

    if ($data['password'] == '') {
      $errors[] = 'Введите <strong>пароль!</strong>';
    }

    if ($data['password'] != $data['password2']) {
      $errors[] = '<strong>Повторный пароль</strong> введен неверно!';
    }

    if (R::count('users', 'login = ?', array($data['login'])) > 0) {
      $errors[] = 'Пользователь с таким <strong>логином</strong> уже существует!';
    }

    if (R::count('users', 'email = ?', array($data['email'])) > 0) {
      $errors[] = 'Пользователь с таким <strong>Email</strong> уже существует!';
    }

    if (empty($errors)) {
      $user = R::dispense('users');
      $user->login = $data['login'];
      $user->email = $data['email'];
      $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
      R::store($user);
      echo '<div class="alert alert-success" role="alert">Вы успешно зарегестрированы! Можете перейти на <a href="/">главную</a> страницу</div></div>';
    } else {
      echo '<div class="alert alert-danger" role="alert">'.array_shift($errors).'</div>';
    }
  }
?>

<div class="container" style="width: 500px;">
  <form action="/signup.php" method="post">
    <div class="form-group">
      <label for="login">Логин:</label>
      <input class="form-control" type="text" name="login" id="login" value="<?php echo @$data['login'] ?>" placeholder="login">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input class="form-control" type="email" name="email" id="email" value="<?php echo @$data['email'] ?>" placeholder="email">
    </div>
    <div class="form-group">
      <label for="password">Пароль:</label>
      <input class="form-control" type="password" name="password" id="password" value="<?php echo @$data['password'] ?>" placeholder="password">
    </div>
    <div class="form-group">
      <label for="password2">Введите ваш пароль еще раз:</label>
      <input class="form-control" type="password" name="password2" id="password2" value="<?php echo @$data['password2'] ?>" placeholder="password">
    </div>
    <p>
      <button class="btn btn-primary" type="submit" name="do_signup">Зарегистрироваться</button>
      <a class="btn btn-info" href="/">На главную</a>
    </p>
  </form>
</div>
