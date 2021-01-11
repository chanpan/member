<?php
    session_start();
    include('./config.php');
    if(!$_SESSION['user_id']){
        header('location: login.php');
    }
    $user_id = $_SESSION['user_id'];
    $sql  = "SELECT * FROM user WHERE id ={$user_id}";
    $user = $mysqli->query($sql)->fetch_assoc();

    if($_POST){
        if(md5($_POST['currentPassword']) != $user['password']){
            echo "<script>alert('รหัสผ่านปัจจุบันไม่ตรงกัน')</script>";
        }else if($_POST['newPassword'] != $_POST['confirmPassword']){
            echo "<script>alert('ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่')</script>";
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
<form action="changepassword.php" method='post'>
 <h2>เปลี่ยนรหัสผ่าน</h2>
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
        <a href="profile.php">ยกเลิก</a>
        <button type='submit'>ยืนยัน</button>
    </div>
</form>