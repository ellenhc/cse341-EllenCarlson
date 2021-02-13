<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Budget Details | Finanny</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/scss/style.css">
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; ?>
    </header>
    <main class="budget-div set-width">
        <h1>Budget Details</h1>
        <?php if (isset($message)) {
            echo $message;
        } ?>
        <div>
            <?php if (isset($detailsDisplay)) {
                echo $detailsDisplay;
            } ?>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>