<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container login-form">
        <div class="errors text-center alert-danger">
            <?php session_start() ?>
            <?php if(isset($_SESSION['errors'])):?>
                <?php foreach($_SESSION['errors'] as $error): ?>
                <h6><?php echo $error; ?></h6><br>
                <?php endforeach ?>
                <?php unset($_SESSION['errors']) ?>
            <?php endif ?>
        </div>
        <form action="/server.php" method="post">
            <div class="row text-center">
                <h3>Registracija</h3>
            </div>
            <br>
            <div class="row">
                <div class="input-group mb-3">
                    <input type="text" name="first_name" class="form-control" placeholder="Ime" aria-label="Username"
                        aria-describedby="first_name">
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="last_name" class="form-control" placeholder="Prezime" aria-label="Username"
                        aria-describedby="last_name">
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="E-mail adresa"
                        aria-label="Username" aria-describedby="email">
                </div>
                <div class="input-group mb-3">
                    <input type="text" name='username' class="form-control" placeholder="Korisnicko ime"
                        aria-label="Username" aria-describedby="username">
                </div>
                <div class="input-group mb-3">
                    <input type="password" name='password' class="form-control" placeholder="Lozinka"
                        aria-label="Username" aria-describedby="password">
                </div>
            </div>

            <br>
            <div class="row">
                <div class="input-group mb-3 d-flex justify-content-center">
                    <button class="btn btn-primary" name = "reg_user" value = '1'>Registruj se</button>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 d-flex justify-content-center">
                    <span>Vec imate nalog? Ulogujte se <a href = "index.php"><strong>ovde</strong></a>.</span>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 d-flex justify-content-center">
                    <span>Registracijom na IMDB-copycat prihvatate sve uslove koriscenja</span>
                </div>
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