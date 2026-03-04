<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Lab - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to XSS Lab</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="comments.php">Comments</a>
            <a href="profile.php">Profile</a>
        </nav>
        
        <div class="content">
            <h2>Reflected XSS Demo</h2>
            <p>This page demonstrates reflected XSS vulnerability.</p>
            
            <form method="GET" action="index.php">
                <label for="name">Enter your name:</label>
                <input type="text" id="name" name="name" placeholder="Your name">
                <button type="submit">Submit</button>
            </form>
            
            <?php if (isset($_GET['name'])): ?>
                <div class="result">
                    <h3>Hello, 
                        <?php 
                        // Fixed XSS vulnerability - user input is escaped with htmlspecialchars()
                        echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8'); 
                        ?>!
                    </h3>
                    <p>This greeting is a reflected XSS vulnerability. Try entering a script tag like:</p>
                    <code><script>alert('XSS')</script></code>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>