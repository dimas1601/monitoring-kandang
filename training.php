<?php
error_reporting(0);
session_start();
include "db.php";

date_default_timezone_set('Asia/Kuala_Lumpur');
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
    <title>Data Training</title>
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
<!-- ALERT NOTIFIKASI -->
<!-- WAKTU TRAINING -->
	<?php
		if($_SESSION['training']=="berhasil"){
			$_SESSION['training']="";
	?>
	<script>
		swal({
		title:"Update Success",
		text:"Berhasil Mengupdate Waktu Data Training",
		icon: "success",
		button:"OK"
	})
	</script>
	<?php
		}else if($_SESSION['training']=="gagal"){
			$_SESSION['training']="";
	?>
		<script>
		swal({
		title:"Update Failed",
		text:"Gagal Mengupdate Waktu Data Training",
		icon: "error",
		button:"OK"
	})
	</script>
	<?php
		}else if($_SESSION['training']=="warning"){
			$_SESSION['training']="";
	?>
	<script>
		swal({
		title:"Update Failed",
		text:"Waktu awal lebih besar daripada waktu kedua",
		icon: "warning",
		button:"OK",
		className: "custom-swal-text",
	})
	</script>
	<?php
		}else if($_SESSION['training']=="warning2"){
			$_SESSION['training']="";
	?>
	<script>
		swal({
		title:"Update Failed",
		text:"Waktu awal sama dengan waktu kedua",
		icon: "warning",
		button:"OK",
		className: "custom-swal-text",
	})
	</script>
	<?php
		}
	?>
<!-- WAKTU TRAINING -->

<!-- WAKTU AYAM MASUK -->
	<?php
		if($_SESSION['ayam']=="success"){
		$_SESSION['ayam']="" ?>
		<script>
			swal({
				title:"Update Success",
				text:"Berhasil Mengupdate Tanggal Ayam Masuk",
				icon: "success",
				button:"OK"
			})
		</script>
		<?php }
		else if($_SESSION['ayam']=="gagal"){
			$_SESSION['ayam']=""
	?>
		<script>
			swal({
				title:"Update Failed",
				text:"Gagal Mengupdate Tanggal Ayam Masuk",
				icon: "error",
				button:"OK"
			})
		</script>
		<?php }
		else if($_SESSION['ayam']=="warning"){
			$_SESSION['ayam']=""
		?>
		<script>
			swal({
				title:"Update Failed",
				text:"Waktunya lebih besar daripada waktu sekarang",
				icon: "warning",
				button:"OK"
			})
		</script>
	<?php }
?>
<!-- WAKTU AYAM MASUK -->
<!-- IMPORT CSV -->
	<?php
		if($_SESSION["import"]== "success"){
			$_SESSION["import"]="";
	?>
	<script>
		swal({
			title:"Import Data Success",
			text:"Berhasil menambahkan data training",
			icon: "success",
			button:"OK"
		})
	</script>
	<?php
	}else if($_SESSION["import"]== "gagal"){
		$_SESSION["import"]="";
	?>
	<script>
		swal({
			title:"Import Data Failed",
			text:"Gagal menambahkan data training",
			icon: "error",
			button:"OK"
		})
	</script>
	<?php
	}?>
<!-- IMPORT CSV -->

<!-- HAPUS DATA TRAINING -->
	<?php
		if($_SESSION['hapus']=="success"){
		$_SESSION['hapus']="";?>
		<script>
			swal({
				title:"Hapus Data Success",
				text:"Berhasil menghapus data training",
				icon: "success",
				button:"OK"
			})
		</script>
	<?php	}else if($_SESSION['hapus']=="failed"){
		$_SESSION['hapus']="";
	?>
		<script>
			swal({
				title:"Hapus Data Failed",
				text:"Gagal menghapus data training",
				icon: "error",
				button:"OK"
			})
		</script>
	<?php }else if($_SESSION['hapus']=="warning"){
		$_SESSION['hapus']="";
	?>
		<script>
			swal({
				title:"Hapus Data Failed",
				text:"Waktu awal lebih besar dari pada waktu kedua",
				icon: "warning",
				button:"OK"
			})
		</script>
	<?php
	}else if($_SESSION['hapus']=="warning2"){
		$_SESSION['hapus']="";
	?>
		<script>
			swal({
				title:"Hapus Data Failed",
				text:"Waktu awal sama dengan waktu kedua",
				icon: "warning",
				button:"OK"
			})
		</script>
	<?php
	}?>
