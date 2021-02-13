<?php
//This is the expenses controller


// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/functions.php';
require_once '../model/expenses-model.php';
require_once '../model/accounts-model.php';

// Gets data from main model to populate dropdowns in the search form
$categories = getCategories(); // gets categories 
$users = getUsers(); // gets users

// Check for any "action" name - value pairs in the GET or POST
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action){
    case 'searchExpenses':
        // Filter and store the data
        $expenseName = filter_input(INPUT_POST, 'expenseName', FILTER_SANITIZE_STRING);
        $daterange = filter_input(INPUT_POST, 'daterange', FILTER_SANITIZE_NUMBER_INT);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT); 
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT); 
        $householdId = $_SESSION['userData']['householdId'];
        //$householdId = $userData['householdId'];

        //Send data to the model
        // Function in model that queries the database
        $expenseArray = searchExpenses($expenseName, $daterange, $categoryId, $userId, $householdId);
        
        if(!count($expenseArray)){
            $message = "<p class='notice'>Sorry, no records could be found.</p>";
        }
        else{
            $expensesList = listOfExpenses($expenseArray);
        }
        include '../view/expense-list.php';
        break;

    case 'details':
        //the id is coming in the url. verified that it's working there.
        $expenseId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $details = getOneExpense($expenseId); //call to model
        if(!count($details)){
            $message = "<p class='notice'>Sorry, that record could not be found.</p>";
        }
        else{
            $detailsDisplay = buildExpenseDetails($details); //calls fxn in library
        }
        include '../view/expense-detail.php';
        break;

    case 'mod':
        break;

    case 'del':
        $expenseId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Gets the id from the link
        $deleteResult = deleteExpense($expenseId); // Calls the model
        if ($deleteResult === 1){
            $message = "<p>Transaction was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /expenses/index.php'); // WANT TO SHOW DASHBOARD HERE
            exit;
        }
        else {
            $message = "<p>Error: Transaction was unsuccessfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /expenses/index.php');
            exit;
        }
        break;

    default:
        //$categoryList = buildCategoryList($categories); // Calls fxn to store results that will create a select list to be displayed
        //$userList = buildUserList($users); // Calls fxn to create a select for users
        //include '../view/search.php';
        $householdId = $_SESSION['userData']['householdId'];
        $allExpenses = getExpenseOverview($householdId);

        $categoryList = buildCategoryList($categories); // Calls fxn to store results that will create a select list to be displayed
        $userList = buildUserList($users); // Calls fxn to create a select for users
        $expenseArray = populateRecentTransactions(7, $householdId); //Passes in 7 to get one week
        $expensesList = listOfExpenses($expenseArray);
        include '../view/dashboard.php'; // Send them to dashboard view
        exit;
        break;
}
?>