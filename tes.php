<?php
include "db.php";
error_reporting(0);
date_default_timezone_set('Asia/Kuala_Lumpur');

// klasifikasi
$result = mysqli_query($conn,"SELECT suhu, kelembaban, amonia, kelas FROM data_training");

// menampung data training
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
// foreach ($data as $row) {
//     echo "Suhu: " . $row['suhu'] . ", Kelembaban: " . $row['kelembaban'] . ", Amonia: " . $row['amonia'] . ", Kelas: " . $row['kelas'] . "<br>";
// }


// fungsi ini nanti dipangggil di langkah 1
// Fungsi untuk menghitung rata-rata
function mean($data)
{
    // Inisialisasi variabel total dengan nilai awal 0
    $total = 0;

    // Perulangan melalui setiap elemen dalam array data
    foreach ($data as $value) {
        // Menjumlahkan nilai elemen ke dalam variabel total
        $total += $value;
    }
    // echo "<br>Total $total<br>";
    // Mengembalikan rata-rata, yaitu total dibagi jumlah elemen dalam array
    return $total / count($data);
}
// fungsi ini nanti dipangggil di langkah 1
// Fungsi untuk menghitung standar deviasi
function standardDeviation($data)
{
    // Menghitung rata-rata dari data
     $mean = number_format(mean($data),13,".","");
    // echo "<br> mean : ".$mean;
    // Inisialisasi variabel variance dengan nilai awal 0
    $variance = 0;

    // Perulangan melalui setiap elemen dalam array data
    foreach ($data as $value) {
        // Menghitung selisih antara nilai elemen dan rata-rata, kemudian dipangkatkan dua
        $variance += pow($value - $mean, 2);
    }
    
// echo "<br>Jumah: $variance / <br> Total ".count($data)."<br>";
    // Mengembalikan akar kuadrat dari variance dibagi dengan jumlah elemen dalam array
    return sqrt($variance / count($data));
}

// untuk menghitung jumlah data pada setiap kelas
$classCounts = []; // Inisialisasi array $classCounts untuk menyimpan jumlah data pada setiap kelas dan totalnya
//  variabel data diambil dari data training diatas
// perulangan yg digunakan untuk mencari kelas
foreach ($data as $row) {
    // untuk menampung data kelas pada data training

    $class = $row['kelas']; // Mengambil nilai kelas dari setiap baris data pada data training

    // apakah data pada variabel $class sudah ada di tampung di $classCounts, jika belum ada maka akan dijalankan erintah else
    // jika sudah ada maka akan masuk ke dalam perintah if
    if (isset($classCounts[$class])) {

        // Jika kelas sudah ada dalam $classCounts, maka akan ditampung di variabel $classCOunts dan jumlahnya akan ditambah dengan 1
        $classCounts[$class]++;
    } 
    // jadi else ini digunakan untuk menampung kelas yang belum ada pada $classCounts
    else {
            // Jika kelas belum ada dalam $classCounts, maka akan ditampung divariabel variabel $classCounts dan diberi jumlah 1
            $classCounts[$class] = 1;
    }
}

// Menampilkan jumlah data pada setiap kelas
// foreach ($classCounts as $class => $count) {
//     echo "Kelas: $class - Jumlah Data: $count<br>";
// }


// LANGKAH 1
// Menghitung rata-rata dan standar deviasi untuk setiap atribut pada setiap kelas

// variabel array kosong yang digunakan untuk menampung nilai mean dan standar deviasi
$means = [];
$stdDevs = [];

// inisialisai fitur yang akan dihitung mean dan standar deviasinya
$attributes = ['suhu', 'kelembaban', 'amonia'];

