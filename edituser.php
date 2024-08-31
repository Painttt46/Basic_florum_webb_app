<?php 
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
    $stmt = $conn->prepare("UPDATE user SET name = :name, gender = :gender, email = :email, role = :role WHERE id = :user_id");
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':role', $_POST['role']);
    $stmt->bindParam(':user_id', $_POST['user_id']);
    $stmt->execute();
    $conn = null;
    $_SESSION['edit_user'] = 1;
    header('location:user.php');
    die();
?>
