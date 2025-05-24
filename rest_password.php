<?php
$conn = mysqli_connect('localhost', 'root', '', 'client_statistics');
$token = $_GET['token'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "UPDATE users SET password=?, reset_token=NULL WHERE reset_token=?");
    mysqli_stmt_bind_param($stmt, "ss", $new_password, $token);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Password has been reset successfully. <a href='login.php'>Login</a>";
    } else {
        echo "Invalid or expired token.";
    }
}
?>

<?php if ($token): ?>
<form method="POST">
    <h2>Reset Password</h2>
    New Password: <input type="password" name="password" required><br><br>
    <button type="submit">Reset Password</button>
</form>
<?php else: ?>
<p>Invalid or missing token.</p>
<?php endif; ?>
