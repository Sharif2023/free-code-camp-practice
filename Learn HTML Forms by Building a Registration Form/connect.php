<?php 

    //collect form data

    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $newPassword = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
    $accountType = $_POST['account-type'];
    $profilePictureUpload = $_POST['file'];
    $age = $_POST['age'] ?? NULL;
    $refferer = $_POST['referrer'];
    $bio = $_POST['bio'];
    $termsAndConditions = isset($_POST['terms-and-conditions']) ? 1: 0; // Convert checkbox to boolean

    //Database Connection

    $conn = new mysqli('localhost', 'root', '', 'registration_form');

    if($conn->connect_error){
        die('Connection failed: '. $conn->connect_error);
    }else{
        //Insert Data into Database
        $sql = "INSERT INTO users (first_name, last_name, email, password, account_type, profile_picture, age, referrer, bio, terms_and_conditions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiisss", $firstName, $lastName, $email, $newPassword, $accountType, $profilePictureUpload, $age, $refferer, $bio, $termsAndConditions);
        $stmt->execute();
        echo "Registration Successful!";
        $stmt->close();
        $conn->close();
    }
?>