<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='style.css'>
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
                <h3>Ulogujte se</h3>
            </div>
            <br>
            <div class="row">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Korisnicko ime"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name='password' placeholder="Lozinka"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>

            <br>
            <div class="row">
                <div class="input-group mb-3 d-flex justify-content-center">
                    <button class="btn btn-primary" name="log_user" value='1'>Uloguj se</button>
                </div>
            </div>
            <div class="row text-center">
                <span>Nemate nalog? Registrujte se <a href="register.php"><strong>ovde</strong></a>.</span>
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