<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <?php include('server.php')?>
    <?php include('nav.php')?>
    <?php 
        $movie_id = $_GET['movie'];
        $query = "SELECT movies.id,movies.title,movies.duration, movies.description, movies.screenwriter,movies.director, movies.actors,movies.production_house,movies.release_year, movies.genres,movies.poster, AVG(movie_ratings.rating) as avg_rate
         FROM movies
         INNER JOIN movie_ratings on movies.id = movie_ratings.movie_id
         WHERE movies.id = $movie_id
         GROUP BY (movies.title)
         ORDER BY (avg_rate) DESC";
        $results = $mysqli -> query($query);
        $results = $results->fetch_assoc();
        $actors = explode(',',$results['actors']);

        $query = "SELECT users.username,users.first_name,users.last_name,movie_ratings.rating, movie_ratings.comment, movie_ratings.created_at
        FROM movie_ratings
        INNER JOIN users on users.id = movie_ratings.user_id
        WHERE movie_id = $movie_id";
        $reviews = $mysqli -> query($query);


        $username = $_SESSION['username'];
        $query = "SELECT id FROM users WHERE username = '$username'";
        $user_data = $mysqli->query($query);
        $user_data = $user_data -> fetch_assoc();
        $user_id = $user_data['id'];
        
        $query = "SELECT * FROM movie_ratings WHERE user_id = $user_id AND movie_id = $movie_id";
        $reviewed = $mysqli -> query($query);
    ?>
    <div class="movie-details-container">
        <div class="px-3 mt-3 row">
            <div class="data col-md-4">
                <h2 class = "text-center"><?php echo $results['title']?> (<?php echo $results['release_year']?>)</h2>
                <p class = "text-center"></p>
                <p>Producentska kuca: <?php echo $results['production_house']?></p>

                <p>Zanr: <?php echo $results['genres']?></p>
                <ul class="actor-data">
                    <li>
                        <h5>Glavne uloge:</h5>
                    </li>
                    <?php foreach($actors as $actor):?>
                    <li><?php echo $actor?></li>
                    <?php endforeach?>
                </ul>
                <p>Scenograf: <?php echo $results['screenwriter']?></p>
                <p>Reziser: <?php echo $results['director']?></p>
                <p>Prosecna ocena: <?php echo round($results['avg_rate'],2)?></p>
            </div>
            <div class="col-md-4">
                <?php echo '<img class = "d-block mx-auto detail-img" src="data:image/jpeg;base64,'.base64_encode( $results['poster'] ).'"/>'?>
                <br><p class = "text-center"><?php echo $results['description']?></p>

            </div>

            <div class="col-md-4">
            <?php if($reviewed->num_rows == 0):?>
            <div class="review-form text-center mt-3">
                <h4>Ocenite film</h4>
                <form action="server.php" method="POST">
                    <div class="mb-3">
                        <label for="movieRating" class="form-label">Vasa ocena (1-10)</label>
                        <input type="number" name="movieRating" min="1" max="10" class="form-input form-control" id="movieRating">
                    </div>
                    <div class="mb-3">
                        <label for="rateComment" class="form-label">Komentar na film</label>
                        <textarea class="form-control form-input" name="rateComment" id="rateComment"></textarea>
                    </div>
                    <input type="hidden" name="rate_movie" value=1>
                    <input type="hidden" name="movie_id" value="<?php echo $results['id'];?>" \>
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>" \>
                    <button type="submit" class="btn btn-primary form-btn">Oceni</button>
                </form>
            </div>
            <?php else:?>
            <?php 
                $query = "SELECT * FROM movie_ratings WHERE user_id = $user_id AND movie_id = $movie_id";
                $review = $mysqli->query($query);
                $review = $review->fetch_assoc();
            ?>
            <div class="review-form text-center mt-3">
                <h4 class="text-center">Izmeni ocenu</h4>
                <form action="server.php" method="POST">
                    <div class="mb-3">
                        <label for="movieRating" class="form-label">Vasa ocena (1-10)</label>
                        <input value="<?php echo $review['rating']?>" type="number" name="movieRating" min="1" max="10"
                            class="form-control form-input" id="movieRating">
                    </div>
                    <div class="mb-3">
                        <label for="rateComment" class="form-label">Komentar na film</label>
                        <textarea class="form-control form-input" name="rateComment"
                            id="rateComment"><?php echo $review['comment']?></textarea>
                    </div>
                    <input type="hidden" name="movie_id" value="<?php echo $results['id'];?>" \>
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>" \>
                    <input type="hidden" value="<?php echo $movie_id?>" name="movie_id">
                    <input type="hidden" value="<?php echo $user_id?>" name="user_id">
                    <input type="hidden" name="editRating" value="1" ?>
                    <button type="submit" class="btn btn-warning form-btn">Izmeni</button>

                </form>
            </div>
            <?php endif;?>
            
            </div>

        </div>
        <div class="movie-reviews">
            <div class="mt-3">
                <h4 class="text-center">Ocene korisnika</h4>
                <h5 class="text-center"><?php echo mysqli_num_rows($reviews)?> Ocene </h5>
            </div>
            <?php while($row = $reviews->fetch_assoc()):?>
            <div class="review">
                <div class="user-data">
                    <p class="username"><?php echo $row['username']?>: <i><?php echo $row['rating']?>/10</i></p>
                    <p class="date"><?php echo $row['created_at']?></p>
                </div>
                <div class="comment">
                    <?php echo $row['comment'];?>
                </div>
            </div>
            <?php endwhile?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="js/main.js"></script>
</body>

</html>