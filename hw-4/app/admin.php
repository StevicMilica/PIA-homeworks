<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('server.php')?>
   
    <nav class="nav">
        <div class="logo">
            <h3 class="blog-header-logo text-dark" href="#">IMDB copycat</h3>
        </div>
        <div class="nav-links">
            <ul>
                <li><a class="link-secondary" href="home.php">Pocetna</a></li>
                <li><a class="link-secondary" href="add_movie.php">Dodaj film</a></li>
                <li><a class="link-secondary" href="/index.php"><?php echo $_SESSION['username']?> - Odjavi se</a></li>
            </ul>
        </div>
    </nav>
    <?php 
        // $mysqli = new mysqli_connect('localhost', 'root', 'Sql2016', 'imdb');
        $query = "SELECT * FROM movies";
        $results = $mysqli->query($query);
        // $data = $results->fetch_assoc();
        // var_dump($results);
        // while($row = $results->fetch_assoc())
        // {
        //     echo $row['title']." ";
        // }
    ?> 
    <h1 class = "text-center mt-3">Dodaj film</h1>
    <div class="content">
        <div class="movie-list">
            <?php while($row = $results->fetch_assoc()): ?>
            <div class="movie-list-item">
                <div class="list-img">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'"/>'?>
                </div>
                <div class="list-details">
                    <div class="movie-details text-center">
                        <div class="movie-title">
                            <h3><?php echo $row['title'];?></h3>
                        </div>
                        <div class="movie-description">
                            <h4><?php echo $row['description'];?></h4>
                        </div>
                        <div class="movie-genre">
                            <h4><?php echo $row['genres'];?></h4>
                        </div>
                        <div class="movie-genre">
                            <h4><?php echo $row['screenwriter'];?></h4>
                        </div>
                        <div class="movie-genre">
                            <h4><?php echo $row['director'];?></h4>
                        </div>
                        <div class="movie-genre">
                            <h4><?php echo $row['production_house'];?></h4>
                        </div>
                        <div class="movie-genre">
                            <h4><?php echo $row['release_year'];?></h4>
                        </div>
                        <div class="movie-genre">
                            <h4><?php echo $row['duration'];?>min</h4>
                        </div>
                    </div>
                </div>
                <div class="movie-actions d-flex flex-column justify-content-center">
                    <button class = "btn btn-primary m-3 ">Izmeni</button>
                    <button class = "btn btn-danger m-3">Ukloni</button>

                </div>

            </div>
            <?php endwhile?>
        </div>
    </div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>