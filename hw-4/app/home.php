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
    <?php include('nav.php')?>
    <?php include('pageactions.php')?>
    <div class="content-grid" id = "container">

        <div class="movies-grid" id = "content">
            <?php while($row = $results->fetch_assoc()): ?>
            <div class="movie-container">
                <div class="movie-image">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'"/>'?>
                </div>
                <div class="movie-details">
                    <p class="text-center"><?php echo $row['title'];?></p>
                    <p class="text-center"><?php echo $row['genres'];?></p>
                    <p class="text-center"><?php echo $row['duration'];?>min</p>
                    <p class="text-center">Prosecna ocena:</p>
                    <a class="btn btn-primary w-50 d-block mx-auto" href="movie_details.php?movie=<?php echo $row['id'];?>">Detalji
                        filma</a>

                </div>
            </div>
            <?php endwhile?>
        </div>





    </div>









    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src = "js/main.js"></script>
</body>

</html>