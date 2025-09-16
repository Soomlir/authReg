<?php
session_start();
require_once __DIR__ . '/../vendor/classes/User.php';

if (isset($_POST['login']) && isset($_POST['password'])) {
  $login =  trim(htmlspecialchars($_POST['login']));
  $password = trim($_POST['password']);

  $user = new User($login, $password);

  if ($user->login()) {
    header('Location: /cabinet');
    exit;
  } else {
    $_SESSION['error-login'] = "Неверный логин или пароль";
    header('Location: /');
    exit;
  }
}
