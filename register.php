<?php
    session_start();
    include('./config.php');
    $errors = [];
    if(isset($_SESSION['user_id'])){
        header('location: profile.php');
    }
    if($_POST){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        if($password != $confirmPassword){
            array_push($errors,'รหัสผ่านไม่ตรงกัน');
        }else{
            //ตรวจสอบ username ซ้ำ
            $sql  = "SELECT * FROM user WHERE username = '{$username}' OR email = '{$email}' ";
            $result = $mysqli->query($sql);
            $user = $result->fetch_assoc();
            if(!empty($user)){
                if($user['username'] == $username){
                    array_push($errors,'ชื่อผู้ใช้งานนี้ถูกใช้งานแล้ว');
                }else if($user['email'] == $email){
                    array_push($errors,'อีเมลนี้ถูกใช้งานแล้ว');
                }
            }else{
                $password = md5($password);
                $sql="
                    INSERT INTO user(email,username,password,name,tel,address)
                    VALUES('{$email}','{$username}','{$password}','{$name}','{$tel}','{$address}')
                ";
                if ($mysqli->query($sql) === TRUE) {
                    echo "<script>alert('สมัครสมาชิกสำเร็จ');location.href='login.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            //
            
        }
        
    }
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <form action="register.php" method='post' id='formRegister'>
            <?php if(!empty($errors)){?>
                <div id="error">
                    <?php foreach($errors as $error){?>
                        <div><?= $error; ?></div>
                    <?php }?>   
                </div>
            <?php }?>
            <div>
                <input type="email" name='email' placeholder='อีเมล' required>
            </div>
            <div>
                <input type="text" name='username' placeholder='ชื่อผู้ใช้งาน' required>
            </div>
            <div>
                <input type="password" name='password' placeholder='รหัสผ่าน' required>
            </div>
            <div>
                <input type="password" name='confirmPassword' placeholder='ยืนยันรหัสผ่าน' required>
            </div>

            <div>
                <input type="text" name='name' placeholder='ชื่อนามสกุล' required>
            </div>
            <div>
                
                <input type="text" name='address' placeholder='ที่อยู่' required>
            </div>
            <div>
                <input type="text" name='tel' placeholder='เบอร์โทรศัพท์' required>
            </div>
            <div>
                <button type='submit' id='btnSuccess'>สมัครสมาชิก</button>
            </div>
            <p>
                หากคุณมีข้อมูลแล้วคลิกที่<a href="login.php">เข้าสู่ระบบ</a>
            </p>
        </form>

    </body>
</html>