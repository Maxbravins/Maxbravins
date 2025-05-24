<?php
$conn = mysqli_connect('localhost', 'root', '', 'client_statistics');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16));

    $stmt = mysqli_prepare($conn, "UPDATE users SET reset_token=? WHERE email=?");
    mysqli_stmt_bind_param($stmt, "ss", $token, $email);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $resetLink = "http://localhost/reset_password.php?token=2fb3c16608308bebba6bd1230a08d09e
";
        // Send this link via email in production. For now, just echo it.
        echo "Password reset link: <a href='$resetLink'>$resetLink</a>";
    } else {
        echo "No user found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot password</title>
    <style>
    body {
        text-align: center;
        font-family: 'Arial', sans-serif;
        background-color: #e9ecef;
        margin: 0;
        padding: 0;
    }
    form {
        background-color: #ffffff;
        padding: 30px;
        margin: 50px auto;
        border-radius: 10px;
        width: 350px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    h2 {
        margin-bottom: 20px;
        color: #333333;
    }
    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ced4da;
        border-radius: 5px;
        font-size: 14px;
    }
    input[type="text"]:focus, input[type="password"]:focus {
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }
    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #0056b3;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
        background-color: #007BFF;
    }
    .message {
        margin-top: 15px;
        font-weight: bold;
        color: #007BFF;
    }
</style>
</head>
<body>
    
<form method="POST">
    <h2>Forgot Password</h2>
    Email: <input type="email" name="email" required><br><br>
    <button type="submit">Send Reset Link</button>
</form>
    <div class="message">
        <?php if (isset($resetLink)) echo $resetLink; ?>
    </div>
</body>
</html>