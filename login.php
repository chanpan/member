<?php
    session_start();
    include('./config.php');
    $errors = [];
    if($_POST){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql  = "SELECT * FROM user WHERE username = '{$username}' OR email = '{$username}' ";
        $result = $mysqli->query($sql);
        $user = $result -> fetch_assoc();
        $password = md5($password);
        if($user && $user['password'] === $password){
            $_SESSION['user_id'] = $user['id'];
            header('location: profile.php');
        }else{
            array_push($errors,'กรุณาตรวจสอบชื่อผู้ใช้งานหรือรหัสผ่าน');
        }
    }
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>

    <div class="container">
        <form action="login.php" method='post' id='formLogin'>
            <?php if(!empty($errors)){?>
                <div id="error">
                    <?php foreach($errors as $error){?>
                        <div><?= $error; ?></div>
                    <?php }?>   
                </div>
            <?php }?>
            <div>
                <input type="text" name='username' placeholder='ชื่อผู้ใช้งาน' required='xxx'>
            </div>
            <div>
                <input type="password" name='password' placeholder='รหัสผ่าน' required>
            </div>
            <div>
                <button type='submit' id='btnSuccess'>เข้าสู่ระบบ</button>
            </div>
            <p>
                ยังไม่ได้ลงทะเบียน?<a href="register.php"> สร้างบัญชี</a>
            </p>
        </form>
    </div>

    </body>
</html>

