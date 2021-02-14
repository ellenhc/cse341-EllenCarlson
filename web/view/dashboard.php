<?php
if (!$_SESSION['loggedin']) {
    //if not logged in, send to main controller
    header('Location: /index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>My Dashboard | Finanny</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/scss/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Categories', 'Amount']
                <?php
                $remove = array("$", ",");
                foreach ($allExpenses as $expense) {
                    $num = $expense['sum'];
                    $replace = str_replace($remove, "", $num);
                    echo ", ['$expense[categoryName]', $replace]";
                }
                ?>
            ]);

            var options = {
                //title: 'My Monthly Spending',
                pieHole: 0.4,
                colors: ['#73C259', '#3ABC66', '#00B573', '#00A58E', '#0093A2', '#007FAB', '#006AA8', '#005C8D', '#004D72', '#184B65']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/header.php'; ?>
    </header>
    <main class="dashboard">
        <?php
        if (isset($message)) {
            echo "<b>$message</b>";
        }
        ?>
        <div class="dash-wrapper set-width">
            <div class="piechart">
                <h2>Spending</h2>
                <div id="piechart"></div>
            </div>
            <div class="recent-transactions">
                <h2>Recent Transactions</h2>
                <?php if (isset($expensesList)) {
                    echo $expensesList;
                } ?>
                <div class="button-wrap">
                    <a class='button' href='/expenses/index.php?action=viewAll'>View All</a>
                    <a class='button' href='/expenses/index.php?action=add-view'>Add New</a>
                </div>
            </div>
            <div class="search">
                <form action="/expenses/index.php" method="post" class="search-form">
                    <h2>Search Transactions</h2>
                    <h4>Limit my search results by:</h4>
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
            </div>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>