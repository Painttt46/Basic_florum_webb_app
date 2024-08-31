<<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role']=='a'){
        $conn=new PDO("mysql:host=localhost;dbname=webboard;
        charset=utf8","root","");
        $sql="DELETE FROM category WHERE id=$_GET[id]";
        $conn->exec($sql);
        $conn=null;
        $_SESSION['Status_cate'] = 'delete_success';
        header("location:category.php");
        die();
        
    }else{
        header("location:category.php");
        die();
    }    
?>