<!-- HAPUS DATA TRAINING -->

<!-- ALERT NOTIFIKASI -->
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
			<li>
				<button onclick="window.location.href='profil_user.php'">
                    <i class='bx bx-user' ></i>
					<span class="text">Profil</span>
				</button>
				<!-- <a href="profil_user.php"> -->
				<!-- </a> -->
			</li>
            <li  class="active">
				<button onclick="window.location.href='training.php'">
					<i class='bx bx-data'></i>
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
        <div class="data-training">
			<h2>Setting Data Training & Day Old Chiken</h2>
			<div class="waktu">
                <?php 
                                
                $ayam = mysqli_query($conn, "SELECT * FROM data_ayam");
                $waktuAyam = $ayam->fetch_array();
                $ayamMasuk = $waktuAyam['waktu'];
                $waktuSekarang = new DateTime();
                $waktuSekarang->format("Y-m-d H:i:s");
                
                $ayamMasukObj = new DateTime($ayamMasuk);
                $selisih = $waktuSekarang->diff($ayamMasukObj);
                $umur=$selisih->format("%a Hari");

                $waktu_training = mysqli_query($conn, "SELECT * FROM waktu_training ORDER BY id DESC LIMIT 1");
                $training = mysqli_fetch_array($waktu_training);
                ?>
				
                <p>Waktu Awal : <?php  echo $training['waktu_awal']; ?></p>
            
                
                <p>Waktu Akhir : <?php  echo $training['waktu_akhir']; ?></p>
            
                
                <p>Ayam Masuk :  <?php  echo $ayamMasuk; ?></p>
            
                
                    
                <p>Umur Ayam : <?php  echo $umur; ?></p>
            
               
			</div>	
			<div class="training">
			<form method="POST" action="">
				<label for=""class="title">Waktu Data Training Yang Ditampilkan</label><br>
				<label for="awal">Waktu Awal</label>
				<select name="awal" id="awal">
					<?php
					$a = "SELECT DISTINCT waktu FROM data_training ORDER BY waktu ASC";
					$result = mysqli_query($conn, $a);
					
					if ($result) {
						while ($row = mysqli_fetch_array($result)) {
							$waktu_tanpa_detik = $row['waktu'];
							echo "<option value='$waktu_tanpa_detik'>$waktu_tanpa_detik</option>";
						}
					} else {
						echo "Terjadi kesalahan dalam mengambil data.";
					}
					?>
				</select>
			
			<label for="akhir">Waktu Akhir </label>
			<select name="akhir" id="akhir">
				<?php
                $a = "SELECT DISTINCT waktu FROM data_training ORDER BY waktu ASC";
                $result = mysqli_query($conn, $a);
                
                if ($result) {
                    while ($row = mysqli_fetch_array($result)) {
                        $waktu_tanpa_detik = $row['waktu'];
                        echo "<option value='$waktu_tanpa_detik'>$waktu_tanpa_detik</option>";
                    }
                } else {
                    echo "Terjadi kesalahan dalam mengambil data.";
                }
				?>
			</select>
                <button name="btnTraining">Update</button>
                     
		</form>               
			<?php
		if (isset($_POST['btnTraining'])) {
			// Get the selected start and end times
			$waktu_awal = $_POST['awal'];
			$waktu_akhir = $_POST['akhir'];
			
			// Check if "waktu_awal" is less than or equal to "waktu_akhir"
			if ($waktu_awal < $waktu_akhir) {
				// Specify the condition for the record you want to update (e.g., where id = 9)
				$id_to_update = 9; // Replace this with the desired id value
				
				// Update the record in the database
				$update_query = "UPDATE waktu_training SET waktu_awal = '$waktu_awal', waktu_akhir = '$waktu_akhir' WHERE id = $id_to_update";
				
				if (mysqli_query($conn, $update_query)) {
					$_SESSION["training"]="berhasil";
					echo '<script>window.location="training.php"</script>';
			} else {
					$_SESSION["training"]="gagal";
					echo '<script>window.location="training.php"</script>';
					// echo "Terjadi kesalahan dalam memperbarui data waktu dalam database: " . mysqli_error($conn);
				}
			} else if($waktu_awal > $waktu_akhir) {
				$_SESSION["training"]="warning";
				echo '<script>window.location="training.php"</script>';
				// echo "Waktu awal tidak boleh sama atau lebih besar daripada waktu akhir. Update dibatalkan.";
			} else if($waktu_awal == $waktu_akhir) {
				$_SESSION["training"]="warning2";
				echo '<script>window.location="training.php"</script>';
			}
		}

			?>
			</div>
            <div class="ayam">
			
                <form action="" method="POST">
					
					<label for="" class="title" >Tanggal Ayam Masuk</label><br>
					<div class="form">
						<label>Tanggal Masuk</label>   
						<input type="datetime-local" style="margin-top:10px" name="umur" class="form-control" value="<?php echo $akhirTgl ?>" size="10" required>
						<button name="ayam">Simpan</button>
					</div>
                </form>
				<?php
					if(isset($_POST['ayam'])){
						$ayamMasuk = $_POST['umur'];

						$currentDateTime = new DateTime();
						$waktu = $currentDateTime->format("Y-m-d H:i:s");

						// Extract time part only
						$ayamMasukTime = strtotime($ayamMasuk);
						$waktuTime = strtotime($waktu);

						if ($ayamMasukTime <= $waktuTime) {
							$id=1;
							$update=mysqli_query($conn,"UPDATE data_ayam set waktu='$ayamMasuk' where id='$id'");
							if($update){
								$_SESSION['ayam']="success";
								echo '<script>window.location="training.php"</script>';
							}else{
								$_SESSION['ayam']="gagal";
								echo '<script>window.location="training.php"</script>';
							}
						}else{
							$_SESSION['ayam']="warning";
							echo '<script>window.location="training.php"</script>';
						}
					}
						
				?>
            </div>
			<div class="import">
				<form action="" method="post" enctype="multipart/form-data">
					<label class="title">Import Data Training</label><br>
					<label for="">Upload File (.csv)</label>
					<input class="input" type="file" name="csv_file" accept=".csv" required>
					<button name="import">Import</button>
				</form>
				<?php
				if (isset($_POST['import'])) {
					// Membaca file CSV yang diunggah
					$csvFile = $_FILES['csv_file']['tmp_name'];

					

					// Membuka file CSV
					$handle = fopen($csvFile, "r");

					// Baca baris demi baris dari file CSV
					while (($data = fgetcsv($handle, 2000, ",")) !== false) {
						$suhu = $data[0]; // Gantilah dengan nama kolom sesuai struktur tabel Anda
						$kelembaban = $data[1]; // Gantilah dengan nama kolom sesuai struktur tabel Anda
						$amonia = $data[2]; 
						$kelas = $data[3];
						$waktu = $data[4];
						// Masukkan data ke tabel MySQL (gantilah dengan nama tabel Anda)
						$query = "INSERT INTO data_training (id, suhu,kelembaban,amonia,kelas,waktu) VALUES (null,'$suhu', '$kelembaban', '$amonia', '$kelas', '$waktu')";
						$result = mysqli_query($conn, $query);

						if ($result) {
							// echo "Success";
							$_SESSION['import']="success";
							echo '<script>window.location="training.php"</script>';
							}else{
								$_SESSION['import']="gagal";
								echo "Gagal memasukkan data: " . mysqli_error($conn);
								echo '<script>window.location="training.php"</script>';
							}
					}

					// Tutup file CSV
					fclose($handle);

					// Tutup koneksi database
					mysqli_close($conn);

					
				}
				?>
			</div>
			<div class="hapus">
				<form method="POST" action="">
				<label for="" class="title">Hapus Data Training</label><br>
					<label for="awal">Waktu Awal</label>
					<select name="awal" id="awal">
						<?php
						$a = "SELECT DISTINCT waktu FROM data_training ORDER BY waktu ASC";
						$result = mysqli_query($conn, $a);
						
						if ($result) {
							while ($row = mysqli_fetch_array($result)) {
								$waktu_tanpa_detik = $row['waktu'];
								echo "<option value='$waktu_tanpa_detik'>$waktu_tanpa_detik</option>";
							}
						} else {
							echo "Terjadi kesalahan dalam mengambil data.";
						}
						?>
					</select>
				
				<label for="akhir">Waktu Akhir </label>
				<select name="akhir" id="akhir">
					<?php
					$a = "SELECT DISTINCT waktu FROM data_training ORDER BY waktu ASC";
					$result = mysqli_query($conn, $a);
					
					if ($result) {
						while ($row = mysqli_fetch_array($result)) {
							$waktu_tanpa_detik = $row['waktu'];
							echo "<option value='$waktu_tanpa_detik'>$waktu_tanpa_detik</option>";
						}
					} else {
						echo "Terjadi kesalahan dalam mengambil data.";
					}
					?>
				</select>
					<button class="btn-1" name="hapus">Hapus</button>
						
				</form>               
				<?php
				if (isset($_POST['hapus'])) {
					// Get the selected start and end times
					$start_time = $_POST["awal"];
					$end_time = $_POST["akhir"];
					$dt=mysqli_query($conn,"SELECT * FROM data_training");
					$totalData = mysqli_num_rows($dt);
					
					if($totalData >1 ){
						if ($start_time < $end_time) {
							// Specify the condition for the record you want to update (e.g., where id = 9)
					// Replace this with the desired id value
							
							// Update the record in the database
							$query = "DELETE FROM data_training WHERE waktu between '$start_time' AND '$end_time'";
			
							
							if (mysqli_query($conn, $query)) {
								$_SESSION['hapus']="success";
								echo '<script>window.location="training.php"</script>';
								
								
							} else {
								echo "Terjadi kesalahan dalam memperbarui data waktu dalam database: " . mysqli_error($conn);
								$_SESSION['hapus']="failed";
								echo '<script>window.location="training.php"</script>';
							}
						} else if($start_time > $end_time){
							// echo "Waktu awal tidak boleh sama atau lebih besar daripada waktu akhir. Update dibatalkan.";
							$_SESSION['hapus']="warning";
							echo '<script>window.location="training.php"</script>';
						}else if($start_time == $end_time){
							$_SESSION['hapus']="warning2";
							echo '<script>window.location="training.php"</script>';
						}
					}else{
						$query = "DELETE FROM data_training WHERE waktu = '$start_time' ";
			
							
						if (mysqli_query($conn, $query)) {
							$_SESSION['hapus']="success";
							echo '<script>window.location="training.php"</script>';
							
						} else {
							echo "Terjadi kesalahan dalam memperbarui data waktu dalam database: " . mysqli_error($conn);
							$_SESSION['hapus']="failed";
								echo '<script>window.location="training.php"</script>';
						}

					}
					// Check if "waktu_awal" is less than or equal to "waktu_akhir"
					
				}

					?>
			</div>
		</div>


        <!-- TABEL DATA TRAINING -->
		<div class="tabel">
            <center><div class="tabel-title">Tabel Data Training</div></center>
            <h4>Data Training Tanggal <?php echo $tglAwal ?>  s/d  <?php echo $tglAkhir ?></h4>
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
                     $uji=mysqli_query($conn,"SELECT A.* FROM data_training A $SqlPeriode order by waktu asc");
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
                        <center><a href="training-excel.php?awal=<?php echo $tglAwal ?>&akhir=<?php echo $tglAkhir ?>"><button class="btn btn-primary" style="margin :20px">Export Excel</button></a></center>
 <?php }?>                
            </div>
			

			
			

		</main>
		<!-- MAIN -->
		
	</section>
	<!-- CONTENT -->
	
    <script src="assets/js/script.js"></script>
</body>
</html>