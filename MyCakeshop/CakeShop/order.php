<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "register");

// Check connection
if(!$con) {
    die("Connection error: " . mysqli_connect_error());
}

// Initialize variables
$name = $email = $address = $phone = '';
$cakeTypes = [];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
    $address = isset($_POST['address']) ? mysqli_real_escape_string($con, $_POST['address']) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($con, $_POST['phone']) : '';
    
    // Process cake selections
    $cakeTypes = isset($_POST['caketype']) ? $_POST['caketype'] : [];
    $cakeTypeString = implode(", ", $cakeTypes);

    // Validate required fields
    if (empty($name) || empty($email) || empty($address) || empty($phone) || empty($cakeTypes)) {
        die("Error: All fields are required and at least one cake must be selected");
    }

    // Prepare the SQL query
    $sql = "INSERT INTO `order` (name, email, address, phonenumber, caketype) 
            VALUES ('$name', '$email', '$address', '$phone', '$cakeTypeString')";

    // Execute the query
    if(mysqli_query($con, $sql)) {
        // Success - redirect back with success parameter
        header("Location: shopNow.html?success=1");
        exit();
    } else {
        // Check for duplicate email error (since email is primary key)
        if(mysqli_errno($con) == 1062) {
            die("Error: This email address has already been used for an order.");
        } else {
            die("Error: " . mysqli_error($con));
        }
    }
} else {
    die("Error: Form not submitted");
}

// Close connection
mysqli_close($con);
?>