// perulangan untuk untuk setiap kelas yang ada dalam $classCounts pada kelas tersebut
// variabel $class untuk menampung kelas sedangkan $count untuk menampung jumlah da
// iterasi 1 misal kelas ideal
// iterasi ke
$no=1;
foreach ($classCounts as $class => $count) {

    // untuk memfilter data pada data latih yang memiliki kelas sama dengan variabel $class 
    // variabel $classData digunakan untuk menampung semua data yang ada pada array $data yang kelas nya sesuai dengan variabel $class
    // variabel $data didapat dari diatas yg digunakan untuk menampung data training
    // echo "<br><br>iterasi $no<br>";
    // $no+=1;
    $classData = array_filter($data, function ($row) use ($class) {
        // untuk memeriksa baris pada data training apakah sesuai dengan $class yang di proses
        // jika sesuai makan akan mengembalikan data tersebut ditampung di $classData
        return $row['kelas'] === $class;
    });
    // print_r($classData);
    // var_dump($classData);
    $classMeans = []; // Inisialisasi array untuk menyimpan rata-rata atribut pada kelas yang sedang diproses
    $classStdDevs = []; // Inisialisasi array untuk menyimpan deviasi standar atribut pada kelas yang sedang diproses
    
    foreach ($attributes as $attribute) {
        // Melakukan iterasi melalui atribut-atribut yang ingin dihitung
        //  echo "<br><br>iterasi $no<br>";
    $no+=1;
        // misal atributenya suhu, maks values akan  menampung semua data suhu pada kelas yg diproses
        $values = array_column($classData, $attribute);
        // Mengambil nilai-nilai atribut yang sesuai dengan atribut yang sedang diproses pada kelas yang sedang diproses
        // $values akan berisi semua nilai atribut yang sesuai dengan atribut saat ini
        // echo "Values for $attribute in $class class: ";
        // print_r($values);
        // echo "<br>";
        $classMeans[$attribute] = mean($values);
        // Menghitung rata-rata dari nilai atribut dan menyimpannya dalam array $classMeans
        // Setiap atribut akan memiliki rata-rata yang sesuai
    
        $classStdDevs[$attribute] = standardDeviation($values);
        // Menghitung deviasi standar dari nilai atribut dan menyimpannya dalam array $classStdDevs
        // Setiap atribut akan memiliki deviasi standar yang sesuai
    }
// untuk menampung rata rata semua fitur pada setiap kelas
    $means[$class] = $classMeans;
    // untuk menampung standar deviasi semua fitur pada setiap kelas
    $stdDevs[$class] = $classStdDevs;
    
}


// // Tampilkan mean dan standar deviasi
// foreach ($means as $class => $classMeans) {
//     foreach ($classMeans as $attribute => $mean) {
//         $stdDev = $stdDevs[$class][$attribute];
//         echo"<br>$attribute | $class<br>";
//         echo "Mean: ".number_format($mean,13,".","")."<br>Standar Deviasi: ".number_format($stdDev,13,".","")."<br>";
//     }
//     echo "<br>";
// }


// LANGKAH 2
// Menghitung probabilitas prior
// array kosong yang digunakan untuk menampung probabiltas prior setiap kelas
$priors = [];
// total data training
$totalData = count($data);
// perulangan array untuk mencari probabilitas prior
foreach ($classCounts as $class => $count) {
// variabel $priors menampung data setiap kelas beserta probabilitas priornya
// $count itu jumlah kelas sedangkan $totalData jumlah data training
   $priors[$class] = $count / $totalData."<br>";
}


// fungsi perhitungan gaussian
// LANGKAH 3
function gaussianProbability($x, $mean, $stdDev)
{
    $exponent = exp(-(pow($x - $mean, 2) / (2 * pow($stdDev, 2))));

    return (1 / (sqrt(2 * 3.14 * pow($stdDev,2)))) * $exponent;
}

