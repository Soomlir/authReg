<?php
session_start();
require_once __DIR__ . '/../vendor/classes/User.php';

// В начало auth.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
