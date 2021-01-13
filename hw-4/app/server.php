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
    if(isset($_POST['add_movie'])){
        // var_dump($_POST);
        // var_dump($_FILES);
        // retrurn;
        if($_POST['title'] == ""){
            array_push($errors,'Naslov je obavezan');
        }
        if($_POST['description'] == ""){
            array_push($errors,'Opis je obavezan');
        }
        if($_POST['genre'] == ""){
            array_push($errors,'Zanr je obavezan');
        }
        if($_POST['screenwriter'] == ""){
            array_push($errors,'Scenarista je obavezan');
        }
        if($_POST['director'] == ""){
            array_push($errors,'Reziser je obavezan');
        }
        if($_POST['production_house'] == ""){
            array_push($errors,'Produkcijska kuca je obavezna');
        }
        if($_POST['actors'] == ""){
            array_push($errors,'Glumci su obavezni');
        }
        if($_POST['duration'] == ""){
            array_push($errors,'Trajanje je obavezno');
        }
        if($_POST['release_year'] == ""){
            array_push($errors,'Godina izdavanja je obavezna');
        }
        if($_FILES['poster']['name'] == ""){
            array_push($errors,'Poster je obavezan');
        }
        
        var_dump($errors);
        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            header("location: add_movie.php");
        }
        else{
            $title = $_POST['title'];
            $description = $_POST['description'];
            $genre = $_POST['genre'];
            $screenwriter = $_POST['screenwriter'];
            $director = $_POST['director'];
            $production_house = $_POST['production_house'];
            $actors = $_POST['actors'];
            $duration = $_POST['duration'];
            $release_year = $_POST['release_year'];
            $poster = addslashes(file_get_contents($_FILES['poster']['tmp_name']));
            $query = "INSERT INTO movies(title,description,genres,screenwriter,director,production_house,actors,duration,release_year,poster) VALUES ('$title','$description','$genre','$screenwriter','$director','$production_house','$actors',$duration,$release_year,'$poster')";
            if($mysqli->query($query) === TRUE){
                $_SESSION['message'] = "Film je uspesno dodat u bazu podataka";
                header("location: admin.php");
            }
            else{
                  echo "Error: " . $query . "<br>" . $mysqli->error;
                  return;
            }
        }
    }
    if(isset($_POST['edit']) && $_POST['edit']){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $screenwriter = $_POST['screenwriter'];
        $director = $_POST['director'];
        $actors = $_POST['actors'];
        $production_house = $_POST['production_house'];
        $release_year = $_POST['release_year'];
        $genres = $_POST['genres'];
        $duration = $_POST['duration'];
        
        $query = "
        UPDATE movies 
        SET 
        title = '$title',
        description = '$description',
        screenwriter = '$screenwriter',
        director = '$director',
        actors = '$actors',
        production_house = '$production_house',
        release_year = $release_year,
        genres = '$genres',
        duration = $duration
        WHERE id = $id";
        if($mysqli->query($query) === TRUE){
            $_SESSION['message'] = 'Film je uspesno izmenjen';
            header('location: admin.php');
        }
        else{
            echo "Greska: " . $mysqli->error;
        }
    }
    if(isset($_POST['delete']) && $_POST['delete']){
        $id = $_POST['id'];
        $query = "DELETE FROM movies WHERE id = $id";
        if($mysqli->query($query) === TRUE){
            $_SESSION['message'] = "Uspesno izbrisan film";
            header("location: admin.php");
        }
        else{
            echo 'Greska';
             echo "Greska: " . $mysqli->error;

        }
    }


?>
	
