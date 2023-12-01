<?php
    error_reporting(0);
    session_start();
    
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data-monitoring-kandang.xls"); 
    include 'db.php';

    if(isset($_GET['awal'])!=null and isset($_GET['akhir'])!=null){        
        $uji=mysqli_query($conn,"SELECT * FROM data_uji where waktu BETWEEN '".$_GET['awal']."' AND '".$_GET['akhir']."'  ");
   

?>

<table border="1" align="center">
    <tr>
        <th width="50">No</th>
        <th width="200">Suhu</th>
        <th width="200">Kelembaban</th>
        <th width="200">Amonia</th>
        <th width="200">Kelas</th>
        <th width="200">Tanggal</th>
</tr>
<?php
    $no=1;
        while($data_uji=mysqli_fetch_array($uji)){
    ?>
        <tr class="align-middle">
            <td align="center"><?php echo $no ?></td>
            <td align="center"><?php echo $data_uji['suhu'] ?></td>
            <td align="center"><?php echo $data_uji['kelembaban'] ?></td>
            <td align="center"><?php echo $data_uji['amonia'] ?></td>
            <td align="center"><?php echo $data_uji['kelas'] ?></td>
            <td align="center"><?php echo $data_uji['waktu'] ?></td>
        </tr>
    <?php
    $no++;
        }
                    ?>
  

</table>
                <!-- <table id="example" class="table table-striped" style="width:100%">
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
                        }
                    ?>
                    </tbody>
                </table>
            </div> -->
         