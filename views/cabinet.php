<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: /');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Личный кабинет</title>
  <link href="../css/base.css" rel="stylesheet" />
  <link href="../css/cabinet.css" rel="stylesheet" />
</head>

<body>
  <header class="header">
    <h1 class="header__title">Личный кабинет</h1>
  </header>

  <nav class="nav">
    <a href="/" class="nav__link">Главная</a>
    <a href="/about" class="nav__link">О нас</a>
    <a href="/contact" class="nav__link">Контакты</a>
    <a href="/logout" class="nav__link" style="color: #e74c3c;">Выйти</a>
  </nav>

  <main class="content">
    <div class="profile">
      <h2 class="profile__name"><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
      <p class="profile__email"><?php echo htmlspecialchars($user['email'] ?? 'user@example.com'); ?></p>
    </div>

    <div class="dashboard">
      <div class="dashboard__card">
        <h3 class="dashboard__card-title">Личная информация</h3>
        <div class="dashboard__info">
          <span class="dashboard__info-label">Дата регистрации:</span>
          <?php echo date('d.m.Y', strtotime($user['created_at'] ?? 'now')); ?>
        </div>
        <div class="dashboard__info">
          <span class="dashboard__info-label">Статус:</span> Активный
        </div>
        <div class="dashboard__info">
          <span class="dashboard__info-label">Последний вход:</span>
          <?php echo date('d.m.Y H:i', strtotime($user['last_login'] ?? 'now')); ?>
        </div>
      </div>

      <div class="dashboard__card">
        <h3 class="dashboard__card-title">Статистика</h3>
        <div class="dashboard__info">
          <span class="dashboard__info-label">Посещений:</span> 24
        </div>
        <div class="dashboard__info">
          <span class="dashboard__info-label">Активность:</span> Высокая
        </div>
        <div class="dashboard__info">
          <span class="dashboard__info-label">На сайте:</span> 15 часов
        </div>
      </div>
    </div>

    <div class="secret-content">
      <h2 class="secret-content__title">Секретный контент</h2>
      <p class="secret-content__text">Добро пожаловать в ваш личный кабинет! Здесь вы найдете эксклюзивную информацию, доступную только авторизованным пользователям.</p>
      <p class="secret-content__text">Мы рады, что вы с нами! Теперь у вас есть доступ к специальным возможностям и закрытым материалам нашего сайта.</p>
    </div>

    <div class="actions">
      <button class="actions__button">Редактировать профиль</button>
      <button class="actions__button">Изменить пароль</button>
      <a href="/logout" class="actions__button actions__button--secondary">Выйти</a>
    </div>
  </main>
</body>

</html>
