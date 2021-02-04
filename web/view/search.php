<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Search | FiNanny</title>
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
        <form>
            <h1>Advanced Search</h1>
            <p>Limit my search results by:</p>
            <label for="expensename">Name:</label>
            <input type="text" name="expensename" id="expensename">

            <label for="dates">Date Added:</label>
            <select name="dates" id="dates">
                <option value="7">7 days</option>
                <option value="30">30 days</option>
                <option value="60">60 days</option>
                <option value="90">90 days</option>
                <option value="365">1 year</option>
            </select>

            <label for="categoryid">Category:</label>
            <?php echo $categoryList; ?>

            <label for="userid">Submitter:</label>
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