<?php 
    if(basename($_SERVER['PHP_SELF']) == 'admin.php' || basename($_SERVER['PHP_SELF']) == 'add_movie.php'){
        if($_SESSION['role'] != 'admin'){
            header('location: home.php');
        }
    }
?>