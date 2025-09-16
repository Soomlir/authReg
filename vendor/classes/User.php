<?php
require_once __DIR__ . '/../../config/Database.php';

class User
{
  private $db;
  private $login;
  private $password;
  private $user_id;
  private $is_logged_in;

  public function __construct($login, $password)
  {
    $this->login = $login;
    $this->password = $password;
    $database = Database::getInstance();
    $this->db = $database->getConnection();
  }

  public function login()
  {
    $login = trim($this->login);
    $password = trim($this->password);

    if (empty($login) || empty($password)) {
      echo "<br>Ошибка: пустые поля";
      return false;
    }

    try {
      $stmt = $this->db->prepare("SELECT id, login, password FROM users WHERE login = :login");
      $stmt->bindParam(':login', $login, PDO::PARAM_STR);
      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        $verifyResult = password_verify($password, $user['password']);
        if ($verifyResult) {
          $this->user_id = $user['id'];
          $this->login = $user['login'];
          $this->is_logged_in = true;

          $this->createSession();
          return true;
        } else {
          echo "<br>Пароль НЕ верный!";
        }
      } else {
        echo "<br>Пользователь не найден в БД!";
      }

      return false;
    } catch (PDOException $e) {
      error_log("Login error: " . $e->getMessage());
      echo "<br>Ошибка БД: " . $e->getMessage();
      return false;
    }
  }

  private function createSession(): void
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $_SESSION['user_id'] = $this->user_id;
    $_SESSION['username'] = $this->login;
    $_SESSION['is_logged_in'] = true;

    session_regenerate_id(true);
  }

  public function logout(): void
  {
    if (session_status() === PHP_SESSION_ACTIVE) {
      session_unset();
      session_destroy();
    }

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
      );
    }

    $this->user_id = null;
    $this->login = null;
    $this->is_logged_in = false;
  }
  public function register($login, $password, $confirmPassword)
  {
    $login = trim($login);
    $password = trim($password);
    $confirmPassword = trim($confirmPassword);

    unset($_SESSION['login'], $_SESSION['password'], $_SESSION['confirmPassword'], $_SESSION['general']);

    $hasErrors = false;

    if (empty($login)) {
      $_SESSION['login'] = 'Логин обязателен';
      $hasErrors = true;
    } elseif (strlen($login) < 3) {
      $_SESSION['login'] = 'Логин должен быть не менее 3 символов';
      $hasErrors = true;
    }

    if (empty($password)) {
      $_SESSION['password'] = 'Пароль обязателен';
      $hasErrors = true;
    } elseif (strlen($password) < 6) {
      $_SESSION['password'] = 'Пароль должен быть не менее 6 символов';
      $hasErrors = true;
    }

    if (empty($confirmPassword)) {
      $_SESSION['confirmPassword'] = 'Подтверждение пароля обязательно';
      $hasErrors = true;
    } elseif ($password !== $confirmPassword) {
      $_SESSION['confirmPassword'] = 'Пароли не совпадают';
      $hasErrors = true;
    }

    if ($hasErrors) {
      return false;
    }

    try {
      $stmt = $this->db->prepare("SELECT id FROM users WHERE login = :login");
      $stmt->bindParam(':login', $login, PDO::PARAM_STR);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $_SESSION['login'] = 'Логин уже занят';
        return false;
      }

      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $this->db->prepare("INSERT INTO users (login, password, created_at) VALUES (:login, :password, NOW())");
      $stmt->bindParam(':login', $login, PDO::PARAM_STR);
      $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

      if ($stmt->execute()) {
        $_SESSION['success'] = 'Регистрация успешна';
        return true;
      } else {
        $_SESSION['general'] = 'Ошибка при регистрации';
        return false;
      }
    } catch (PDOException $e) {
      error_log("Registration error: " . $e->getMessage());
      $_SESSION['general'] = 'Ошибка сервера при регистрации';
      return false;
    }
  }
}
