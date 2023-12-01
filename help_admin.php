<?php
error_reporting(0);
session_start();
include "db.php";
if($_SESSION['login'] != true){
	echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring Kandang Ayam Broiler</title>
	<!-- ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- icon google -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="stylesheet" href="assets/style.css">
	<!-- buat grafik -->
    <script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="jquery-latest.js"></script>
	<!-- tabel data user -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> 
  <!-- javascript tabel data user-->
     <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="assets/js/data-user.js"></script> 
    <!-- memanggil data_user grafik -->
    <script type="text/javascript">
        var refreshid = setInterval(function(){
            // buat update data biar realtime
            $('#responsecontainer').load('grafik.php');
            $('#data_sensor').load('klasifikasi.php');
        },1000//waktu 0 detik data ter update//
        );
    </script>
</head>
<body>
	<!-- ALERT -->
	<?php	if($_SESSION['alert'] == true){?>
	<script>
		swal({
			title:"Login Success",
			text:"Anda Berhasil Login",
			icon: "success",
			button:"OK"
		})
	</script>
	
	<?php 
	$_SESSION['alert']=false;
	} ?>
    <!-- SIDEBAR -->
	<section id="sidebar">
		<a href="assets/img/f.jpg" target="_blank"class="brand" style="">
            <img src="assets/img/f.jpg">
			<span class="text">Ayam&nbsp&nbspBroiler</span>
		</a>
		<ul class="side-menu top">
			<li>
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
			<li>
				<button onclick="window.location.href='data_user.php'">
                    <i class='bx bx-user' ></i>
					<span class="text">Data User</span>
				</button>
			</li>
            <li class="active">
				<button onclick="window.location.href='help_admin.php'">
				<i class='bx bx-help-circle' ></i>
					<span class="text">Help</span>
				</button>
			</li>
			<li>
				<button onclick="logout()">
					<i class='bx bx-log-out'></i>
					<span class="text" >Logout</span>
				</button>
				<script>
					function logout(){
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
            <center><h4 class="h4-title">Cara Menggunakan Website</h4></center>
			<div class="help-title"><p>1. Cara Mengunduh Data Uji</p></div>
			<div class="help"><img src="assets/help/9.png" alt=""></div>
            <div class="help-title"><p>2. Cara Menambahkan Data User</p></div>
			<div class="help"><img src="assets/help/8.png" alt=""></div>
            <div class="help-title"><p>3. Cara Mengupdate Data User</p></div>
			<div class="help"><img src="assets/help/10.png" alt=""></div>
            <div class="help-title"><p>4. Cara Menghapus Data User</p></div>
			<div class="help"><img src="assets/help/11.png" alt=""></div>
		</main>
		<!-- MAIN -->
		
	</section>
	<!-- CONTENT -->
	
    <script src="assets/js/script.js"></script>
</body>
</html>