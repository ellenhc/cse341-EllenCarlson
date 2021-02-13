<div class="header-container">
    <div class="header-content">
        <ul>
            <li><a href="/index.php">Home</a></li>
            <!-- <li><a href="/accounts/index.php?action=login">Sign In</a></li>
            <li><a href="/accounts/index.php?action=register">Register</a></li> -->
            <li><a href="/accounts/index.php">Dashboard</a></li>
            <li><a href="/budgets/index.php">Budgets</a></li>
            <?php
            if (isset($_SESSION['loggedin'])) {
                echo '<li><a href="/accounts/index.php?action=Logout">Sign Out</a></li>';
            } else {
                echo '<li><a href="/accounts/index.php?action=login">My Account</a></li>';
            }
            ?>
        </ul>
    </div>
</div>