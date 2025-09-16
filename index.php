<?php
require_once 'config/Database.php';

$db = Database::getInstance();
$pdo = $db->getConnection();
