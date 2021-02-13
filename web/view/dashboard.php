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
                $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
                $curr = 'USD';
                foreach($allExpenses as $expense){
                    if(!$expense[0]){
                        $num = $expense['sum'];
                        echo ", ['$expense[categoryName]', $fmt->parseCurrency($num, $curr)]";
                    }
                    else{
                        $num = $expense['sum'];
                        echo "['$expense[categoryName]', $fmt->parseCurrency($num, $curr)]";
                    }
                }
                ?>
            ]);

            var options = {
                title: 'My Monthly Spending'
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
    <main>
        <?php
        if (isset($message)) {
            echo "<b>$message</b>";
        }
        ?>
        <div id="piechart"></div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/snippets/footer.php'; ?>
    </footer>
</body>

</html>