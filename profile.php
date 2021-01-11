<?php
    session_start();
    include('./config.php');
    if(!$_SESSION['user_id']){
        header('location: login.php');
    }
    $user_id = $_SESSION['user_id'];
    $sql  = "SELECT * FROM user WHERE id = {$user_id}";
    $result = $mysqli->query($sql);
    $row = $result -> fetch_assoc();
    $mysqli -> close();

    $image = 'img2.png';
    if(isset($row['image1']) && $row['image1'] != ''){
        $image = $row['image1'];
    }
?>

<div>
    <div>
        <img src="./image/<?= $image;?>" style='width:100px'>
    </div>
    <div>
        <a href="editprofile.php?id=<?= $row['id'];?>">แก้ไขโปรไฟล์ </a> | 
        <a href="changepassword.php?id=<?= $row['id'];?>">เปลี่ยนรหัสผ่าน </a> |
        <a href="logout.php">ออกจากระบบ </a>
    </div>
    <div>
        <label>ชื่อผู้ใช้งาน:  <?= $row['username'];?></label>
    </div>
    <div>
        <label>ชื่อนามสกุล:  <?= $row['name'];?></label>
    </div>
    <div>
        <label> เบอร์โทรศัพท์:  <?= $row['tel'];?></label>
    </div>
    <div>
        <label> ที่อยู่:  <?= $row['address'];?></label>
    </div>
</div> 