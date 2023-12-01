
<?php
error_reporting(0);
session_start();
include 'db.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>
<?php 
$_SESSION['status']=true;
$_SESSION['status_logout']=$_SESSION['status_logout']+$_SESSION['status'];
$statusInt = (int)$_SESSION['status_logout'];
if($statusInt == 3){?>
	          <script >
                    swal({
                        title:"Logout Success",
                        text:"Anda Berhasil Logout",
                        icon: "success",
                        button:"OK"
                    })

                    
                </script> 
	
	<?php 
	}
    else{

        $_SESSION['status']=0;
        $_SESSION['status_logout']=0;
    } 
    if($_SESSION['status_forgot']=="success"){
                    $_SESSION['status_forgot']="";?>
                <script >
                        swal({
                            title:"Update Success",
                            text:"Update Password Berhasil",
                            icon: "success",
                            button:"OK"
                        })

                        
                    </script> 
        
        <?php 
    } ?> 

    <section>
        <div class="img">
            <img src="assets/img/f.jpg" alt="">
        </div>
        <div class="content">
            <div class="form">
                <h2>Login</h2>
                <form action=""method="POST">
                    <div class="input">
                        <span>Username</span>
                        <input type="email" name="email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="input">
                        <span>Password</span>
                        <input type="password" name="pass" id="password" placeholder="Masukkan Password"required>
                    </div> 
                    <div class="forgot">
                        <a href="forgot_password.php">Forgot Password?</a>
                    </div>
                    <div class="input">
                        <input type="submit" name="login" value="Sign In">
                    </div>
                </form>
                
       
                <?php
                if(isset($_POST['login'])){
                    
                    $email= $_POST['email'];
				    $pass= $_POST['pass'];
            
                    $cek_admin=mysqli_query($conn,"SELECT * FROM data_admin WHERE email='".$email."' AND password='".$pass."'");
                    $cek_user=mysqli_query($conn,"SELECT * FROM data_user WHERE email='".$email."' AND password='".$pass."'");
                    if(mysqli_num_rows($cek_user)>0 || mysqli_num_rows($cek_admin)>0){
                        if(mysqli_num_rows($cek_user)>0){  
                            
                            $data_user=mysqli_fetch_object($cek_user);
                            if(strcmp($email,$data_user->email)==0 and strcmp($pass,$data_user->password)==0 ){
                                $_SESSION['status_login'] = true;
                                $_SESSION['a_global'] = $data_user;
                                $_SESSION['id_user']=$data_user->id;
                                $_SESSION['alert']=true;    
                                echo '<script>window.location="index.php"</script>';
                            } else{?>
                                <script>
                                    swal({
                                    title:"Login Failed",
                                    text:"Username atau Passwword Salah",
                                    icon: "error",
                                    button:"OK"
                                })
                                </script>
                            <?php }

                        }else if(mysqli_num_rows($cek_admin)>0){
                            $data_admin=mysqli_fetch_object($cek_admin);
                            if(strcmp($email,$data_admin->email)==0 and strcmp($pass,$data_admin->password)==0 ){
                                $_SESSION['login'] = true;
                                $_SESSION['alert']=true;
                                echo '<script>window.location="index_admin.php"</script>';
                            } else{?>
                                <script>
                                    swal({
                                    title:"Login Failed",
                                    text:"Username atau Passwword Salah",
                                    icon: "error",
                                    button:"OK"
                                })
                                </script>
                            <?php }
                            
                        }
                    }
                    else{ ?>
                        <script>
                            swal({
                            title:"Login Failed",
                            text:"Username atau Passwword Salah",
                            icon: "error",
                            button:"OK"
                        })
                        </script>
                    <?php }
                    
                }
            ?>
   
            </div>
        </div>
    </section>
  
</body>
</html>