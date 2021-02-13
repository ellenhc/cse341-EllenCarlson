<div class="header-container">
    <div class="header-content set-width">
        <ul>
            <li><a href="/index.php">Home</a></li>
            <?php
            if (isset($_SESSION['loggedin'])) {
                echo '<li><a href="/expenses/index.php">Search</a></li>';
                echo '<li><a href="/budgets/index.php">Budgets</a></li>';
                echo '<li><a href="/accounts/index.php?action=Logout">Sign Out</a></li>';
            } else {
                echo '<li><a href="/accounts/index.php?action=login">Sign In</a></li>';
            }
            ?>
        </ul>
    </div>
</div>