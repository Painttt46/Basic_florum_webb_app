<?php
    session_start();
    $cate = $_POST['category'];
    $topic = $_POST['topic'];
    $comment=$_POST['comment'];
    $post_id=$_POST['post_id'];
    $user_id=$_SESSION['user_id'];

    $conn=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql="UPDATE post SET title='$topic' ,content='$comment' ,cat_id='$cate',post_date=NOW(),user_id='$user_id' where id=$post_id ";
    $query = $conn->exec($sql);
    if($query){
        $_SESSION['update_post'] = 1;
    }else{
        $_SESSION['update_post'] = 0;
    }
    $conn = null;
    header("location:editpost.php?id=$post_id");
    die();
?>
