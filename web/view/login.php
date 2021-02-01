<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Login | BudgetTracker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!--<link rel="stylesheet" media="screen and (min-width: 992px)" href="/phpmotors/css/large.css">-->
</head>

<body>
    <header></header>
    <main>
        <form action="\cs313-php\accounts\index.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="userEmail" placeholder="Email Address" required>
            <label for="pwd">Password:</label>
            <input type="password" id="pwd" name="userPassword" placeholder="Password" required>
            <input type="submit" value="Submit">
            <input type="hidden" name="action" value="Login">
            <p>Not registered? <a href="#">Create an account</a></p>
        </form>
    </main>
    <footer></footer>
</body>

</html>