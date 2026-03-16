# XSS Lab - Cross-Site Scripting Vulnerability Demo

A deliberately vulnerable PHP web application designed for educational security testing purposes. This lab demonstrates both reflected and stored Cross-Site Scripting (XSS) vulnerabilities in a controlled environment.

## Purpose

This project is created strictly for educational purposes to help security enthusiasts, developers, and students understand:
- What XSS vulnerabilities are
- How they can be exploited
- The importance of proper input validation and output escaping

## Features

### Vulnerabilities Demonstrated

1. **Reflected XSS (index.php)**: 
   - Accepts a "name" parameter via GET and reflects it directly into HTML without sanitization
   - Payload is executed immediately when the page loads

2. **Stored XSS (comments.php)**:
   - Allows users to submit comments via POST
   - Comments are stored in a local file (`comments.txt`)
   - Displayed comments are not escaped, allowing payloads to execute every time the page is loaded

3. **Another Reflected XSS Vector (profile.php)**:
   - Demonstrates reflected XSS via multiple GET parameters ("username" and "bio")
   - Shows how XSS can occur in different contexts

### Secure Coding Practices

While the application is intentionally vulnerable, it also demonstrates proper security practices:
- All inputs are properly sanitized before being stored in files
- Uses `htmlspecialchars()` correctly in all other areas
- No other vulnerabilities (SQLi, CSRF, command injection, etc.) are included

## Installation & Running

### Requirements

- PHP 7.0 or later
- Web server (Apache, Nginx, or PHP built-in server)

### Quick Start

1. **Clone or download** this repository to your local machine
2. **Start the PHP built-in server**:
   ```bash
   cd xss-lab
   php -S localhost:8000
   ```
3. **Access the application**: Open your browser and navigate to `http://localhost:8000`

### Alternative: XAMPP

1. Copy the `xss-lab` folder to your XAMPP `htdocs` directory
2. Start Apache from the XAMPP control panel
3. Access the application at `http://localhost/xss-lab`

## Usage Instructions

### Testing Reflected XSS (index.php)

1. Go to the home page (`http://localhost:8000`)
2. Enter a JavaScript payload in the name field, e.g.:
   ```javascript
   <script>alert('XSS')</script>
   ```
3. Click "Submit" - you should see an alert box

### Testing Stored XSS (comments.php)

1. Navigate to `http://localhost:8000/comments.php`
2. Enter a name and a JavaScript payload as the comment, e.g.:
   ```javascript
   <script>alert('Stored XSS')</script>
   ```
3. Click "Submit Comment"
4. Refresh the page - the alert should appear every time the page loads

### Testing Reflected XSS in Profile (profile.php)

1. Navigate to `http://localhost:8000/profile.php`
2. Enter payloads in either the username or bio fields
3. Click "View Profile" to see the XSS execution

## File Structure

```
xss-lab/
├── index.php          # Home page with reflected XSS
├── comments.php       # Comments system with stored XSS
├── profile.php        # User profile with reflected XSS
├── comments.txt       # File for storing comments
└── style.css          # Basic styling
```

## Vulnerable Lines

The intentionally vulnerable lines are clearly marked with comments in the code:

### index.php (Line 38)
```php
<?php 
// INTENTIONAL REFLECTED XSS VULNERABILITY
// User input is directly echoed without htmlspecialchars()
echo $_GET['name']; 
?>
```

### comments.php (Line 80)
```php
// INTENTIONAL STORED XSS VULNERABILITY
// Comments are displayed without htmlspecialchars()
// This allows XSS payloads to execute when the page is loaded
echo $comment;
```

### profile.php (Lines 43 and 51)
```php
<?php 
// INTENTIONAL REFLECTED XSS VULNERABILITY
// User input is directly echoed without htmlspecialchars()
echo $_GET['username']; 
?>
```

## Fixing XSS Vulnerabilities

To fix the XSS vulnerabilities, you should always escape user input before displaying it in HTML contexts. Here's how to fix each vulnerable line:

```php
// Replace direct echo with htmlspecialchars()
echo htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
```

For more information on preventing XSS attacks, see [OWASP XSS Prevention Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html).

## Disclaimer

This application is **intentionally vulnerable** and should never be deployed on a public server. It is designed for local security testing and educational purposes only. The authors are not responsible for any misuse or damage caused by this application.

## License

MIT License - for educational purposes only.
