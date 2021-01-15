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
        $query = "SELECT * FROM movies WHERE id = $movie_id";
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
        <div class="movie-banner">

            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $results['poster'] ).'"/>'?>
            <div class="data text-center">
                <h3><?php echo $results['title']?></h3>
                <p><?php echo $results['production_house']?></p>
                <p><?php echo $results['release_year']?></p>
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
            </div>
        </div>
        <div class="movie-reviews">
            <?php while($row = $reviews->fetch_assoc()):?>
            <div class="review">
                <div class="user-data">
                    <p class="username"><?php echo $row['username']?></p>
                    <p class="date"><?php echo $row['created_at']?></p>
                </div>
                <div class="comment">
                    <?php echo $row['comment'];?>
                </div>
            </div>
            <?php endwhile?>
            <?php if($reviewed->num_rows == 0):?>
            <div class="review-form text-center mt-3 container">
                <h4>Ocenite film</h4>
                <form action="server.php" method="POST">
                    <div class="mb-3">
                        <label for="movieRating" class="form-label">Vasa ocena (1-10)</label>
                        <input type="number" name="movieRating" min="1" max="10" class="form-control" id="movieRating">
                    </div>
                    <div class="mb-3">
                        <label for="rateComment" class="form-label">Komentar na film</label>
                        <textarea class="form-control" name="rateComment" id="rateComment"></textarea>
                    </div>
                    <input type="hidden" name="rate_movie" value=1>
                    <input type="hidden" name="movie_id" value="<?php echo $results['id'];?>" \>
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>" \>
                    <button type="submit" class="btn btn-primary w-100">Oceni</button>
                </form>
            </div>
            <?php else:?>
            <?php 
                $query = "SELECT * FROM movie_ratings WHERE user_id = $user_id AND movie_id = $movie_id";
                $review = $mysqli->query($query);
                $review = $review->fetch_assoc();
            ?>
            <div class="review-form text-center mt-3 container">
                <h2 class="text-center">Vec ste ocenili film. Mozete izmeniti ocenu u svako doba</h2>
                <form action="server.php" method="POST">
                    <div class="mb-3">
                        <label for="movieRating" class="form-label">Vasa ocena (1-10)</label>
                        <input value = "<?php echo $review['rating']?>" type="number" name="movieRating" min="1" max="10" class="form-control" id="movieRating">
                    </div>
                    <div class="mb-3">
                        <label for="rateComment" class="form-label">Komentar na film</label>
                        <textarea class="form-control" name="rateComment" id="rateComment"><?php echo $review['comment']?></textarea>
                    </div>
                    <input type="hidden" name="movie_id" value="<?php echo $results['id'];?>" \>
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>" \>
                    <input type = "hidden" value = "<?php echo $movie_id?>" name = "movie_id">
                    <input type = "hidden" value = "<?php echo $user_id?>" name = "user_id">
                    <input type = "hidden" name = "editRating" value = "1"?>
                    <button type="submit" class="btn btn-warning w-100">Izmeni</button>
                    
                </form>
            </div>
            <?php endif;?>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src = "js/main.js"></script>
</body>

</html>