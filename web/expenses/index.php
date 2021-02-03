<?php
//This is the expenses controller


// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/functions.php';

// Get categories
$categories = getCategories(); //gets data from the main model

// Check for any "action" name - value pairs in the GET or POST
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action){
    default:
        $categoryList = buildCategoryList($categories); // Calls fxn to store results that will create a select list to be displayed
        include '../view/search.php';
        break;
}
?>