function classify($suhu, $kelembaban, $amonia)
{
    // digunakan untuk mengambil nilai di variabel diluar fungsi
    global $priors, $means, $stdDevs, $attributes;
    
    // untuk menampung posterior
    // $posterior=[];

    // menampung kelas
    $bestClass = null;
    
    // untuk menampung posterior tertinggi
    #inisialisai kenapa -1 jadi biar bisa dibandingin dengan nilai diatasnya seperti 0, 1, 2.
    $bestProbability = -1;

    // perulangan probabilitas prior yang iteri pertama kelas buruk
    foreach ($priors as $class => $prior) {

        // untuk menampung probabilitas prior pada setiap kelas
        $classProbability = $prior;

        // perulangan atribute suhu, kelembaban dan amonia
        // jika sudah menjalankan tiga fitur tersebut kembali ke perulangan diatas dengan 
        // kelas yang berbeda
        foreach ($attributes as $attribute) {
            // 
            $mean = $means[$class][$attribute];
            $stdDev = $stdDevs[$class][$attribute];
            // $attributeValue = $$attribute;
            $attributeValue = ${$attribute};
            // echo "<br>Gauss: ".number_format(gaussianProbability($attributeValue, $mean, $stdDev),14,".","");

            $classProbability *= number_format(gaussianProbability($attributeValue, $mean, $stdDev),14,".","");
        }
        $posterior[$class]= $classProbability;
        // LANGKAH 4
        if ($classProbability > $bestProbability) {
            $bestClass = $class;
            $bestProbability = $classProbability;
        }
    }
    echo "<br>";
    foreach($posterior as $class => $post){
        echo "$class : ".number_format($post,14,".","") ."<br>";
    }

    return $bestClass;
}

$url = "https://platform.antares.id:8443/~/antares-cse/antares-id/KandangAyam_Bantuas/Data1/la";
$headers = [
    "X-M2M-Origin:d62b58a24f685c68:e294312a591f2234"
];

// Memasukkan header
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// Mengubah format JSON ke array asosiatif
$dataJson = json_decode($response, true);

// Mengambil data suhu, kelembaban, dan amonia jika tersedia
if (isset($dataJson['m2m:cin']['con'])) {
    $data = json_decode($dataJson['m2m:cin']['con'], true);

    if (isset($data['temperature'])) {
        $temperature = $data['temperature'];
        // echo "Suhu: " . $temperature . "°C<br>";
    } else {
        echo "Data suhu tidak tersedia<br>";
    }

    if (isset($data['humidity'])) {
        $humidity = $data['humidity'];
        // echo "Kelembaban: " . $humidity . "%<br>";
    } else {
        echo "Data kelembaban tidak tersedia<br>";
    }

    if (isset($data['amonia'])) {
        $amonia = $data['amonia'];
        // echo "Amonia: " . $amonia . "<br>";
    } else {
        echo "Data amonia tidak tersedia<br>";
    }
} else {
    echo "Data tidak tersedia";
}

$data_suhu= round($temperature,0,PHP_ROUND_HALF_ODD);
$data_kelembaban=round($humidity,0,PHP_ROUND_HALF_ODD);
$data_amonia=round($amonia,0,PHP_ROUND_HALF_ODD);
 
   
 
    if($data_suhu and $data_kelembaban){ 
    
        $data_sensor = mysqli_query($conn, "INSERT INTO data_sensor VALUES(
            null,
            '" .$data_suhu. "',
            '" .$data_kelembaban. "',
            '" .$data_amonia. "',
            '" . date("Y-m-d H:i:s") . "'
        )");
    

        $kelas = classify($data_suhu,$data_kelembaban,$data_amonia);
        $data_uji = mysqli_query($conn, "INSERT INTO data_uji VALUES(
            null,
            '" .$data_suhu. "',
            '" .$data_kelembaban. "',
            '" .$data_amonia. "',
            '" . $kelas . "',
            '" . date("Y-m-d H:i:s") . "'
        )");
        
        flush();
        $data_suhu="";
        $data_kelembaban="";
        $data_amonia="";
    }
    
// echo classify(35,62,0);
// classify(32,60,20);
// function classify($suhu, $kelembaban, $amonia)
// {
//     global $priors, $means, $stdDevs, $attributes;

//     // buat nampung semua nilai probabilitas posterior
//     $posteriorProbabilities = [];

