<?php
error_reporting(0);
session_start();
include "db.php";
if($_SESSION['status_login'] != true){
	echo '<script>window.location="login.php"</script>';
}
$user=mysqli_query($conn,"SELECT * FROM data_user where id ='".$_SESSION['id_user']."'");
$data_user=mysqli_fetch_object($user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
	<!-- ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- icon google -->
	<link rel="stylesheet" href="assets/style.css">
	<!-- tabel data user -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> 
  <!-- javascript tabel data user-->
     <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="assets/js/data-user.js"></script> 
    
</head>
<body>
<?php 
        $_SESSION['update']=true;
        $_SESSION['status_update']=$_SESSION['status_update']+$_SESSION['update'];
        $updateInt = (int)$_SESSION['status_update'];
        // echo $updateInt;
        if($updateInt == 3){
            $_SESSION['status_update']=0;
            $_SESSION['update']=0;
            ?>
                      <script >
                            swal({
                                title:"Update Success",
                                text:"Update Data Berhasil",
                                icon: "success",
                                button:"OK"
                            })
        
                            
                        </script> 
            
            <?php 
            }
            else if($updateInt == 4){
                $_SESSION['status_update']=0;
                $_SESSION['update']=0;
                ?>
                          <script >
                                swal({
                                    title:"Update Failed",
                                    text:"Format File Tidak Diizinkan",
                                    icon: "error",
                                    button:"OK"
                                })
            
                                
                            </script> 
                <?php 
            }else if($updateInt==5){?>
                <script>
                swal({
                    title:"Update Failed",
                    text:"Image size more than 10MB",
                    icon: "error",
                    button:"OK"
                })
        </script>
        <?php    }
            else{
                $_SESSION['update']=0;
                $_SESSION['status_update']=0;
            } ?> 
    <!-- SIDEBAR -->
	<section id="sidebar">
        <a href="assets/img/f.jpg" target="_blank"class="brand" style="">
            <img src="assets/img/f.jpg">
			<span class="text">Ayam&nbsp&nbspBroiler</span>
		</a>
		<ul class="side-menu top">
        <li>
			<button onclick="window.location.href='index.php'">
				<i class='bx bxs-dashboard' ></i>
				<span class="text">Dashboard</span>	
			</button>
			</li>
			<li>
				<button onclick="window.location.href='histori_user.php'">
					<i class='bx bx-history'></i>
					<span class="text">History</span>
				</button>
				<!-- <a href="histori_user.php"> -->
                    
				<!-- </a> -->
			</li>
			<li  class="active">
				<button onclick="window.location.href='profil_user.php'">
                    <i class='bx bx-user' ></i>
					<span class="text">Profil</span>
				</button>
				<!-- <a href="profil_user.php"> -->
				<!-- </a> -->
			</li>
            <li>
				<button onclick="window.location.href='training.php'">
                    <i class='bx bx-data' ></i>
					<span class="text">Data Training</span>
				</button>
			</li>
            <li>
				<button onclick="window.location.href='help.php'">
				<i class='bx bx-help-circle' ></i>
					<span class="text">Help</span>
				</button>
			</li>
			<li>
				<button onclick="contoh()">
					<i class='bx bx-log-out'></i>
					<span class="text" >Logout</span>
				</button>
				<script>
					function contoh(){
						swal({
							title: "Are You Sure?",
							text: "Are you sure you want to logout",
							icon: "warning",
							buttons: true,
							dangerMode: true,
							})
							.then((willDelete) => {
							if (willDelete) {
								window.location = "logout.php";
							} else {
								// window.location="index.php"
							}
							});
					}
					</script>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->
	
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<b><?php echo ucfirst($data_user->nama_depan)." ".ucfirst($data_user->nama_belakang) ?></b></b>
			<div class="nav-right">
				<a class="profile"href="assets/foto/<?php echo $data_user->foto ?>" target="_blank"><img src="assets/foto/<?php echo $data_user->foto ?>"  ></a>
			
			</div>
			
		</nav>
		<!-- NAVBAR -->

		
		<!-- MAIN -->
		<main>
			<div class="data-profil">
                <div class="profil">
                    <center><div class="profil-title">Profile Settings</div></center>
                    <form action=""method="post" enctype="multipart/form-data" > 
                        
                    <div class="kol">
                        <div class="form-group">
                            <h4 class="labell">First Name</h4>
                            <input type="text" class="input-form" name="nama_depan" placeholder="Masukkan Nama Depan" value="<?php echo ucfirst($data_user->nama_depan) ?>" required>
                        </div>
                        <div class="form-group">
                            <h4 class="labell">Last Name</h4>
                            <input type="text" class="input-form" name="nama_belakang" placeholder="Masukkan Nama Belakang" value="<?php echo ucfirst($data_user->nama_belakang) ?>" required>
                        </div>
                    </div>               
                    <div class="kol">
                        <div class="form-group">
                            <h4 class="labell">Alamat</h4>
                            <input type="text" class="input-form" name="alamat" placeholder="Masukkan Alamat" value="<?php echo ucfirst($data_user->alamat) ?>" required>
                        </div>
                        <div class="form-group">
                            <h4 class="labell">Email</h4>
                            <input type="email" class="input-form" name="email" placeholder="Masukkan Email" value="<?php echo $data_user->email ?>" required>
                        </div>
                    </div>
                    <div class="kol">
                        <div class="form-group">
                            <h4 class="labell">No Handphone</h4>
                            <input type="tel" class="input-form" name="no_hp" placeholder="Masukkan No Handphone" value="<?php echo $data_user->no_hp ?>" required>
                        </div>
                        <div class="form-group">
                            <h4 class="labell">Password</h4>
                            <input  id="password"  class="input-form" name="pass" placeholder="Masukkan Password" value="<?php echo $data_user->password ?>" required>
                        </div>
                    </div> 

                  <div class="kol-1">
                    
                        <div class="gbr">
                            <a href="assets/foto/<?php echo $data_user->foto ?>" target="_blank"><img src="assets/foto/<?php echo $data_user->foto ?>" alt="" ></a>
                        </div>
                        <div class="img">
                            <input type="file" name="gambar" id="file" hidden>
                            <div class="img-area" data-img="">
                                <i style="color:#0C3C78;"class='bx bxs-cloud-upload icon'></i>
                                <h3>Upload Image</h3>
                            </div>
                        <input type="button" class="select-image" value="Select Image">                        
                        </div>
                        <div class="tombol">
                            <button class="btn-1" name="submit">Update</button>
                        </div> 
                       
                    </div>
                    </form> 
                </div>
           
            <?php
                if(isset($_POST['submit'])){
                    $nama_dpn=$_POST['nama_depan'];
                    $nama_belakang=$_POST['nama_belakang'];
                    
                    $alamat=$_POST['alamat'];
                    $email=$_POST['email'];
                    $hp=$_POST['no_hp'];
                    $pass=$_POST['pass'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];
                    $size      =$_FILES['gambar']['size'];
                    
                    // CEK USERNAME
                    $username=mysqli_query($conn,"SELECT * FROM data_user where email='".$email."'");
                    $data_email=mysqli_fetch_object($username);
                    $email_database=$data_email->email;
                    $email_lama=$data_user->email;
                    // ada di database tapi ga sama dengan yang lama
                    if($email==$email_database && $email!=$email_lama){?>
                        <script >
                            swal({
                                title:"Update Failed",
                                text:"Username Sudah Terdaftar",
                                icon: "error",
                                button:"OK"
                            })
                        </script>
                    <?php
                    }else if(strtolower($email)=="admin@gmail.com"){?>
                        <script >
                            swal({
                                title:"Update Failed",
                                text:"Username Sudah Terdaftar",
                                icon: "error",
                                button:"OK"
                            })
                        </script>
                    <?php }
                      // ada di database tapi sama dengan yang lama
                // ga ada di database + ga sama dengan yang lama
                    else{
                    if($filename!=""){
                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'foto'.time().'.'.$type2;

                            
                        // menampung data format file yang diizinkan
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif','JPG','JPEG');

                            // validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                                $namagambar=$data_user->foto;
                                // jika format file tidak ada di dalam tipe diizinkan
                                $_SESSION['status_update']=3;
                                echo '<script>window.location="profil_user.php"</script>';
                                // $kondisi=0;
    
    
                            }else{
                                
                                // size gambar
                                if($size<=10000000){
                                // jika format file sesuai dengan yang ada di dalam arraytipe diizinkan
                                // proses upload file sekaligus insert ke database
                                move_uploaded_file($tmp_name,'./assets/foto/'.$newname);
                                unlink('./assets/foto/'.$data_user->foto);
                                $namagambar=$newname;
                                $update = mysqli_query($conn,"UPDATE data_user SET 
                                nama_depan='".$nama_dpn."',
                                nama_belakang='".$nama_belakang."',
                                email='".$email."',
                                password='".$pass."',
                                no_hp='".$hp."',
                                alamat='".$alamat."',
                                foto='".$namagambar."'
                                WHERE id='".$data_user->id."'");
                            }else{
                                $_SESSION['status_update']=4;
                                echo '<script>window.location="profil_user.php"</script>';
                             }
                            if($update){
                                $_SESSION['status_update']=2;
                                echo '<script>window.location="profil_user.php"</script>';
                             
                            }else{?>
                                <script>
                                    swal({
                                    title:"Update Failed",
                                    text:"Update Data Gagal",
                                    icon: "error",
                                    button:"OK"
                                })
            
                                </script>
                           <?php }
                            }
                       
                       
                    }else{
                        // jika user tidak ganti gambar
                        $namagambar=$data_user->foto;
                        $update = mysqli_query($conn,"UPDATE data_user SET 
                        nama_depan='".$nama_dpn."',
                        nama_belakang='".$nama_belakang."',
                        email='".$email."',
                        password='".$pass."',
                        no_hp='".$hp."',
                        alamat='".$alamat."',
                        foto='".$namagambar."'
                        WHERE id='".$data_user->id."'");
                    if($update){
                        $_SESSION['status_update']=2;
                        echo '<script>window.location="profil_user.php"</script>';
                     
                    }else{?>
                        <script>
                                    swal({
                                    title:"Update Failed",
                                    text:"Update Data Gagal",
                                    icon: "error",
                                    button:"OK"
                                })
            
                                </script>
                   <?php }
                    }
                    
                   
                    // echo '<script>window.location="histori_user.php"</script>';
                }
            }
            ?>
        </div>
        </div>
    </div>
     <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });
       
    </script> 
			

		</main>
		<!-- MAIN -->
		
	</section>
	<!-- CONTENT -->
	
    <script src="assets/js/foto.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>