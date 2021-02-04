<?php
//This is the expenses controller


// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/functions.php';
require_once '../model/expenses-model.php';

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
        $householdId = 1; // TODO: get from session

        //Send data to the model
        // Function in model that queries the database
        $expenseArray = expenseSearch($expenseName, $daterange, $categoryId, $userId, $householdId);
        echo json_encode($expenseArray);

        break;
    default:
        $categoryList = buildCategoryList($categories); // Calls fxn to store results that will create a select list to be displayed
        $userList = buildUserList($users); // Calls fxn to create a select for users
        include '../view/search.php';
        break;
}
?>