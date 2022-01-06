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
    </main>
</div>
</body>
</html>