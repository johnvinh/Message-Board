<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Simple Message Board</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="content">
    <header>
        <h1>Simple Message Board</h1>
    </header>
    <main>
        <h2>Join the discussion!</h2>
        <form action="postmessage.php" method="post">
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
            $pdo = null;
            require('dbconnection.php');

            // Displaying existing messages
            $stmt = $pdo->query('SELECT * FROM posts ORDER BY time DESC');
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