<?php
    session_start();
    if (isset($_SESSION['role']) && ($_SESSION['role']=='a' || $_SESSION['role']=='m')){
        $conn=new PDO("mysql:host=localhost;dbname=webboard;
        charset=utf8","root","");
        $sql="DELETE FROM post WHERE id=$_GET[id]";
        $conn->exec($sql);
        $sql="DELETE FROM comment WHERE post_id=$_GET[id]";
        $conn->exec($sql);
        $conn=null;
        header("location:index.php");
        die();
    }else{
        header("location:index.php");
        die();
    }    
?>
