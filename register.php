<?php
    session_start();
    include('./config.php');
    if(isset($_SESSION['user_id'])){
        header('location: profile.php');
    }
    if($_POST){
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        if($password != $confirmPassword){
            echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
        }else{
            $password = md5($password);
            $sql="
                INSERT INTO user VALUES(null,'{$username}','{$password}','{$name}','{$tel}','{$address}','','')
            ";
            if ($mysqli->query($sql) === TRUE) {
                echo "<script>alert('สมัครสมาชิกสำเร็จ');location.href='login.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        
    }
    $mysqli->close();
?>

<form action="register.php" method='post'>
<h2>สมัครสมาชิก</h2>
    <div>
        <label>ชื่อผู้ใช้งาน</label>
        <input type="text" name='username' required>
    </div>
    <div>
        <label>รหัสผ่าน</label>
        <input type="password" name='password' required>
    </div>
    <div>
        <label>ยืนยันรหัสผ่าน</label>
        <input type="password" name='confirmPassword' required>
    </div>

    <div>
        <label>ชื่อนามสกุล</label>
        <input type="text" name='name' required>
    </div>
    <div>
        <label>ที่อยู่</label>
        <input type="text" name='address' required>
    </div>
    <div>
        <label>เบอร์โทรศัพท์</label>
        <input type="text" name='tel' required>
    </div>
    <div>
        <button type='submit'>ยืนยัน</button>
    </div>
    <div>
        <a href="login.php">หากคุณมีข้อมูลแล้วคลิกที่เข้าสู่ระบบ</a>
    </div>
</form>
