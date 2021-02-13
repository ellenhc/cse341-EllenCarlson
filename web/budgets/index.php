<?php
//This is the BUDGETS controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../library/functions.php';
require_once '../model/budgets-model.php';

// Gets data from main model to populate dropdowns in the search form
$categories = getCategories(); // gets categories 
$users = getUsers(); // gets users

// Check for any "action" name - value pairs in the GET or POST
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action){
    case 'details':
        //the id is coming in the url. verified that it's working there.
        $budgetId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $details = getOneBudget($budgetId); //call to model
        if(!count($details)){
            $message = "<p class='notice'>Sorry, that budget could not be found.</p>";
        }
        else{
            $detailsDisplay = buildBudgetDetails($details); //calls fxn in library
        }
        include '../view/budget-detail.php';
        break;

    case 'mod':
        break;
    
    case 'del':
        break; 
        
    default:
        $budgetsArray = getAllBudgets();
        if(!count($budgetsArray)){
            $message = "<p class='notice'>Sorry, no records could be found.</p>";
        }
        else{
            $budgetList = listOfBudgets($budgetsArray);
        }
        include '../view/budget-list.php';
        break;
}