<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('server.php')?>
    <?php include('nav.php')?>
    
    <?php 
        $query = "SELECT * FROM movies";
        $results = $mysqli->query($query);
    ?>
    <h1 class="text-center mt-3">Lista filmova</h1>
    <div class="content">
        <div class="movie-list">
            <?php while($row = $results->fetch_assoc()): ?>
            <div class="movie-list-item">
                <div class="list-img">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['poster'] ).'"/>'?>
                </div>
                <div class="list-details">
                    <div class="movie-details p-3">
                        <form action="server.php" method="POST" id="form-<?php echo $row['id'];?>">
                            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                            <div class="detail-item">
                                <h3 class="detail-title">Naslov:</h3>
                                <input class="input detail-input" name="title" value="<?php echo $row['title'];?>">
                            </div>
                            <div class="detail-item">
                                <h5 class="detail-title">Opis: </h5>
                                <textarea name="description" class="input detail-input"><?php echo $row['description'];?></textarea>
                            </div>
                            <div class="detail-item"><br>
                                <h5 class="detail-title">Zanr: </h5>
                                <input class="input detail-input" name="genres" value="<?php echo $row['genres'];?>"></>
                            </div>
                            <div class="detail-item">
                                <h5 class="detail-title">Scenarista:</h5>
                                <input class="input detail-input" name="screenwriter" value="<?php echo $row['screenwriter'];?>">
                            </div>
                            <div class="detail-item">
                                <h5 class="detail-title">Reziser:</h5>
                                <input class="input detail-input" name="director" value="<?php echo $row['director'];?>">
                            </div>
                            <div class="detail-item">
                                <h5 class="detail-title">Glumci:</h5>
                                <textarea class="input detail-input" name="actors"><?php echo $row['actors'];?></textarea>
                            </div>
                            <div class=" detail-item">
                                <h5 class="detail-title">Producentska kuca: </h5>
                                <input name="production_house" class="input detail-input" value="<?php echo $row['production_house'];?>">
                            </div>
                            <div class="detail-item">
                                <h5 class="detail-title">Godina izlaska:</h5>
                                <input name="release_year" class="input detail-input" value="<?php echo $row['release_year'];?>">
                            </div>
                            <div class="detail-item">
                                <h5 class="detail-title">Duzina trajanja (min):</h5>
                                <input name="duration" class="input detail-input" value="<?php echo $row['duration'];?>">
                            </div>
                            <input type="hidden" name="edit" id="editMovie-<?php echo $row['id'];?>" value="0">
                            <input type="hidden" name="delete" id="deleteMovie-<?php echo $row['id'];?>" value="0">
                        </form>
                    </div>
                </div>
                <div class="movie-actions d-flex flex-column justify-content-center">
                    <button class="btn btn-primary m-3 "
                        onclick="submitMovieEdit(<?php echo $row['id'];?>)">Izmeni</button>
                    <button class="btn btn-danger m-3" onclick="deleteMovie(<?php echo $row['id'];?>)">Ukloni</button>

                </div>

            </div>
            <?php endwhile?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>