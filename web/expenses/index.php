<?php
//This is the expenses controller


// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/functions.php';

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
        $expensename = filter_input(INPUT_POST, 'expensename', FILTER_SANITIZE_STRING);
        $daterange = filter_input(INPUT_POST, 'daterange', FILTER_SANITIZE_NUMBER_INT);
        $categoryid = filter_input(INPUT_POST, 'categoryid', FILTER_SANITIZE_NUMBER_INT); 
        $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_NUMBER_INT); 
        
        //Send data to the model
        // Function in model that queries the database
        $expenseArray = expenseSearch($expensename, $daterange, $categoryid, $userid);
        echo json_encode($expenseArray);

        break;
    default:
        $categoryList = buildCategoryList($categories); // Calls fxn to store results that will create a select list to be displayed
        $userList = buildUserList($users); // Calls fxn to create a select for users
        include '../view/search.php';
        break;
}
?>