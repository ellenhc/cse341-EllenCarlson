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
        <?php
        //Shows any messages that may need to be displayed. isset fxn tests the variable that is included as a parameter and returns T if the variable exists and has value other than
        if (isset($message)) {
            echo "<b>$message</b>";
        }
        ?>
        <form action="/accounts/index.php" method="post" class="register-form">
            <h1>Create an account</h1>
            <label for="fname">First name</label>
            <input type="text" id="fname" name="userFirstName" required>
            <label for="lname">Last name</label>
            <input type="text" id="lname" name="userLastName" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="userEmail" required>
            <label for="pwd">Password</label>
            <input type="password" id="pwd" name="userPassword" required>
            <input type="submit" name="submit" value="Register">
            <!--The action key-value pair-->
            <input type="hidden" name="action" value="Register">
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>