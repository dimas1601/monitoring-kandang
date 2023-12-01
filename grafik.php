<?php
    include 'db.php';
    // koneksi database
    // baca data dari tabel tb sensor
    // baca id tertinggi
    $id= mysqli_query($conn, "SELECT MAX(ID) FROM data_sensor");
    $data_id= mysqli_fetch_array($id);
    $id_akhir= $data_id['MAX(ID)'];
    $id_awal = $id_akhir-4;
    $tanggal= mysqli_query($conn,"SELECT waktu FROM data_sensor WHERE ID>='$id_awal' and ID<='$id_akhir' ORDER BY id ASC");
    $suhu= mysqli_query($conn,"SELECT suhu FROM data_sensor WHERE ID>='$id_awal' and ID<='$id_akhir' ORDER BY id ASC");
    $kelembaban= mysqli_query($conn,"SELECT kelembaban FROM data_sensor WHERE ID>='$id_awal' and ID<='$id_akhir' ORDER BY id ASC");
    $amonia= mysqli_query($conn,"SELECT amonia FROM data_sensor WHERE ID>='$id_awal' and ID<='$id_akhir' ORDER BY id ASC");
 
?>


<!-- tampilan grafik  -->
<div class="panel panel-primary">

    <div class="panel-body">
        <!-- siapkan canvas untuk grafik -->
        <canvas id="myChart"></canvas>
        <!-- gambar grafik -->
        <script type="text/javascript">
            // baca id canvas tempat grafik
            var canvas = document.getElementById('myChart');
             // letakkan data sensor
            var data={
                // buat sumbu x nya
                labels:[
                    <?php
                        while($data_tanggal= mysqli_fetch_array($tanggal)) {
                            echo '"'.$data_tanggal['waktu'].'",';
                        }   
                    ?>
                ],
                // sumbu y nya
                datasets:[{
                    label:"Suhu",
                    // biar bisa ganti warna
                    fill: false,
                    backgroundColor:"rgba(199, 0, 57,1)",
                    borderColor:"rgba(199, 0, 57,1)",
                    // borderColor:"rgba(255, 99, 132, 1)";
                    tension:0.1,
                    // buat lengkungan grafik
                    // lineTension:0.5,
                    // buat titik pada grafik
                    pointRadius:3,
                    data:[
                        <?php
                            while($data_suhu=mysqli_fetch_array($suhu)) {
                                echo $data_suhu['suhu'].',';
                            }    
                        ?>
                    ],
                },
                {
                    label:"Kelembaban",
                    // biar bisa ganti warna
                    fill: false,
                    tension:0.1,
                    backgroundColor:"rgba(54, 162, 235, 1)",
                    borderColor:"rgba(54, 162, 235, 1)",

                    // buat lengkungan grafik
                    // lineTension:0.5,
                    // buat titik pada grafik
                    pointRadius:3,
                    data:[
                        <?php
                            while($data_kelembaban=mysqli_fetch_array($kelembaban)) {
                                echo $data_kelembaban['kelembaban'].',';
                            }    
                        ?>
                    ],
                },
                {
                    label:"Amonia",
                    // biar bisa ganti warna
                    fill: false,
                    tension:0.1,
                    backgroundColor:"rgba(255, 172, 65, 1)",
                    borderColor:"rgba(255, 172, 65, 1)",
                    // buat lengkungan grafik
                    // lineTension:0.5,
                    // buat titik pada grafik
                    pointRadius:3,
                    data:[
                        <?php
                            while($data_amonia=mysqli_fetch_array($amonia)) {
                                echo $data_amonia['amonia'].',';
                            }    
                        ?>
                    ],
                },
            ],
            };

            // option grafiknya
              var option={
                showLines: true,
                animation: {duration:0},
                responsive: true, // make the chart responsive
                // maintainAspectRatio: false, 
            };
            //   cetak grafik ke dalam canvas
            var myLineChart=Chart.Line(canvas,{
                data: data,
                options: option
            });
        </script>
    </div>
</div>  