<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Контакты</title>
  <link href="../css/base.css" rel="stylesheet" />
  <link href="../css/contact.css" rel="stylesheet" />
</head>

<body>
  <header class="header">
    <h1 class="header__title">Свяжитесь с нами</h1>
  </header>

  <nav class="nav">
    <a href="/" class="nav__link">Главная</a>
    <a href="/about" class="nav__link">О нас</a>
    <a href="/contact" class="nav__link">Контакты</a>
  </nav>

  <main class="content">
    <h2 class="content__title">Наши контакты</h2>
    <p class="content__text">Мы всегда рады ответить на ваши вопросы и предложения</p>

    <div class="contacts">
      <div class="contacts__item">
        <h3 class="contacts__title">Адрес</h3>
        <p class="contacts__info">г. Москва, ул. Примерная, д. 123</p>
        <p class="contacts__info">Бизнес-центр "Пример"</p>
      </div>

      <div class="contacts__item">
        <h3 class="contacts__title">Телефон</h3>
        <p class="contacts__info">+7 (495) 123-45-67</p>
        <p class="contacts__info">+7 (800) 123-45-67 (бесплатно)</p>
      </div>

      <div class="contacts__item">
        <h3 class="contacts__title">Email</h3>
        <p class="contacts__info">info@example.com</p>
        <p class="contacts__info">support@example.com</p>
      </div>

      <div class="contacts__item">
        <h3 class="contacts__title">Режим работы</h3>
        <p class="contacts__info">Пн-Пт: 9:00 - 18:00</p>
        <p class="contacts__info">Сб-Вс: выходной</p>
      </div>
    </div>

    <div class="feedback-form">
      <h2 class="feedback-form__title">Форма обратной связи</h2>

      <form action="/send-message" method="post">
        <div class="feedback-form__group">
          <label for="name" class="feedback-form__label">Ваше имя</label>
          <input type="text" id="name" name="name" class="feedback-form__input" required>
        </div>

        <div class="feedback-form__group">
          <label for="email" class="feedback-form__label">Email</label>
          <input type="email" id="email" name="email" class="feedback-form__input" required>
        </div>

        <div class="feedback-form__group">
          <label for="message" class="feedback-form__label">Сообщение</label>
          <textarea id="message" name="message" class="feedback-form__textarea" required></textarea>
        </div>

        <button type="submit" class="feedback-form__button">Отправить сообщение</button>
      </form>
    </div>
  </main>
</body>

</html>
