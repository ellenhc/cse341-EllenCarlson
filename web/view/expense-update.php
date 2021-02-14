<!DOCTYPE html>
<html lang="en-US">

<head>
    <title><?php if (isset($expenseInfo['expenseName'])) {
                echo "Edit $expenseInfo[expenseName]";
            } else if (isset($expenseName)) {
                echo "Edit $expenseName";
            }
            ?> | Finanny</title>
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
        <?php
        if (isset($message)) {
            echo "<b>$message</b>";
        }
        ?>
        <form>
            <h1>
                <?php 
                    if(isset($expenseInfo['expenseName'])){
                        echo "Edit $expenseInfo[expenseName] transaction";
                    }
                    else if(isset($expenseName)){
                        echo "Edit $expenseName transaction";
                    }
                ?>
            </h1>
            <label for="expenseName">Name:</label>
            <input type="text" name="expenseName" required <?php if(isset($expenseName)){ echo "value='$expenseName'"; } elseif(isset($expenseInfo['expenseName'])) {echo "value='$expenseInfo[expenseName]'"; }?>>
            <label for="expensePrice">Amount:</label>
            <input type="text" name="expensePrice" required <?php if(isset($expensePrice)){ echo "value='$expensePrice'"; } elseif(isset($expenseInfo['expensePrice'])) {echo "value='$expenseInfo[expensePrice]'"; }?>>
            <label for="expenseDate">Date:</label>
            <input type="date" name="expenseDate" required <?php if(isset($expenseDate)){ echo "value='$expenseDate'"; } elseif(isset($expenseInfo['expenseDate'])) {echo "value='$expenseInfo[expenseDate]'"; }?>>
            <label for="categoryId">Category:</label>
            <?php echo $categoryList; ?>
            <label for="userId">User</label>
            <?php echo $userList; ?>
            <input type="submit" value="Save Changes">
            <input type="hidden" name="action" value="updateExpense">
        </form>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>