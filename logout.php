<?php
error_reporting(0);
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }else{
        
        $_SESSION['status_logout']=2;
        $_SESSION['status_login']=false;
        echo '<script>window.location="login.php"</script>';
    }
    if($_SESSION['login'] != true){
        echo '<script>window.location="login.php"</script>';
    }else{
        $_SESSION['status_logout']=2;
        $_SESSION['login']=false;
        echo '<script>window.location="login.php"</script>';
    }
    
?>