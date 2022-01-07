<?php
function output_install()
{
    $page = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Simple Message Board</title>
</head>
<body>
<div id="content">
    <header>
        <h1>Simple Message Board - Install</h1>
    </header>
    <main>
        <p>Enter your MariaDB/MySQL database details below.</p>
        <form action="index.php" method="post">
            <p><label for="db-host">DB Host</label><input type="text" id="db-host" name="db-host"></p>
            <p><label for="db-name">DB Name</label><input type="text" id="db-name" name="db-name"></p>
            <p><label for="db-user">DB User</label><input type="text" id="db-user" name="db-user"></p>
            <p><label for="db-pass">DB Pass</label><input type="text" id="db-pass" name="db-pass"></p>
            <input type="submit" value="Install!">
        </form>
    </main>
</div>
</body>
</html>';
    echo $page;
}

// Make sure the user entered all required values
if (!isset($_POST['db-host']) || !isset($_POST['db-name']) || !isset($_POST['db-user']) || !isset($_POST['db-pass'])) {
    output_install();
    die("Missing DB info! Please try again.");
}

// Establish database connection
$charset = 'utf8mb4';

// Establish database connection
$dsn = "mysql:host={$_POST['db-host']};dbname={$_POST['db-name']};charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
    $pdo = new PDO($dsn, $_POST['db-user'], $_POST['db-pass'], $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$pdo->query("CREATE TABLE posts (time datetime, user varchar(30), message text)");

// Close database connection
$pdo = null;

$config = "<?php
// Database details
const DB_HOST = '{$_POST['db-host']}';
const DB_NAME = '{$_POST['db-name']}';
const DB_USER = '{$_POST['db-user']}';
const DB_PASS = '{$_POST['db-pass']}';";

// Write config data
$config_file = fopen('../inc/config.php', 'w');
fwrite($config_file, $config);
fclose($config_file);

echo '<p>Installation successful!</p>';
die();
