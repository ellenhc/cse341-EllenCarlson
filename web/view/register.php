<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Login | Finanny</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/scss/style.css">
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; ?>
    </header>
    <main>
        <form action="/accounts/index.php" method="post" class="register-form set-width">
            <?php
            if (isset($message)) {
                echo "<b>$message</b>";
            }
            ?>
            <h1>Create an account</h1>
            <label for="fname">First name</label>
            <input type="text" id="fname" name="userFirstName" required>
            <label for="lname">Last name</label>
            <input type="text" id="lname" name="userLastName" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="userEmail" required>
            <label for="pwd">Password</label>
            <span class="form-msg">Password must contain at least 7 characters and include 1 number.</span>
            <input type="password" id="pwd" name="userPassword" pattern="(?=^.{7,}$)(?=.*\d)(?=.*[a-z]).*$" required>
            <input type="submit" name="submit" value="Register">
            <!--The action key-value pair-->
            <input type="hidden" name="action" value="Register">
            <p class="message">Already have an account? <a href="/accounts/index.php?action=login">Log in</a></p>
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>