
<?php

error_reporting(0);
session_start();
include 'db.php';
if($_SESSION['status_pass']!=true){
// 	echo '<script>window.location="login.php"</script>';
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <!-- ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>
    <?php
    $_SESSION['status']=true;
    $_SESSION['status_password']=$_SESSION['status_password']+$_SESSION['status'];
    $statusInt = (int)$_SESSION['status_password'];
    if($statusInt == 3){?>
        <script>
            swal({
                icon:"success",
                title:"Email Found",
                text:"Email Berhasil Ditemukan",
                button:true
            })
        </script>
        
        <?php 
        }
        else{

            $_SESSION['status']=0;
            $_SESSION['status_password']=0;
        } ?> 

    <section>
        <div class="content">
            <div class="form">
                <h2>New Password</h2>
                <form action=""method="POST">
                    <div class="input">
                        <span>New Password</span>
                        <input type="text" name="pass" placeholder="Masukkan Password" required>
                    </div>
                    <div class="input">
                        <span>New Confirm Password</span>
                        <input type="text" name="confirm_pass" placeholder="Masukkan Konfirmasi Password" required>
                    </div>
                    <div class="input">
                        <input type="submit" name="btn" value="Change">
                    </div>
                </form>
                
       
                <?php
                if(isset($_POST['btn'])){
                    $pass=$_POST['pass'];
                    $confirm=$_POST['confirm_pass'];
                    if($pass !=$confirm){?>
                     <script>
                            swal({
                                icon:"error",
                                title:"Update Failed",
                                text:"Konfirmasi Password Tidak Sesuai",
                                button:true
                            })
                        </script>
                    <?php
                    }else{
                        $update=mysqli_query($conn,"UPDATE data_user SET
                          password='".$pass."' where id='".$_SESSION['id']."'
                        ");
                        if($update){
                            $_SESSION['status_pass']="";
                            $_SESSION['status_forgot']="success";
                            echo "<script>window.location='login.php'</script>";
                        }else{?>
                        <script>
                            swal({
                                icon:"error",
                                title:"Update Failed",
                                text:"Gagal Mengupdate Password",
                                button:true
                            })
                        </script>
<?php                        }

                    }
                    
                }
            ?>
   
            </div>
        </div>
        <div class="img">
            <img src="assets/img/f.jpg" alt="">
        </div>
    </section>
  
</body>
</html>