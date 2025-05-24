<?php
// Collect form data
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$message = $_POST['message'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$gender = $_POST['gender'] ?? '';
$date = isset($_POST['inquiry_date']) ? date('Y-m-d', strtotime($_POST['inquiry_date'])) : date('Y-m-d');
$house = isset($_POST['house']) ? implode(", ", $_POST['house']) : '';
$county = $_POST['county'] ?? '';

// Create a connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'client_statistics');

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare the SQL statement
$sql = "INSERT INTO housing_inquiries 
        (first_name, last_name, message, email, phone, inquiry_date, gender, house, county) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

// Bind parameters (all are strings, so we use 'sssssssss')
mysqli_stmt_bind_param($stmt, "sssssssss", 
    $first_name, $last_name, $message, $email, $phone, $date, $gender, $house, $county);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    header("Location: dashboard.php"); // Redirect on success
    exit;
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

