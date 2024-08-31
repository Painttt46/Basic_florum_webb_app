<?php
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql = "SELECT user_id from post where id=$_GET[id]";
    $result = $conn->query($sql);
    while($row = $result->fetch()){
    if(!isset($_SESSION["id"]) || ($_SESSION['user_id'] != $row['0'])){
        header("location:index.php");
        die();      
    }
    }
    $conn = null;
    // if(!isset($_SESSION["id"])){        
    //     header("location:index.php");
    //     die();      
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>EditPost</title>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        <?php include "nav.php" ?>
        <div class="row mt-4">
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-8 col-sm-10">
                <?php 
                if(isset($_SESSION['update_post'])){
                    if($_SESSION['update_post'] == 0){
                        echo "<div class='alert alert-danger' > แก้ไขไม่สำเร็จ </div>";
                    }else{
                        echo "<div class='alert alert-success'> แก้ไขเรียบร้อยแล้ว</div>";
                    }
                    unset($_SESSION['update_post']);
                }
                ?>
                <div class="card border-warning">
                    <div class="card-header bg-warning text-white">แก้ไขกระทู้</div>
                    <div class="card-body">
                    <?php 
                                $conn=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
                                $sql = "SELECT title,cat_id,content from post where id=$_GET[id] ";
                                $result = $conn->query($sql); 
                                while($row = $result->fetch()){
                                    
                                ?>
                        <form action="editpost_save.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $_GET['id']; ?>"> 
                            <div class="row">
                                <label class="col-lg-3 col-form-label">หมวดหมู่:</label>
                                <div class="col-lg-9">
                                    <select name="category" class="form-select">
                                        <?php
                                            $conn2=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
                                            $sql2="SELECT * FROM category";
                                            foreach($conn2->query($sql2) as $row2){
                                                if($row2['id'] == $row['1']){
                                                    echo "<option value=$row2[id] selected>$row2[name]</option>";
                                                }else{
                                                    echo "<option value=$row2[id]>$row2[name]</option>";
                                                }
                                            }
                                            
                                            $conn2=null;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label for="topic" class="col-lg-3 col-form-label">หัวข้อ:</label>
                                <div class="col-lg-9">
                                    <input id="topic" type="text" name="topic" class="form-control" value="<?php echo $row[0]; ?>" required >
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label for="content" class="col-lg-3 col-form-label">เนื้อหา:</label>
                                <div class="col-lg-9">
                                    <textarea id="content" name="comment" rows="8" class="form-control" required><?php echo $row[2]; ?></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning btn-sm text-white me-2">
                                    <i class="bi bi-caret-right-square"></i> บันทึกข้อความ</button>
                                </div>
                            </div>
                            <?php $conn = null;} ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
        </div>
    </div>
    <br>
    
</body>
</html>
