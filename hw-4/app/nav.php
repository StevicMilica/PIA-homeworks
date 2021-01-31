<nav class="nav bg-transparent">
   
    <div class="nav-links">
        <ul>
            <?php if($_SESSION['role'] == 'admin'):?>
            <li><a class="link-secondary" href="admin.php">Admin</a></li>
            <li><a class="link-secondary" href="add_movie.php">Dodaj Film</a></li>
            <?php endif?>
            <li><a class="link-secondary" href="home.php">Pocetna</a></li>
            <?php if($_SESSION['role'] != 'admin'):?>
            <li><h3>IMDB copycat</h3></li>
            <?php endif?>
            <li><a class="link-secondary" href="logout.php"><?php echo $_SESSION['username']?> - Odjavi se</a></li>
        </ul>
    </div>
</nav>

<?php if(isset($_SESSION['message'])): ?>
<div class="message alert alert-success success-message" id = "messageDiv">
    <p><?php echo $_SESSION['message'] ?></p>
</div>
<?php endif ?>
<?php unset($_SESSION['message']) ?>