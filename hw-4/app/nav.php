
<nav class="nav">
        <div class="logo">
            <h3 class="blog-header-logo text-dark" href="#">IMDB copycat</h3>
        </div>
        <div class="nav-links">
            <ul>
                <?php if($_SESSION['role'] == 'admin'):?>
                <li><a class = "link-secondary" href = "admin.php">Admin</a></li>
                <?php endif?>    
                <li><a class="link-secondary" href="home.php">Pocetna</a></li>
                <li><a class="link-secondary" href="movies.php">Filmovi</a></li>
                <li><a class="link-secondary" href="logout.php"><?php echo $_SESSION['username']?> - Odjavi se</a></li>
            </ul>
        </div>
    </nav>