<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Add New | Finanny</title>
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
        <form action="/expenses/index.php" method="post" class="add-form set-width">
            <h2>Add a new transaction</h2>
            <?php
            if (isset($message)) {
                echo "<b>$message</b>";
            }
            ?>
            <label for="expenseName">Name:</label>
            <input type="text" name="expenseName" required>
            <label for="expensePrice">Amount:</label>
            <input type="text" name="expensePrice" required>
            <label for="expenseDate">Date:</label>
            <input type="date" name="expenseDate" required>
            <label for="categoryId">Category:</label>
            <?php echo $categoryList; ?>
            <input type="submit" value="Add">
            <input type="hidden" name="action" value="addNew">
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>