<?php
require('inc.php');

$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$db = DB_NAME;
$charset = 'utf8mb4';

// Establish database connection
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

if (!isset($_POST))
    exit();

// Make sure the required details are entered before lodging message
if (!isset($_POST['name'] )|| !isset($_POST['message']))
    exit();

$stmt = $pdo->prepare('INSERT INTO posts (time, user, message) VALUES (?, ?, ?)');
$stmt->execute([date('Y-m-d H:i:s'), $_POST['name'], $_POST['message']]);

header("refresh:5;url=index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Message posted!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="content">
    <header>
        <h1>Simple Message Board</h1>
    </header>
    <main>
        <h2>Your message has been posted!</h2>
        <p>You will be redirected back to the message board in 5 seconds.</p>
    </main>
</div>
</body>
</html>