// // // buat nampug kelas
//     $bestClass = null;
//   #inisialisai kenapa -1 jadi biar bisa dibandingin dengan nilai diatasnya seperti 0, 1, 2.
// //     // buat nampung posterior sementara
//     $bestPosterior = -1;
// //     // perulangan buat kelas, misal kelas buruk baru deh masuk ke foreach atribute
//     foreach ($priors as $class => $prior) {
//         // untuk menampung probabilitas prior pada setiap kelas
//         // echo $classPosterior = $prior;


// //         // pada perulanagan ini ada 3 kali perulangan yaitu suhu, kelembaban baru amonia, 
// //         // kalo sudah baru ke perulangan diatas gantiana padakelas selanjutnya
//         foreach ($attributes as $attribute) {
//             // echo "<br><br>$class | $attribute<br>";
//             $mean = $means[$class][$attribute];
//             $stdDev = $stdDevs[$class][$attribute];
//             $attributeValue = ${$attribute};
//             // echo "$no $attribute :".$attributeValue."<br> mean: ".number_format($mean,13,".","")."<br>std: ".number_format( $stdDev,13,".","")."<br><br>";
//             // $no+=1;
//             // $gaussian=number_format(gaussianProbability($attributeValue, number_format($mean,13,".",""), number_format($stdDev,13,".","")),14,".","" );
//             // echo $gaus."<br>";
//             $classPosterior *= number_format(gaussianProbability($attributeValue, number_format($mean,13,".",""),number_format( $stdDev,13,".","")),14,".","");
            
//             // echo "<br>".number_format($classPosterior,14,".","")."<br><br>";
//         }
// //         // masukkan nilai posterior ke array kosong diatas berdasarkan kelas
//         $posteriorProbabilities[$class] = $classPosterior;

//         echo "<br>posterior : ".number_format($classPosterior,14,".","")." > Best: ".$bestPosterior;
//         if ($classPosterior> $bestPosterior) {
//            $bestClass = $class;
//            $bestPosterior = $classPosterior;
//         //    echo"<br> best:".number_format($bestPosterior,14,".","")."<br>";
//         }
//     }
//     // buat nampilin probabilitas posterior
//     foreach ($posteriorProbabilities as $class => $probability) {
//             echo "<br><br>Class $class: ".number_format($probability,14,".","")."<br>";
//         }
//     return $bestClass;
// }

// echo "<br>Prior Probabilities:<br>";
// $a=0;
// foreach ($priors as $class => $prior) {
//     // $b=number_format($prior,9,".","");
//     echo "Class $class:".$prior."<br>";
//     $a+=$prior;
// }
// echo $a."<br>"; 

// // Display means and standard deviations
// echo "<br>Means and Standard Deviations:<br>";
// foreach ($means as $class => $classMeans) {
//     echo "Class $class:<br>";
//     foreach ($attributes as $attribute) {
//         $mean = $classMeans[$attribute];
//         $stdDev = $stdDevs[$class][$attribute];
//         echo "$attribute - Mean: ".number_format($mean,13,".","").", Standard Deviation:". number_format($stdDev,13,".","")."<br>";
//     }
//     echo "<br>";
// }
// echo "<br><br><br>";
// function classifyWithProbabilities($suhu, $kelembaban, $amonia)
// {
//     global $priors, $means, $stdDevs, $attributes;

//     $posteriorProbabilities = [];

//     foreach ($priors as $class => $prior) {
//         $classPosterior = $prior;

//         foreach ($attributes as $attribute) {
//             $mean = $means[$class][$attribute];
//             $stdDev = $stdDevs[$class][$attribute];
//             $attributeValue = ${$attribute};

//             $classPosterior *= gaussianProbability($attributeValue, $mean, $stdDev);
//         }

//         $posteriorProbabilities[$class] = $classPosterior;
//     }

//     arsort($posteriorProbabilities); // Sort the array in descending order based on posterior probabilities

//     return $posteriorProbabilities;
// }

