<?php
error_reporting(0);
session_start();
include "db.php";
if($_SESSION['status_login'] != true){
	echo '<script>window.location="login.php"</script>';
}
$user=mysqli_query($conn,"SELECT * FROM data_user where id ='".$_SESSION['id_user']."'");
$data_user=mysqli_fetch_object($user);
$SqlPeriode="";
$awalTgl="";
$akhirTgl="";
$tglAwal="";        
$tglAkhir="";
if(isset($_POST['btnTampil'])){
	$tglAwal=isset($_POST['txtTglAwal']) ? ($_POST['txtTglAwal']):"01-".date('m-Y');
	$tglAkhir=isset($_POST['txtTglAkhir']) ? ($_POST['txtTglAkhir']):date('d-m-Y');

	$SqlPeriode="WHERE A.waktu BETWEEN '".$tglAwal."' AND '".$tglAkhir."'";
}else{
	$awalTgl= "01-".date('m-Y');
	$akhirTgl= date('d-m-Y');
	
	$SqlPeriode="WHERE A.waktu BETWEEN '".$awalTgl."' AND '".$akhirTgl."'";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Data Kandang</title>
	<!-- ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- icon google -->
	<link rel="stylesheet" href="assets/style.css">
	<!-- buat grafik -->
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
			<li  class="active">
				<button onclick="window.location.href='histori_user.php'">
					<i class='bx bx-history'></i>
					<span class="text">History</span>
				</button>
				<!-- <a href="histori_user.php"> -->
                    
				<!-- </a> -->
			</li>
			<li>
				<button onclick="window.location.href='profil_user.php'">
                    <i class='bx bx-user' ></i>
					<span class="text">Profil</span>
				</button>
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
		<div class="tabel">
            <center><div class="tabel-title">Tabel Data Uji</div></center>
            <h4>Data Uji Tanggal <?php echo $tglAwal ?>  s/d  <?php echo $tglAkhir ?></h4>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="form10" target="_SELF">
                <div class="row" style="margin-bottom:20px;margin-top:20px">
                    <div class="col-lg-3">
                        <input type="date" style="margin-top:10px" name="txtTglAwal" class="form-control" value="<?php echo $awalTgl ?>" size="10">
                    </div>
                    <div class="col-lg-3">
                        <input type="date" style="margin-top:10px"name="txtTglAkhir" class="form-control" value="<?php echo $akhirTgl ?>" size="10">
                    </div>
                    <div class="col-lg-3">
                        <input type="submit" style="margin-top:10px" name="btnTampil" class="btn btn-success" value="Tampilkan">
                    </div>  
                </div>
                
                </form>
                <table id="example" class="table table-striped" style="width:100%;">
                <thead>
                    <tr >
                        <th class="text-center">No</th>
                        <th class="text-center">Suhu</th>
                        <th class="text-center">Kelembaban</th>
                        <th class="text-center">Amonia</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                     $uji=mysqli_query($conn,"SELECT A.* FROM data_uji A $SqlPeriode");
                    $no=1;
                        while($data_uji=mysqli_fetch_array($uji)){
                    ?>
                        <tr class="align-middle">
                            <td><?php echo $no ?></td>
                            <td ><?php echo $data_uji['suhu'] ?></td>
                            <td><?php echo $data_uji['kelembaban'] ?></td>
                            <td><?php echo $data_uji['amonia'] ?></td>
                            <td><?php echo $data_uji['kelas'] ?></td>
                            <td><?php echo $data_uji['waktu'] ?></td>
                        </tr>
                    <?php
                    $no++;
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                    if(mysqli_num_rows($uji)>0){?>
                        <center><a href="histori-excel.php?awal=<?php echo $tglAwal ?>&akhir=<?php echo $tglAkhir ?>"><button class="btn btn-primary" style="margin :20px">Export Excel</button></a></center>
 <?php }?>                
            </div>
			

			
			

		</main>
		<!-- MAIN -->
		
	</section>
	<!-- CONTENT -->
	
    <script src="assets/js/script.js"></script>
</body>
</html>