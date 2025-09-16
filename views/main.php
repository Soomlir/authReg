<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Главная страница</title>
  <link href="../css/base.css" rel="stylesheet" />
  <link href="../css/main.css" rel="stylesheet" />
</head>

<body>
  <header class="header">
    <h1 class="header__title">Добро пожаловать на главную страницу!</h1>
  </header>

  <nav class="nav">
    <a href="/" class="nav__link">Главная</a>
    <a href="/about" class="nav__link">О нас</a>
    <a href="/contact" class="nav__link">Контакты</a>
  </nav>

  <main class="content">
    <p class="content__text">Для доступа к дополнительным возможностям, пожалуйста, авторизуйтесь.</p>

    <form class="auth-form" action="/auth" method="post">
      <h2 class="auth-form__title">Форма авторизации</h2>

      <div class="auth-form__group">
        <label for="login" class="auth-form__label">Логин</label>
        <input type="text" id="login" name="login" class="auth-form__input" required>
        <span class="auth-form__error-login">
          <?php
          if (isset($_SESSION['error-login'])) {
            echo $_SESSION['error-login'];
            unset($_SESSION['error-login']);
          }
          ?>
        </span>
      </div>

      <div class="auth-form__group">
        <label for="password" class="auth-form__label">Пароль</label>
        <input type="password" id="password" name="password" class="auth-form__input" required>
        <span class="auth-form__error-login">
          <?php
          if (isset($_SESSION['error-password'])) {
            echo $_SESSION['error-password'];
            unset($_SESSION['error-password']);
          }
          ?>
        </span>
      </div>

      <button type="submit" class="auth-form__button">Войти</button>
      <a class="auth-form__register" href="/register">Регистрация</a>
    </form>
  </main>
</body>


</html>
