<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!='a'){
            header("location:index.php");
            die();      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Webboard</title>
    <script>
        function myFunction(){
            let r=confirm("ต้องการจะลบจริงหรือไม่");
            return r;
        }
        function edit_Func(id){
            document.getElementById('cate_id').value = id;
        }
    </script>
</head>
<body>
    <div class="container">
    <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>   

    <?php include "nav.php" ?>
    <div class="mt-3 row">
    <div class="col-lg-3 col-md-2 col-sm-1"></div>
    <div class="col-lg-6 col-md-8 col-sm-10 ">
    <?php  
    if(isset($_SESSION['Status_cate'])){
    if($_SESSION['Status_cate'] == 'add_success'){
        echo "<div class='alert alert-success'>
        เพิ่มหมวดหมู่เรียบร้อยแล้ว</div>";
    }
    else if($_SESSION['Status_cate'] == 'edit_success'){
        echo "<div class='alert alert-success'>
        แก้ไขหมวดหมู่เรียบร้อยแล้ว</div>";
    }
    else if($_SESSION['Status_cate'] == 'delete_success'){
        echo "<div class='alert alert-success'>
        ลบหมวดหมู่เรียบร้อยแล้ว</div>";
    }
      unset($_SESSION['Status_cate']); 
    }
    ?>
    <table class="table table-striped mt-4 "">
        <tr class="text-center">
            <th>ลำดับ</th>
            <th class="text-center" style="width:20rem;">ชื่อหมวดหมู่</th>
            <th class="text-center">จัดการ</th>
        </tr>
        <?php 
        $conn=new PDO("mysql:host=localhost;dbname=webboard;
        charset=utf8","root","");
        $sql = "SELECT * FROM category";
        $result=$conn->query($sql);
        $i = 1; 
        while($row = $result->fetch()){
            echo "<tr class='text-center '>
            <td class='pt-3'>$i</td>
            <td class='pt-3'>$row[name]</td>
            <td class='pt-3 pb-3'>
            <a href=delete_category.php?id=$row[id]  class='btn btn-danger btn-sm me-2 ' onclick='return myFunction()'>
            <i class='bi bi-trash'></i></a>
            <button type='button' onclick=edit_Func('$row[id]') class='btn btn-warning btn-sm me-1' data-bs-toggle='modal' 
                    data-bs-target='#UserModal'><i class='bi bi-pencil-fill'></i></button>                    
            </td>
            </tr>";
            $i += 1;
        }
        $conn = null;
        ?>
    </table>
    <form action="edit_category.php" method="post">
                    <input type="hidden" name="cate_id" id="cate_id">
                    <div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขหมวดหมู่</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">          
                                    <div class="mb-2">
                                        <label for="name" class="col-form-label">ชื่อหมวดหมู่:</label>
                                        <input type="text" class="form-control" id="category" name="category" required>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-toggle='modal' data-bs-target='#UserModal2'><i class="bi bi-bookmark-plus"></i>เพิ่มหมวดหมู่ใหม่</button>
    </div>
    <form action="category_save.php" method="post">
                    <input type="hidden" name="cate_id" id="cate_id">
                    <div class="modal fade" id="UserModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มหมวดหมู่</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">          
                                    <div class="mb-2">
                                        <label for="name" class="col-form-label">ชื่อหมวดหมู่:</label>
                                        <input type="text" class="form-control" id="category_add" name="category_add" required>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    <div class="col-lg-3 col-md-2 col-sm-1"></div>
    </div>
    </div>
    </div>
</body>
</html>
