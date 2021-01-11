<?php
    session_start();
    include('./config.php');
    if($_POST){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql  = "SELECT * FROM user WHERE username = '{$username}'";
        $result = $mysqli->query($sql);
        $user = $result -> fetch_assoc();
        $password = md5($password);
        if($user && $user['password'] === $password){
            $_SESSION['user_id'] = $user['id'];
            header('location: profile.php');
        }else{
            echo "<script>alert('กรุณาตรวจสอบชื่อผู้ใช้งานหรือรหัสผ่าน')</script>";
        }
    }
    $mysqli->close();
?>
<form action="login.php" method='post'>
    <h2>เข้าสู่ระบบ</h2>
    <div>
        <label>ชื่อผู้ใช้งาน</label>
        <input type="text" name='username' required>
    </div>
    <div>
        <label>รหัสผ่าน</label>
        <input type="password" name='password' required>
    </div>
    <div>
        <button type='submit'>เข้าสู่ระบบ</button>
    </div>

    <div>
        <a href="register.php">สมัครสมาชิก</a>
    </div>
</form>