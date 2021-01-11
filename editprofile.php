<?php
    session_start();
    include('./config.php');
    if(!$_SESSION['user_id']){
        header('location: login.php');
    }
    $currentName = '';
    $image = 'img2.png';
    $user_id = $_SESSION['user_id'];
    if($_POST){
        // var_dump($_FILES);exit();

        if($_FILES['image1']['error'] == 0){
            $target_dir = "image/";
            $fileName = $_FILES["image1"]["name"];
            $typeArr = explode('.',$fileName);
            $currentName = date('YmdHis').'.'.end($typeArr);
            $target_file = $target_dir . basename($currentName);
            if(move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)){}
        }else{
            $currentName = $_SESSION['image1'];
        }
        //var_dump($currentName);exit();
        $sql  = "UPDATE user SET 
                    name = '{$_POST['name']}',
                    address = '{$_POST['address']}',
                    tel='{$_POST['tel']}',  
                    image1='{$currentName}'
                WHERE id ={$user_id}";
        $result = $mysqli->query($sql);
        unset($_SESSION['image1']);
        echo "<script>alert('แก้ไขโปรไฟล์สำเร็จ');location.href='profile.php';</script>";
    }else{
        $sql  = "SELECT * FROM user WHERE id ={$user_id}";
        $result = $mysqli->query($sql);
        $row = $result -> fetch_assoc();
        if(isset($row['image1']) && $row['image1'] != ''){
            $_SESSION['image1'] = '';
            $_SESSION['image1'] = $row['image1'];
            $image = $row['image1'];
        }
    }
    
    $mysqli->close();
?>
<form action="editprofile.php" method='post' enctype="multipart/form-data">
    <img src="./image/<?= $image; ?>" style='width:100px'>
    <div>
        <label>รูปโปรไฟล์</label>
        <input type="file" name='image1'>
    </div>
    <div>
        <label>ชื่อนามสกุล</label>
        <input type="text" name='name' value='<?= $row['name']?>'>
    </div>
    <div>
        <label>ที่อยู่</label>
        <input type="text" name='address' value='<?= $row['address']?>'>
    </div>
    <div>
        <label>เบอร์โทรศัพท์</label>
        <input type="text" name='tel' value='<?= $row['tel']?>'>
    </div>
    <div>
        <button type='submit'>ยืนยัน</button>
    </div>
</form>