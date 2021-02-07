<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Search Transactions | Finanny</title>
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
        <form action="/expenses/index.php" method="post" class="search-form">
            <h1>View Transactions</h1>
            <h3>Limit my search results by:</h3>
            <label for="expenseName">Name:</label>
            <input type="text" name="expenseName" id="expenseName">

            <label for="daterange">Date Added:</label>
            <select name="daterange" id="daterange">
                <option value="7">7 days</option>
                <option value="30">30 days</option>
                <option value="60">60 days</option>
                <option value="90">90 days</option>
                <option value="365">1 year</option>
            </select>

            <label for="categoryId">Category:</label>
            <?php echo $categoryList; ?>

            <label for="userId">Submitter:</label>
            <?php echo $userList; ?>

            <input type="submit" value="Search">

            <!--The action key-value pair-->
            <input type="hidden" name="action" value="searchExpenses">
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>