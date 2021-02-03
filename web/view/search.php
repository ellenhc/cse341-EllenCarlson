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
            <label></label>
            <input type="text">
            <input type="number">

            <label for="categoryId">Choose an expense category:</label>
            <?php echo $categoryList; ?>

            <input type="submit">
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>