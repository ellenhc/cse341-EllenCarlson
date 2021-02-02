<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Login | BudgetTracker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/scss/style.css">
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; ?>
    </header>
    <main>
        <?php
        //Shows any messages that may need to be displayed. isset fxn tests the variable that is included as a parameter and returns T if the variable exists and has value other than
        if (isset($message)) {
            echo "<b>$message</b>";
        }
        ?>
        <form action="/accounts/index.php" method="post" class="login-form">
        <h1>Sign In</h1>
            <label for="email">Email:</label>
            <input type="email" id="email" name="userEmail" placeholder="Email Address" required>
            <label for="pwd">Password:</label>
            <input type="password" id="pwd" name="userPassword" placeholder="Password" required>
            <input type="submit" value="Login">
            <input type="hidden" name="action" value="Login">
            <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>