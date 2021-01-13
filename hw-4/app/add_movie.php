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
    <h1 class="text-center mt-3">Dodaj Film</h1>
    <div class="content">
        <form method="get" action='server.php'  enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="text" name = "title" class="form-control" placeholder="Naziv filma">
            </div>
            <div class="input-group mb-3">
                <textarea type="text" name = "description" class="form-control" placeholder="Kraci opis"></textarea>
            </div>
            <div class="input-group mb-3">
                <input type="text" name = "genre" class="form-control" placeholder="Zanr" >
            </div>
            <div class="input-group mb-3">
                <input type="text" name = "screenwriter" class="form-control" placeholder="Scenarista" >
            </div>
            <div class="input-group mb-3">
                <input type="text" name = "director" class="form-control" placeholder="Reziser" >
            </div>
            <div class="input-group mb-3">
                <input type="text" name = "production_house" class="form-control" placeholder="Producentska kuca" >
            </div>
            <div class="input-group mb-3">
                <input type="text" name = "actors" class="form-control" placeholder="Lista glumaca" >
            </div>
            
            <div class="input-group mb-3">
                <input type="number" name = "duration" class="form-control" placeholder="Trajanje u minutima" >
            </div>
            <div class="input-group mb-3">
                <input type="number" name = "release_year" class="form-control" placeholder="Godina izdanja" >
            </div>
            <div class="input-group mb-3">
                <input type="file" name = "poster" class="form-control" placeholder="Slika">
            </div>
        </form>
    </div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>