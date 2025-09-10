<?php
require_once 'includes/functions.php';

$message_sent = false;
$error_message = '';

if ($_POST) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        $to = 'info@dollywoodnews.com';
        $email_subject = 'Contact Form: ' . $subject;
        $email_body = "Name: $name\n";
        $email_body .= "Email: $email\n";
        $email_body .= "Subject: $subject\n\n";
        $email_body .= "Message:\n$message";
        
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $email_subject, $email_body, $headers)) {
            $message_sent = true;
            // Clear form data on success
            $_POST = array();
        } else {
            $error_message = 'There was an error sending your message. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Dollywood News</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <link rel="shortcut icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --gold: #d4af37;
            --gold-light: #f4d03f;
            --dark: #000000;
            --dark-gray: #1a1a1a;
            --text-light: #ffffff;
            --text-gray: #cccccc;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-light);
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-gray) 50%, var(--dark) 100%);
            min-height: 100vh;
        }
        
        header {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 9999;
            border-bottom: 2px solid var(--gold);
            box-shadow: 0 4px 30px rgba(212, 175, 55, 0.3);
        }
        
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-light);
        }
        
        .logo img {
            width: 50px;
            height: 50px;
            margin-right: 1rem;
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
        }
        
        .logo-text {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 30px rgba(212, 175, 55, 0.6);
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        
        nav a {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }
        
        nav a:hover {
            color: var(--gold);
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.8);
        }
        
        .content {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(26, 26, 26, 0.8);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        
        h1 {
            color: var(--gold);
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--gold-light);
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 8px;
            color: var(--text-light);
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        input[type="text"]:invalid,
        input[type="email"]:invalid,
        textarea:invalid {
            border-color: #e74c3c;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: var(--dark);
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }
        
        .success-message {
            background: linear-gradient(45deg, #28a745, #34ce57);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .error-message {
            background: linear-gradient(45deg, #dc3545, #e74c3c);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        footer {
            background: rgba(0, 0, 0, 0.9);
            border-top: 2px solid var(--gold);
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
        }
        
        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .footer-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 1rem;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
        }
        
        .footer-text {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .footer-links {
            margin: 1rem 0;
        }
        
        .footer-links a {
            color: var(--gold);
            text-decoration: none;
            margin: 0 1rem;
            font-size: 1rem;
        }
        
        .footer-links a:hover {
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.8);
        }
        
        .footer-copyright {
            color: var(--gold);
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/" class="logo">
                <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News">
                <span class="logo-text">Dollywood News</span>
            </a>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about.php">About</a></li>
                    <li><a href="/contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="content">
        <h1>Contact Us</h1>
        
        <?php if ($message_sent): ?>
            <div class="success-message">
                Thank you for your message! We'll get back to you soon.
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="error-message">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required minlength="2" maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required maxlength="255">
            </div>
            
            <div class="form-group">
                <label for="subject">Subject *</label>
                <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>" required minlength="3" maxlength="200">
            </div>
            
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" required minlength="10" maxlength="2000"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>
            
            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>

    <footer>
        <div class="footer-content">
            <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News" class="footer-logo">
            <p class="footer-text">Your trusted source for all things Dollywood</p>
            <div class="footer-links">
                <a href="/terms.php">Terms of Service</a>
                <a href="/privacy.php">Privacy Policy</a>
            </div>
            <p class="footer-copyright">© 2025 Dollywood News. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>