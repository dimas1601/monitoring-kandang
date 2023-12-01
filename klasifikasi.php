<?php
include "db.php";
date_default_timezone_set('Asia/Kuala_Lumpur');


// klasifikasi
// $result = mysqli_query($conn,"SELECT suhu, kelembaban, amonia, kelas FROM data_training");

// $data = [];
// while ($row = $result->fetch_assoc()) {
//     $data[] = $row;
// }

// // Fungsi untuk menghitung rata-rata
// function mean($data)
// {
//     $total = 0;
//     foreach ($data as $value) {
//         $total += $value;
//     }
//     return $total / count($data);
// }

// // Fungsi untuk menghitung standar deviasi
// function standardDeviation($data)
// {
//     $mean = mean($data);
//     $variance = 0;
//     foreach ($data as $value) {
//         $variance += pow($value - $mean, 2);
//     }
//     return sqrt($variance / count($data));
// }

// // Fungsi untuk menghitung probabilitas Gaussian
// function gaussianProbability($x, $mean, $stdDev)
// {
//     $exponent = exp(-pow($x - $mean, 2) / (2 * pow($stdDev, 2)));
//     return (1 / (sqrt(2 * M_PI) * $stdDev)) * $exponent;
// }

// // Menghitung jumlah data pada setiap kelas
// $classCounts = [];
// foreach ($data as $row) {
//     $class = $row['kelas'];
//     if (isset($classCounts[$class])) {
//         $classCounts[$class]++;
//     } else {
//         $classCounts[$class] = 1;
//     }
// }

// // Menghitung probabilitas prior
// $priors = [];
// $totalData = count($data);
// foreach ($classCounts as $class => $count) {
//     $priors[$class] = $count / $totalData;
// }

// // Menghitung rata-rata dan standar deviasi untuk setiap atribut pada setiap kelas
// $means = [];
// $stdDevs = [];
// $attributes = ['suhu', 'kelembaban', 'amonia'];
// foreach ($classCounts as $class => $count) {
//     $classData = array_filter($data, function ($row) use ($class) {
//         return $row['kelas'] === $class;
//     });

//     $classMeans = [];
//     $classStdDevs = [];

//     foreach ($attributes as $attribute) {
//         $values = array_column($classData, $attribute);
//         $classMeans[$attribute] = mean($values);
//         $classStdDevs[$attribute] = standardDeviation($values);
//     }

//     $means[$class] = $classMeans;
//     $stdDevs[$class] = $classStdDevs;
// }

// // Fungsi untuk melakukan klasifikasi
// function classify($suhu, $kelembaban, $amonia)
// {
//     global $priors, $means, $stdDevs, $attributes;

//     $bestClass = null;
//     $probabilitasPosterior = -1;

//     foreach ($priors as $class => $prior) {
//         $classProbability = $prior;

//         foreach ($attributes as $attribute) {
//             $mean = $means[$class][$attribute];
//             $stdDev = $stdDevs[$class][$attribute];
//             // $attributeValue = $$attribute;
//             $attributeValue = ${$attribute};
//             // fungsi gaussian
//             $classProbability *= gaussianProbability($attributeValue, $mean, $stdDev);
//         }

//         if ($classProbability > $probabilitasPosterior) {
//             $bestClass = $class;
//             $probabilitasPosterior = $classProbability;
//         }
//     }

//     return $bestClass;
// }


// DATA UJI
$uji=mysqli_query($conn, "SELECT * FROM data_uji ORDER BY id DESC LIMIT 1");
$data_uji=mysqli_fetch_array($uji);



?>
<li>
<span class="bx"><i class="material-symbols-outlined">thermostat</i></span>
    <span class="text" > 
        <p >Suhu</p>
        <p class="p"><?php echo $data_uji['suhu'] ?> &deg;C</p>
    </span>
</li>
<li>
<span class="bx"><i class="material-symbols-outlined">humidity_percentage</i></span>
    <span class="text" > 
        <p >Kelembaban</p>
        <p class="p"><?php echo $data_uji['kelembaban'] ?> %</p>
    </span>
</li>

<li>
    <span class="bx">
        <i class="material-symbols-outlined">warning</i>
    </span>
    <span class="text">
        <p>Amonia</p>
        <p class="p"><?php echo  $data_uji['amonia'] ?> ppm</p>	
    </span>
</li>
<li>
    <span class="bx"><i class="material-symbols-outlined">monitoring</i></span>
    <span class="text">
        <p>Status</p>
        <p class="p"><?php echo strtoupper($data_uji['kelas']);?></p>	
    </span>
</li>
