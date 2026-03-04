<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Lab - Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>XSS Lab - Profile</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="comments.php">Comments</a>
            <a href="profile.php">Profile</a>
        </nav>
        
        <div class="content">
            <h2>User Profile</h2>
            <p>This page demonstrates another reflected XSS vulnerability.</p>
            
            <form method="GET" action="profile.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="3" placeholder="Your bio"></textarea>
                <button type="submit">View Profile</button>
            </form>
            
            <?php if (isset($_GET['username']) || isset($_GET['bio'])): ?>
                <div class="profile">
                    <h3>User Profile</h3>
                    
                    <?php if (isset($_GET['username'])): ?>
                        <p><strong>Username:</strong> 
                            <?php 
                            // Fixed XSS vulnerability - user input is escaped with htmlspecialchars()
                            echo htmlspecialchars($_GET['username'], ENT_QUOTES, 'UTF-8'); 
                            ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if (isset($_GET['bio'])): ?>
                        <p><strong>Bio:</strong> 
                            <?php 
                            // Fixed XSS vulnerability - user input is escaped with htmlspecialchars()
                            echo htmlspecialchars($_GET['bio'], ENT_QUOTES, 'UTF-8'); 
                            ?>
                        </p>
                    <?php endif; ?>
                    
                    <p>Try injecting scripts into both fields to see how they execute.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>