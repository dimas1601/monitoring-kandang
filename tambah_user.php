
<?php
error_reporting(0);
session_start();
include "db.php";
if($_SESSION['login'] != true){
	echo '<script>window.location="login.php"</script>';
}
date_default_timezone_set('Asia/Kuala_Lumpur');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data User</title>
    <!-- ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
    <!-- memanggil data_user grafik -->
    
</head>
<body>
    <!-- SIDEBAR -->
	<section id="sidebar">
		<a href="assets/img/f.jpg" target="_blank"class="brand" style="">
            <img src="assets/img/f.jpg">
			<span class="text">Ayam&nbsp&nbspBroiler</span>
		</a>
		<ul class="side-menu top">
			<li >
			<button onclick="window.location.href='index_admin.php'">
				<i class='bx bxs-dashboard' ></i>
				<span class="text">Dashboard</span>	
			</button>
			</li>
			<li>
				<button onclick="window.location.href='histori_admin.php'">
					<i class='bx bx-history'></i>
					<span class="text">History</span>
				</button>
				<!-- <a href="histori_user.php"> -->
                    
				<!-- </a> -->
			</li>
			<li class="active">
				<button onclick="window.location.href='data_user.php'">
                    <i class='bx bx-user' ></i>
					<span class="text">Data User</span>
				</button>
				<!-- <a href="profil_user.php"> -->
				<!-- </a> -->
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
			
				<b>Admin</b>
			<div class="nav-right">
			
				<a href="#" class="profile">
					<img src="assets/img/yusuf.jpg">
				</a>
			</div>
			
		</nav>
		<!-- NAVBAR -->

		
		<!-- MAIN -->
		<main>
			<div class="data-profil">
                <div class="profil">
                    <center><div class="register-title">Registrasi User</div></center>
                    <form action="" method="post" enctype="multipart/form-data" > 
                        
                    <div class="kol">
                        <div class="form-group">
                            <h4 class="labell">First Name</h4>
                            <input type="text" class="form-input" name="nama_depan" placeholder="Masukkan Nama Depan" required>
                        </div>
                        <div class="form-group">
                            <h4 class="labell">Last Name</h4>
                            <input type="text" class="form-input" name="nama_belakang" placeholder="Masukkan Nama Belakang"  required>
                        </div>
                    </div>               
                    <div class="kol">
                        <div class="form-group">
                            <h4 class="labell">No Handphone</h4>
                            <input type="tel" class="form-input" name="no_hp" placeholder="Masukkan No Handphone"  required>
                        </div>
                        <div class="form-group">
                            <h4 class="labell">Email</h4>
                            <input type="email" class="form-input" name="email" placeholder="Masukkan Email"  required>
                        </div>
                    </div>
                    <div class="kol">
                        <div class="form-group">
                            <h4 class="labell">Password</h4>
                            <input  class="form-input" name="pass" placeholder="Masukkan Password"  required>
                        </div>
                        <div class="form-group">
                            <h4 class="labell">Konfirmasi Password</h4>
                            <input  id="password"  class="form-input" name="confirm_pass" placeholder="Masukkan Konfirmasi Password"  required>
                        </div>
                    </div> 

                    <div class="kol-2">
                        <div class="form-group">
                            <label for="labell">Alamat</label>
                            <textarea name="alamat" id="" placeholder="Masukkan Alamat" required></textarea>
                        </div>
                        <div class="img">
                            <input type="file" name="gambar" id="file" hidden required>
                            <div class="img-area" data-img="">
                                <i style="color:#0C3C78;"class='bx bxs-cloud-upload icon'></i>
                                <h3>Upload Image</h3>
                        </div>
                        <input type="button" class="select-image" value="Select Image">                        
                        </div>
                        <div class="tombol">
                            <button class="btn-1" name="submit">Submit</button>
                        </div> 
                        
                    </div>
                    </form> 
                    <?php
                        if(isset($_POST['submit'])){
                            $code=0;
                            // cek username
                            $username=mysqli_query($conn,"SELECT * FROM data_user WHERE email='".$_POST['email']."'");
                             $cek_username = mysqli_num_rows($username);
                        if($cek_username>0){?>
                            <script >
                                swal({
                                    title:"Register Failed",
                                    text:"Email Sudah Terdaftar",
                                    icon: "error",
                                    button:"OK"
                                })    
                            </script> 
                        <?php }else if(strtolower($_POST['email'])=="admin@gmail.com"){?>
                             <script >
                             swal({
                                 title:"Register Failed",
                                 text:"Email Tidak Boleh Dipakai",
                                 icon: "error",
                                 button:"OK"
                             })    
                         </script> 
                     <?php   }
                        else{
                            // konfirmasi password
                        if($_POST['pass']!=$_POST['confirm_pass']){?>
                        <script >
                            swal({
                                title:"Register Failed",
                                text:"Konfirmasi Password Tidak Sesuai",
                                icon: "error",
                                button:"OK"
                            })    
                        </script> 
                         <?php   }else{
                                // menampung data file yang diupload
                                $filename = $_FILES['gambar']['name'];
                                $tmp_name = $_FILES['gambar']['tmp_name'];
                                $size      =$_FILES['gambar']['size'];

                                $type1 = explode('.', $filename);
                                $type2 = $type1[1];

                                $newname = 'foto'.time().'.'.$type2;

                                // menampung data format file yang diizinkan
                                $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif','JPG','JPEG');
                                // validasi format file
                                if(!in_array($type2, $tipe_diizinkan)){?>
                                  <script >
                                    swal({
                                        title:"Register Failed",
                                        text:"Format File Tidak Diizinkan",
                                        icon: "error",
                                        button:"OK"
                                    })    
                                </script> 
                        <?php
                                    // jika format file tidak ada di dalam tipe diizinkan
                                    // $_SESSION['status_create']=2;
                                    // echo '<script>window.location="tambah_user.php"</script>';
                                }else{
                                    if($size<=10000000){
                                        move_uploaded_file($tmp_name,'./assets/foto/'.$newname);

                                        $insert = mysqli_query($conn,"INSERT INTO data_user VALUES (null,
                                            '".$_POST['nama_depan']."',
                                            '".$_POST['nama_belakang']."',
                                            '".$_POST['email']."',
                                            '".$_POST['pass']."',
                                            '".$_POST['no_hp']."',
                                            '".$_POST['alamat']."',
                                            '".$newname."',
                                            '".date("Y-m-d H:i:s")."'
                                                )");
                                        if($insert){
                                            $_SESSION['status_register']=2;
                                            echo '<script>window.location="data_user.php"</script>';
                                        }else{?>
                                            <script >
                                                swal({
                                                    title:"Register Failed",
                                                    text:"Gagal Menambahkan Data User",
                                                    icon: "error",
                                                    button:"OK"
                                                })    
                                        </script> 
                                       <?php }
                                    }else{?>
                                         <script >
                                            swal({
                                                title:"Register Failed",
                                                text:"Image size more than 10MB",
                                                icon: "error",
                                                button:"OK"
                                            })    
                                      </script> 
                                    <?php }
                                    
                                }
                            }
                        }
                    }
                    ?>
                </div>
</div>

		</main>
		<!-- MAIN -->
		
	</section>
	<!-- CONTENT -->
	
    <script src="assets/js/foto.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>