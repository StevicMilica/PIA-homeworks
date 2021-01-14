<?php 
    if(!isset($_SESSION['username'])){
            header("location: index.php");
    }
    else{
        $username= $_SESSION['username'];
        $query = "SELECT role FROM users where username = '$username'";
        $results = $mysqli ->query($query)->fetch_assoc();
        $role = $results['role'];
        if($role == 'admin'){
            $_SESSION['role'] = 'admin';
        }
        if($role == 'user'){
            $_SESSION['role'] = 'user';
        }
    }
    
?>