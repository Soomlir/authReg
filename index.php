<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Функция для безопасного получения GET-параметров
function getRouteParam(): string
{
  return isset($_GET['page']) ? trim($_GET['page']) : 'main';
}

// Функция для проверки существования файла представления
function viewExists(string $viewName): bool
{
  $viewPath = __DIR__ . '/views/' . $viewName . '.php';
  return file_exists($viewPath);
}

// Функция для рендеринга страницы
function renderPage(string $viewName): void
{
  $viewPath = __DIR__ . '/views/' . $viewName . '.php';

  if (viewExists($viewName)) {
    require_once $viewPath;
  } else {
    // Страница 404
    http_response_code(404);
    require_once __DIR__ . '/views/404.php';
  }
}

// Получаем запрошенную страницу
$page = getRouteParam();

// Рендерим соответствующую страницу
renderPage($page);
