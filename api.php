<?php
include "db.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

// echo $tglFirst;
$waktu_training = mysqli_query($conn, "SELECT * FROM waktu_training ORDER BY id DESC LIMIT 1");
$training = mysqli_fetch_array($waktu_training);
$tanggalAwal = $training['waktu_awal'];
$tanggalAkhir = $training['waktu_akhir'];
// klasifikasi
$result = mysqli_query($conn,"SELECT * FROM data_training WHERE waktu >= '$tanggalAwal' AND waktu <= '$tanggalAkhir'");


// menampung data training
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

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

    // Mengembalikan rata-rata, yaitu total dibagi jumlah elemen dalam array
    return $total / count($data);
}


// fungsi ini nanti dipangggil di langkah 1
// Fungsi untuk menghitung standar deviasi
function standardDeviation($data)
{
    // Menghitung rata-rata dari data
    $mean = mean($data);

    // Inisialisasi variabel variance dengan nilai awal 0
    $variance = 0;

    // Perulangan melalui setiap elemen dalam array data
    foreach ($data as $value) {
        // Menghitung selisih antara nilai elemen dan rata-rata, kemudian dipangkatkan dua
        $variance += pow($value - $mean, 2);
    }

    // Mengembalikan akar kuadrat dari variance dibagi dengan jumlah elemen dalam array
    return sqrt($variance / count($data));
}


// ni nanti dipanggil di langkah 1
// Menghitung jumlah data pada setiap kelas

$classCounts = []; // Inisialisasi array $classCounts untuk menyimpan jumlah data pada setiap kelas
//  variabel data diambil dari data training diatas
foreach ($data as $row) {
    $class = $row['kelas']; // Mengambil nilai kelas dari setiap baris data

    if (isset($classCounts[$class])) {
        // Jika kelas sudah ada dalam $classCounts, maka tambahkan 1 ke jumlahnya
        $classCounts[$class]++;
    } else {
        // Jika kelas belum ada dalam $classCounts, inisialisasi jumlahnya dengan 1
        $classCounts[$class] = 1;
    }
}


// LANGKAH 1
// Menghitung rata-rata dan standar deviasi untuk setiap atribut pada setiap kelas
$means = [];
$stdDevs = [];
$attributes = ['suhu', 'kelembaban', 'amonia'];
foreach ($classCounts as $class => $count) {
    $classData = array_filter($data, function ($row) use ($class) {
        return $row['kelas'] === $class;
    });

    $classMeans = [];
    $classStdDevs = [];

    foreach ($attributes as $attribute) {
        $values = array_column($classData, $attribute);
        $classMeans[$attribute] = mean($values);
        $classStdDevs[$attribute] = standardDeviation($values);
    }

    $means[$class] = $classMeans;
    $stdDevs[$class] = $classStdDevs;
}





// Menghitung probabilitas prior
$priors = [];
$totalData = count($data);
foreach ($classCounts as $class => $count) {
    $priors[$class] = $count / $totalData;
}

// Fungsi untuk menghitung probabilitas Gaussian
// function gaussianProbability($x, $mean, $stdDev)
// {
//     $exponent = exp(-pow($x - $mean, 2) / (2 * pow($stdDev, 2)));

//     return (1 / (sqrt(2 * M_PI) * $stdDev)) * $exponent;
// }
function gaussianProbability($x, $mean, $stdDev)
{
    $exponent = exp(-(pow($x - $mean, 2) / (2 * pow($stdDev, 2))));

    return (1 / (sqrt(2 * M_PI * pow($stdDev,2)))) * $exponent;
}
// Fungsi untuk melakukan klasifikasi
function classify($suhu, $kelembaban, $amonia)
{
    global $priors, $means, $stdDevs, $attributes;

    $bestClass = null;
    #inisialisai kenapa -1 jadi biar bisa dibandingin dengan nilai diatasnya seperti 0, 1, 2.
    $bestProbability = -1;

    foreach ($priors as $class => $prior) {
        $classProbability = $prior;

        foreach ($attributes as $attribute) {
            $mean = $means[$class][$attribute];
            $stdDev = $stdDevs[$class][$attribute];
            // $attributeValue = $$attribute;
            $attributeValue = ${$attribute};


            $classProbability *= gaussianProbability($attributeValue, $mean, $stdDev);
        }

        if ($classProbability > $bestProbability) {
            $bestClass = $class;
            $bestProbability = $classProbability;
        }
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
    
    

?> 