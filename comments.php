<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Lab - Comments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>XSS Lab - Comments</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="comments.php">Comments</a>
            <a href="profile.php">Profile</a>
        </nav>
        
        <div class="content">
            <h2>Stored XSS Demo</h2>
            <p>This page demonstrates stored XSS vulnerability. Comments are saved to a file.</p>
            
            <form method="POST" action="comments.php">
                <label for="comment">Your comment:</label>
                <textarea id="comment" name="comment" rows="4" placeholder="Enter your comment"></textarea>
                <label for="author">Your name:</label>
                <input type="text" id="author" name="author" placeholder="Your name">
                <button type="submit">Submit Comment</button>
            </form>
            
            <?php
            // Handle comment submission
            if (isset($_POST['comment']) && isset($_POST['author'])) {
                $comment = trim($_POST['comment']);
                $author = trim($_POST['author']);
                
                if (!empty($comment) && !empty($author)) {
                    // Sanitize inputs before storing (prevents injection into the comments file)
                    $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
                    $author = htmlspecialchars($author, ENT_QUOTES, 'UTF-8');
                    
                    $timestamp = date('Y-m-d H:i:s');
                    $entry = "[$timestamp] $author: $comment\n";
                    
                    // Append to comments file
                    file_put_contents('comments.txt', $entry, FILE_APPEND);
                    echo '<p class="success">Comment posted successfully!</p>';
                }
            }
            
            // Display comments
            echo '<h3>Comments:</h3>';
            echo '<div class="comments">';
            
            if (file_exists('comments.txt')) {
                $comments = file('comments.txt');
                foreach ($comments as $comment) {
                    $comment = trim($comment);
                    if (!empty($comment)) {
                        echo '<div class="comment">';
                        
                        // Fixed XSS vulnerability - comments are escaped with htmlspecialchars()
                        echo htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
                        
                        echo '</div>';
                    }
                }
            } else {
                echo '<p>No comments yet.</p>';
            }
            
            echo '</div>';
            ?>
        </div>
    </div>
</body>
</html>