<?php
    session_start();
    include('./config.php');
    $errors = [];
    if(!$_SESSION['user_id']){
        header('location: login.php');
    }
    $user_id = $_SESSION['user_id'];
    $sql  = "SELECT * FROM user WHERE id ={$user_id}";
    $user = $mysqli->query($sql)->fetch_assoc();

    if($_POST){
        if(md5($_POST['currentPassword']) != $user['password']){
            array_push($errors,'รหัสผ่านปัจจุบันไม่ตรงกัน');
        }else if($_POST['newPassword'] != $_POST['confirmPassword']){
            array_push($errors,'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่');
        }else{
            $password = md5($_POST['newPassword']);
            $sql  = "UPDATE user SET 
                        password = '{$password}'
                    WHERE id ={$user_id}";
            $result = $mysqli->query($sql);
        echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ');location.href='profile.php';</script>";

        }
        
    } 
    
    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Change Password</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <form action="changepassword.php" method='post' id='formChangePassword'>
            <?php if(!empty($errors)){?>
                <div id="error">
                    <?php foreach($errors as $error){?>
                        <div><?= $error; ?></div>
                    <?php }?>   
                </div>
            <?php }?>
        <div>
            <label>รหัสผ่านปัจจุบัน</label>
            <input type="password" name='currentPassword' required>
        </div>
        <div>
            <label>รหัสผ่านใหม่</label>
            <input type="password" name='newPassword' required>
        </div>
        <div>
            <label>ยืนยันรหัสผ่าน</label>
            <input type="password" name='confirmPassword' required>
        </div>
        <div>
            <button type='submit' id='btnSuccess'>ยืนยัน</button>
            <p><a href="profile.php" >ยกเลิก</a></p>
        </div>
    </form>
    </body>
</html>