<?php
session_start();
require_once __DIR__ . '/../vendor/classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $user = new User($login, $password);

    if ($user->register($login, $password, $confirmPassword)) {
      header("Location: /success");
      exit();
    } else {
      $_SESSION['old_login'] = $login;
      header("Location: /register");
      exit();
    }
  } else {
    $_SESSION['general'] = 'Все поля обязательны для заполнения';
    header("Location: /register");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация</title>
  <link href="../css/base.css" rel="stylesheet" />
  <link href="../css/register.css" rel="stylesheet" />
</head>

<body>
  <header class="header">
    <h1 class="header__title">Регистрация</h1>
  </header>

  <nav class="nav">
    <a href="/" class="nav__link">Главная</a>
    <a href="/about" class="nav__link">О нас</a>
    <a href="/contact" class="nav__link">Контакты</a>
  </nav>

  <main class="content">
    <p class="content__text">Создайте учетную запись для доступа ко всем возможностям сайта</p>

    <form class="reg-form" action="/register" method="post" id="registrationForm">
      <h2 class="reg-form__title">Форма регистрации</h2>

      <div class="reg-form__group">
        <label for="login" class="reg-form__label">Логин</label>
        <input type="text" id="login" name="login" class="reg-form__input" required>
        <span class="reg-form__error" id="loginError">
          <?php
          if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }
          ?>
        </span>
      </div>

      <div class="reg-form__group">
        <label for="password" class="reg-form__label">Пароль</label>
        <input type="password" id="password" name="password" class="reg-form__input" required>
        <span class="reg-form__error" id="passwordError">
          <?php
          if (isset($_SESSION['password'])) {
            echo $_SESSION['password'];
            unset($_SESSION['password']);
          }
          ?>
        </span>
      </div>

      <div class="reg-form__group">
        <label for="confirmPassword" class="reg-form__label">Повторите пароль</label>
        <input type="password" id="confirmPassword" name="confirmPassword" class="reg-form__input" required>
        <span class="reg-form__error" id="confirmPasswordError">
          <?php
          if (isset($_SESSION['confirmPassword'])) {
            echo $_SESSION['confirmPassword'];
            unset($_SESSION['confirmPassword']);
          }
          ?>
        </span>
      </div>

      <button type="submit" class="reg-form__button">Зарегистрироваться</button>

      <a href="/" class="reg-form__link">Уже есть аккаунт? Войти</a>
    </form>
  </main>
</body>

</html>