// // Example usage
// $results = classifyWithProbabilities(35, 62, 0);

// echo "Posterior Probabilities:<br>";
// foreach ($results as $class => $probability) {
//     echo "Class $class: ".number_format($probability,14,".","")."<br>";
// }
// function classify($suhu, $kelembaban, $amonia)
// {
//     global $priors, $means, $stdDevs, $attributes;

//     $bestClass = null;
//     #inisialisai kenapa -1 jadi biar bisa dibandingin dengan nilai diatasnya seperti 0, 1, 2.
//     $bestProbability = -1;

//     foreach ($priors as $class => $prior) {
//         $classProbability = $prior;

//         foreach ($attributes as $attribute) {
//             $mean = $means[$class][$attribute];
//             $stdDev = $stdDevs[$class][$attribute];
//             // $attributeValue = $$attribute;
//             $attributeValue = ${$attribute};


//             $classProbability *= number_format(gaussianProbability($attributeValue, number_format($mean ,14, '.', ''), number_format($stdDev ,8, '.', '')),8,".","");
//         }

//         if ($classProbability > $bestProbability) {
//             $bestClass = $class;
//             $bestProbability = $classProbability;
//         }
//     }

//     return $bestClass;
// }
// Tahap 1 Menghitung Mean  dan Standar Deviasi			
// MEAN			
// Kelas	Suhu	Kelambaban	Amonia
// Ideal	34.6262975778547	62.8339100346021	0.7993079584775
// Buruk	35.7409836065574	61.3475409836066	1.0459016393443
// Berbahaya	30.4814814814815	73.8148148148148	5.9814814814815
			
// STANDAR DEVIASI			
// Kelas	Suhu	Kelambaban	Amonia
// Ideal	0.5812530861869	1.9331632123923	2.9307815493374
// Buruk	2.4134443823334	6.8824225280694	4.7222380693658
// Berbahaya	4.7909665797390	11.9831271409769	14.7955082532463


// $dataaa=0;
// $rata=5.9814814814815;
// $deviasi= 14.7955082532463;
// echo "<br><br>Data: $dataaa <br>";
// echo "Mean: $rata<br>";
// echo "Deviasi: $deviasi<br>";
// $hasil1=$dataaa-$rata;
// echo "<br>Hasil 1 =   $dataaa - $rata : ".$hasil1."<br>";
// $hasil2=pow($deviasi,2);
// echo "<br>Hasil 2 =  $deviasi^2 : ".$hasil2."<br>";
// $hasil3=pow($hasil1,2);
// echo "<br>Hasil 3 =  $hasil1^2 : ".$hasil3."<br>";
// $hasil4=$hasil2*2;
// echo "<br>Hasil 4 =  2 * $hasil2 : ".$hasil4."<br>";
// $hasil5=2*3.14*$hasil2;
// echo "<br>Hasil 5 =  2 * 3.14 * $hasil2 : ".$hasil5."<br>";
// $hasil6=$hasil3/$hasil4;
// echo "<br>Hasil 6 =  $hasil3 / $hasil4 : ".$hasil6."<br>";
// $hasil7=sqrt($hasil5);
// echo "<br>Hasil 7 =  Akar dari $hasil5 : ".$hasil7."<br>";
// $hasil8=exp(-$hasil6);
// echo "<br>Hasil 8 = exp(-$hasil6) : ".$hasil8."<br>";
// $hasil9=1/$hasil7;
// echo "<br>Hasil 9 =  1 / $hasil7 : ".$hasil9."<br>";
// $hasil10=$hasil9 * $hasil8;
// echo "<br>Hasil 10 =  $hasil9 * $hasil8 : ".number_format($hasil10,14,".","")."<br>";
// $gaus=number_format(gaussianProbability($dataaa,$rata,$deviasi),14,".","");
// echo "<br> Hasil Gaussian : $gaus";
// LANGKAH 1
// Menghitung rata-rata dan standar deviasi untuk setiap atribut pada setiap kelas



?>