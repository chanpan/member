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

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id='myProfile'>
            <div id="profileImage">
                <img src="./image/<?= $image;?>">
            </div>
            <div id='profileText'>
                <div>
                    <div id='profileName'><?= $row['name'];?></div>
                    <div>
                        <label> เบอร์โทรศัพท์:  <?= $row['tel'];?></label>
                    </div>
                    <div>
                        <label> ที่อยู่:  <?= $row['address'];?></label>
                    </div>
                </div>
                <div><br>
                    <a href="editprofile.php?id=<?= $row['id'];?>">แก้ไขโปรไฟล์ </a> | 
                    <a href="changepassword.php?id=<?= $row['id'];?>">เปลี่ยนรหัสผ่าน </a> |
                    <a href="logout.php">ออกจากระบบ </a>
                </div>
            </div>
        </div> 
    </body>
</html>