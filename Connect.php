<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "your_db_name");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect form data
$custName = trim($_POST['custName']);
$custEmail = trim($_POST['custEmail']);
$custPhone = trim($_POST['custPhone']);

// Validation
if (empty($custName) || empty($custEmail) || empty($custPhone)) {
    echo "Error: All fields are mandatory.";
} elseif (!filter_var($custEmail, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Invalid email format.";
} elseif (!preg_match("/^[0-9]{10}$/", $custPhone)) {
    echo "Error: Phone must be 10 digits.";
} else {
    // Prepare SQL query
    $sql = "INSERT INTO Customer (custName, custEmail, custPhone) 
            VALUES ('$custName', '$custEmail', '$custPhone')";
    
    if (mysqli_query($con, $sql)) {
        echo "Record inserted successfully!";
    } else {
        echo "Database Error: " . mysqli_error($con);
    }
}

// Close connection
mysqli_close($con);
?>
