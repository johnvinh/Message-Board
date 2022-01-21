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
        <form action="postmessage.php" method="post" id="form">
            <label for="name">Your Name</label><input type="text" id="name" name="name">
            <label for="message">Your Message</label><input type="text" id="message" name="message">
            <input type="submit" id="submitButton">
        </form>
        <div id="posts">
            <?php
            $pdo = null;
            require('inc/dbconnection.php');

            // Displaying existing messages
            $stmt = $pdo->query('SELECT * FROM posts ORDER BY time DESC');
            while ($row = $stmt->fetch()) {
                echo '<div class="post">';
                // time and user
                echo '<div class="dateauthor">';
                echo '<p>' . $row['time'] . '</p>';
                echo '<p>' . htmlspecialchars($row['user']) . '</p>';
                echo '</div>';
                echo '<div class="message">' . htmlspecialchars($row['message']) . '</div>';
                echo '</div>';
            }

            // Close database connection
            $pdo = null;
            ?>
        </div>
    </main>
</div>
<script type="text/javascript" src="script.js"></script>
</body>
</html>