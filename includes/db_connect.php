 <?php
 if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
 require_once __DIR__ . '/../config/config_local.php';
 } else {
 require_once __DIR__ . '/../config/config_infinity.php';
 }