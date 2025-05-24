<?php
$conn = mysqli_connect('localhost', 'root', '', 'client_statistics');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "Registration successful. <a href='login.php'>Login here</a>.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        color: #28a745;
    }
</style>
</head>
<body>
    <form method="POST">
    <h2>Register</h2>
    Username: <input type="text" name="username" required>
    Email: <input type="text" name="email" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
 

</body>
</html>