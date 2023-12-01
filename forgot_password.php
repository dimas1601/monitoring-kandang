
<?php
error_reporting(0);
session_start();
include 'db.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>
    <section>
        <div class="content">
            <div class="form">
                <h2>Forgot Password</h2>
                <form action=""method="POST">
                    <div class="input">
                        <span>Enter Your Email Address</span>
                        <input type="email" name="email" placeholder="Masukkan Email">
                    </div>
                    <div class="tombol">
                        
                        <input type="submit"  name="login" value="Back">
                        <input type="submit" name="btn" value="Next">
                    </div>
                </form>
                
       
                <?php
                if(isset($_POST['login'])){
                    echo '<script>window.location="login.php"</script>';
                }
                if(isset($_POST['btn'])){
                    $email=$_POST['email'];
                    if($email==""){?>
                        <script>
                        swal({
                            icon:"warning",
                            title:"Email Not Found",
                            text:"Email Belum Dimasukkan",
                            button:true
                        })
                    </script>
                  <?php  }else{
                    $user=mysqli_query($conn,"SELECT * FROM data_user where email='".$email."'");
                    $cek_user=mysqli_num_rows($user);
                    $data_user=mysqli_fetch_object($user);
                    if($cek_user>0){        
                        $_SESSION['id']=$data_user->id;
                        $_SESSION['status_pass']=true;
                        $_SESSION['status_password']=2;
                    echo '<script>window.location="update_password.php"</script>';
                                        
                     }else{
                        ?>
                         <script>
                            swal({
                                icon:"error",
                                title:"Email Not Found",
                                text:"Email Tidak Dapat Ditemukan",
                                button:true
                            })
                        </script>
                        <?php
                    }
                    
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