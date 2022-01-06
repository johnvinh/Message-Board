<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Simple Message Board</title>
</head>
<body>
<div id="content">
    <header>
        <h1>Simple Message Board</h1>
    </header>
    <main>
        <h2>Join the discussion!</h2>
        <form action="index.php" method="post">
            <label for="name">Your Name</label><input type="text" id="name" name="name">
            <label for="message">Your Message</label><input type="text" id="message" name="message">
            <input type="submit">
        </form>
        <table id="posts">
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Message</th>
            </tr>
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

            // Displaying existing messages
            $stmt = $pdo->query('SELECT * FROM posts');
            while ($row = $stmt->fetch()) {
                echo '<tr>';
                echo '<td>' . $row['time'] . '</td>';
                echo '<td>' . $row['user'] . '</td>';
                echo '<td>' . $row['message'] . '</td>';
                echo '</tr>';
            }

            // Close database connection
            $pdo = null;
            ?>
        </table>
    </main>
</div>
</body>
</html>