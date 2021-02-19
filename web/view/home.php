<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Home | Finanny</title>
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
        <div class="home-div">
            <div class="home-content set-width">
                <div>
                    <h1>Experience the easiest way to track your spending</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mollis est et sem porta vehicula. Morbi nibh elit, tempor vel sem et, aliquam porttitor tortor. Aenean porta mattis gravida.</p>
                    <a class="button" href="/accounts/index.php?action=register">Join Finanny</a>
                </div>
                <img src="/images/piggy_bank.png" alt="Image of a person's hand dropping coins into a piggy bank">
            </div>
        </div>
        <div class="banner">
            <div class="banner-content set-width">
                <h2>A second heading here</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mollis est et sem porta vehicula. Morbi nibh elit, tempor vel sem et, aliquam porttitor tortor.</p>
            </div>
        </div>
        <div class="sec-div">
            <div class="sec-content set-width">
                <h2>Finanny is loaded with free features</h2>
                <div class="card-wrapper">
                    <div class="card">
                        <img src="/images/house.png" alt="Illustration of a white house on a blue background">
                        <h4>Manage Households</h4>
                        <p>Households allow you to track spending and set budgets grouped as family units.</p>
                    </div>
                    <div class="card">
                        <img src="/images/receipt.png" alt="Illustration of a receipt on a green background">
                        <h4>Log Expenses</h4>
                        <p>Keep track of transactions to quickly see & analyze where your money goes.</p>
                    </div>
                    <div class="card">
                        <img src="/images/savings.png" alt="Illustration of money with an upwards arrow">
                        <h4>Increase Savings</h4>
                        <p>Stay on top of your spending and set goals that help you increase your savings.</p>
                    </div>
                    <div class="card">
                        <img src="/images/budget.png" alt="Illustration of a calculator">
                        <h4>Create Budgets</h4>
                        <p>Customizable budgets allow you to easily add and update spending categories.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>