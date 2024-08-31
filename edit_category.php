<?php 
    session_start();
    $get_name = $_POST['category'];
    $get_id = $_POST['cate_id'];
    $conn=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql="UPDATE category SET name='$get_name' WHERE id=$get_id";
    $stmt = $conn->prepare("UPDATE category SET name=:name WHERE id=:id");
    $stmt->bindParam(':name', $get_name);
    $stmt->bindParam(':id', $get_id);
    $stmt->execute();
    $conn=null;
    $_SESSION['Status_cate'] = 'edit_success';
    header("location:category.php");
    die();
?>