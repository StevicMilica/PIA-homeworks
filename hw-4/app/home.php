<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include('server.php')?>
    <?php if(isset($_SESSION['message'])): ?>
    <div class="message alert alert-success success-message">
        <p><?php echo $_SESSION['message'] ?></p>
    </div>
    <?php endif ?>
    <?php unset($_SESSION['message']) ?>

    <?php 
        $query = "SELECT * FROM movies";
        $results = $mysqli->query($query);
    ?>
    <nav class="nav">
        <div class="logo">
            <h3 class="blog-header-logo text-dark" href="#">IMDB copycat</h3>
        </div>
        <div class="nav-links">
            <ul>
                <li><a class="link-secondary" href="home.php">Pocetna</a></li>
                <li><a class="link-secondary" href="movies.php">Filmovi</a></li>
                <li><a class="link-secondary" href="/index.php"><?php echo $_SESSION['username']?> - Odjavi se</a></li>
            </ul>
        </div>
    </nav>
    <div class="content">
        <?php
        // $mysqli = mysqli_connect('localhost', 'root', 'Sql2016', 'imdb');
        // $query = "SELECT * FROM users";
        // $data = $mysqli->query($query);
        // foreach($data->fetch_assoc() as $user){
        //     echo $user;
        // }
            ?>
        <div class="movies-list">
            <?php while($row = $results->fetch_assoc()): ?>
                <div class="movie-container">
                    <div class="movie-image">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'"/>'?>
                    </div>
                    <div class="movie-details">
                        <p class = "text-center"><?php echo $row['title'];?></p>
                        <p class = "text-center"><?php echo $row['genres'];?></p>
                        <p class = "text-center"><?php echo $row['duration'];?>min</p>
                        <p class = "text-center">Prosecna ocena:</p>
                        <a class = "btn btn-primary w-100" href="movie_details.php?movie=<?php echo $row['id'];?>">Detalji filma</a>

                    </div>
                </div>
            <?php endwhile?>
        </div>

        



    </div>









<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>