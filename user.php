<?php
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION['role']!='a'){		
		header("location:index.php");
		die();		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<title>User</title>
    <script>
        function Edit_Function(id,login,name,gender,email,role){
            //alert(id+login+gender+email+role+name);            
            document.getElementById('user_id').value=id;
            document.getElementById('login').value=login;
            document.getElementById('name').value=name.replace(/###/g,' ');
            document.getElementById('gender').value=gender;
            document.getElementById('email').value=email;
            document.getElementById('role').value=role;
        }
    </script>
</head>
<body>
	<div class="container">
    	<h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
    	<?php include "nav.php" ?>
		<div class="row mt-4">
			<div class="col-lg-1 "></div>
			<div class="col-lg-10 "> 
                <?php
                if(isset($_SESSION["edit_user"])){
                    if($_SESSION["edit_user"] == 1){
                        echo "<div class='alert alert-success'>
                        แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว</div>";

                    }
                }

                    if(isset($_SESSION['edituser'])){
						if($_SESSION['edituser']==0){
							echo "<div class='alert alert-danger'>
							การแก้ไขข้อมูลผู้ใช้งานมีปัญหา</div>";
						}else{
							echo "<div class='alert alert-success'>
							แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว</div>";
						}
						unset($_SESSION['edituser']);
					}

				?>
                <table class="table table-striped text-center">
                    <?php 
                    $conn=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
                    $sql="select id,login,name,gender,email,role from user";
                    $result=$conn->query($sql);
                    if ($result->rowCount()>=1){
                        echo "<tr><th style='width: 55px;'>ลำดับ</th><th>ชื่อผู้ใช้</th>
                        <th>ชื่อ-นามสกุล</th><th style='width: 40px;'>เพศ</th><th>อีเมล</th>
                        <th style='width: 40px;'>สิทธิ์</th>
                        <th style='width: 55px;'>จัดการ</th></tr>";
                        $i=1;
                        while($row = $result->fetch()){
                            $str=str_replace(' ','###',$row['2']);                            
                            echo "<tr><td>$i</td><td>$row[1]</td><td>$row[2]</td>
                            <td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>                            
                            <button type='button' onclick=Edit_Function($row[0],'$row[1]','$str','$row[3]','$row[4]','$row[5]') class='btn btn-warning btn-sm me-1' data-bs-toggle='modal' 
                    data-bs-target='#UserModal'><i class='bi bi-pencil-fill'></i></button>                    
                            </td></tr>";
                            $i+=1;
                        }
                    }else{
                        echo "ยังไม่มีผู้ใช้งาน";
                    }
                    $conn=null;

                    ?>

                    
                </table>



                <!-- Modal การแก้ไขข้อมูล -->
                <form action="edituser.php" method="post">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขข้อมูลผู้ใช้</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">        
                                    <div class="mb-2">
                                        <label for="login" class="col-form-label">ชื่อผู้ใช้:</label>
                                        <input type="text" class="form-control" id="login" name="login" disabled>
                                    </div>    
                                    <div class="mb-2">
                                        <label for="name" class="col-form-label">ชื่อ-นามสกุล:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div> 
                                    <div class="mb-2">
                                        <label for="gender" class="col-form-label">เพศ:</label>
                                        <select name="gender" id="gender" class="form-select" required>
                                            <option value="m">ชาย</option>
                                            <option value="f">หญิง</option>
                                            <option value="o">อื่นๆ</option>
                                        </select>
                                    </div> 
                                    <div class="mb-2">
                                        <label for="email" class="col-form-label">อีเมล:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div> 
                                    <div class="mb-2">
                                        <label for="role" class="col-form-label">สิทธิ์:</label>
                                        <select name="role" id="role" class="form-select" required>
                                            <option value="m">Member</option>
                                            <option value="a">Admin</option>
                                            <option value="b">Band</option>
                                        </select>
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


			</div>
			<div class="col-lg-1 "></div>
		</div>
	</div>
	<br>

</body>
</html>