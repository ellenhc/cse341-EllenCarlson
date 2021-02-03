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
            <label for="expensename"></label>
            <input type="text" name="expensename" id="expensename">

            <!--sort by date-->

            <label for="categoryid">Choose an expense category:</label>
            <?php echo $categoryList; ?>

            <label for="userid">Sort by submitter:</label>
            <?php echo $userList; ?>

            <label for="householdname"></label>
            <input type="text" name="householdname" id="householdname">

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