<?php
include '../includes/user_management.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure all required fields are set and not empty
    if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirm_password"], $_FILES["profile_picture"])) {
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $profile_picture = $_FILES["profile_picture"];

        // Check if any of the fields are empty
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $error = "All fields are required.";
        } 
        // Check if passwords match
        elseif ($password !== $confirm_password) {
            $error = "Passwords do not match.";
        } 
        // Check the profile picture size (max 5MB)
        elseif ($profile_picture['size'] > 5 * 1024 * 1024) {
            $error = "Profile picture size must be less than 5MB.";
        } else {
            // Check if the email already exists in the database
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Email is already taken.";
            } else {
                // Handle file upload
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($profile_picture["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if the file type is valid
                if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                    $error = "Only JPG, JPEG, and PNG files are allowed.";
                } 
                // Try to upload the file
                elseif (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
                    // Hash the password for security
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the new user into the database
                    $stmt = $conn->prepare("INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $username, $email, $hashed_password, $target_file);

                    // Check if the insertion was successful
                    if ($stmt->execute()) {
                        header("Location: ../user_pages/login.php?success=1");
                        exit();
                    } else {
                        $error = "Registration failed. Try again.";
                    }
                } else {
                    $error = "Error uploading profile picture.";
                }
            }
            $stmt->close();
        }
    } else {
        $error = "All fields are required.";
    }
}
?>
