<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Успешная регистрация</title>
  <link href="../css/base.css" rel="stylesheet" />
  <link href="../css/success.css" rel="stylesheet" />
</head>

<body>
  <header class="header">
    <h1 class="header__title">Поздравляем с регистрацией!</h1>
  </header>

  <nav class="nav">
    <a href="/" class="nav__link">Главная</a>
    <a href="/about" class="nav__link">О нас</a>
    <a href="/contact" class="nav__link">Контакты</a>
  </nav>

  <main class="content">
    <div class="success-container">
      <div class="success-icon">✓</div>
      <h2 class="success-title">Регистрация завершена успешно!</h2>
      <p class="success-message">
        Благодарим вас за регистрацию на нашем сайте. Теперь вы можете войти в систему
        используя свой логин и пароль, чтобы получить доступ ко всем возможностям сайта.
      </p>

      <a href="/" class="success-button">Перейти на главную</a>

      <p class="login-prompt">
        или <a href="/" class="login-link">войти в систему</a>
      </p>
    </div>
  </main>
</body>

</html>
