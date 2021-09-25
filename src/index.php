<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('lib/php_dot_env/vendor/autoload.php');
    
$dotenv = Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

$_SESSION['HOST'] = $_ENV['HOST'];
$_SESSION['DOMAIN'] = $_ENV['DOMAIN'];
$_SESSION['DB_USER'] = $_ENV['DB_USER'];
$_SESSION['DB_PASSWD'] = $_ENV['DB_PASSWD'];
$_SESSION['ROOT_PATH'] = $_ENV['ROOT_PATH'];
?>
<script>
    window.location.replace("pages/index.php");
</script>