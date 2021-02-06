<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Expense List | BudgetTracker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/scss/style.css">
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; ?>
    </header>
    <main class="set-width">
        <h1>Search Results</h1>
        <?php if (isset($message)) {
            echo $message;
        } ?>

        <?php if (isset($expensesList)) {
            echo $expensesList;
        } ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>