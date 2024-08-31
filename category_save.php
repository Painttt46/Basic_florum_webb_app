<?php
session_start();
$cate=$_POST['category_add'];
$conn=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
$sql="INSERT INTO category (name) VALUES ('$cate')";
$conn->exec($sql);
$conn=null;    
$_SESSION['Status_cate'] = 'add_success';
header("location:category.php");
die();
?>

