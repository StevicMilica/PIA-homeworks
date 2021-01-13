<?php
    session_start();
    $mysqli = mysqli_connect('localhost', 'root', 'Sql2016', 'imdb');
    $errors = [];
    if(isset ($_POST['reg_user'])){
        //data validation
        if($_POST['first_name'] == "")
            array_push($errors,'Ime je obavezno polje');
        if($_POST['last_name'] == "")
            array_push($errors,'Prezime je obavezno polje');
        if($_POST['username'] == "")
            array_push($errors,'Korisnicko ime je obavezno polje');
        if($_POST['email'] == "")
            array_push($errors,'Email je obavezno polje');
        if($_POST['password'] == "")
            array_push($errors,'Lozinka je obavezno polje');
        if(count($errors) > 0){
            $_SESSION['errors'] = $errors;
            header("Location: register.php");
        }
        else{
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $query = "INSERT INTO users(username,first_name,last_name,email,password,role) VALUES ('$username','$first_name','$last_name','$email','$password','user')";
            if($mysqli->query($query) == TRUE){
                header("Location: home.php");
                $_SESSION['message'] = "Uspesno registrovan nalog";
                $_SESSION['username'] = $username;
            }
            else{
                  echo "Error: " . $sql . "<br>" . $mysqli->error;

            }
        }


            

    }
    if(isset ($_POST['log_user'])){
        //data validation
        if($_POST['username'] == "")
            array_push($errors,'Korisnicko ime mora biti uneto');
        if($_POST['password'] == "")
            array_push($errors, 'Lozinka mora biti uneta');
        if(count($errors) > 0){
            $_SESSION['errors'] = $errors;
            header('Location: index.php');            
        }
        else{
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            // $query = "SELECT * FROM users";
            $query = "SELECT username,role,password FROM users WHERE username = '$username' AND password = '$password'";
            $results = $mysqli->query($query);
            if (mysqli_num_rows($results) == 1) {
                $data = $results->fetch_assoc();
                if($data['role'] == 'user'){
                    $_SESSION['username'] = $username;
  	                $_SESSION['message'] = "Uspesno logovanje";
                    header('location: home.php');
                }
                if($data['role'] == 'admin'){
                    $_SESSION['username'] = $username;
  	                $_SESSION['message'] = "Uspesno logovanje";
                    header('location: admin.php');
                    
                }
  	        }else {
  	            header('location: index.php');
  		        array_push($errors, "Greska pri logovanju.");
        	}
        }



    }


?>