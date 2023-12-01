<?php
session_start();
include "db.php";
if(isset($_GET['id_user'])){    
    $user=mysqli_query($conn,"SELECT foto FROM data_user WHERE id='".$_GET['id_user']."'");
    
    $data_user = mysqli_fetch_object($user);
    $delete=mysqli_query($conn,"DELETE FROM data_user WHERE id='".$_GET['id_user']."'");
    
    if($delete and $user){
        
        unlink('./assets/foto/'.$data_user->foto);
    
        $_SESSION['status_hapus']=2;
        echo '<script>window.location="data_user.php"</script>';
    }
    
}

?>