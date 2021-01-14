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