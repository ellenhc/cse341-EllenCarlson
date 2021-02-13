<?php
//This is the Accounts Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the expenses model
require_once '../model/expenses-model.php';
// Get the functions library
require_once '../library/functions.php';

// Check for any "action" name - value pairs in the GET or POST
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

// Control structure to act based on the value of the $action variable
switch ($action) {
    case 'Register':
        // Filter and store the data
        $userFirstName = filter_input(INPUT_POST, 'userFirstName', FILTER_SANITIZE_STRING);
        $userLastName = filter_input(INPUT_POST, 'userLastName', FILTER_SANITIZE_STRING);
        $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
        $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING);
        //$householdId = filter_input(INPUT_POST, 'householdId', FILTER_SANITIZE_NUMBER_INT);

        $userEmail = checkEmail($userEmail);

        // Check for existing email address
        $existingEmail = checkExistingEmail($userEmail);
        if ($existingEmail) {
            $message = '<p class="notice">This email already exists. Please login.</p>';
            include '../view/login.php';
            exit;
        }
        
        // As a default, EVERY user's householdId is initially set to zero?
        $householdId = 1;

        // Check for missing data
        if (empty($userFirstName) || empty($userLastName) || empty($userEmail) || empty($userPassword)) {
            $message = '<p class="notice">Please provide information for all empty form fields.</p>';
            include '../view/register.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = registerUser($userFirstName, $userLastName, $userEmail, $householdId, $hashedPassword);

        if ($regOutcome === 1) {
            setcookie('firstname', $userFirstName, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $userFirstName. Please use your email and password to login.";
            header('Location: /accounts/?action=login');
            exit;
        } else {
            $message = "<p class='notice'>Sorry $userFirstName, but the registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }

        break;
    case 'Login':
        $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
        $userEmail = checkEmail($userEmail); // Validate the email variable
        $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING);

        // Check for missing form data
        if (empty($userEmail) || empty($userPassword)){
            $message = '<p class="notice">Please fill out all empty form fields.</p>';
            include '../view/login.php';
            exit;
        }

        // Gets user data from users table
        $userData = getUser($userEmail);
        // Compare the password just submitted against the hashed password in the table
        $hashCheck = password_verify($userPassword, $userData['userPassword']);
        // If hashes don't match, return user to login view
        if(!$hashCheck){
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }

        $_SESSION['loggedin'] = TRUE;
        array_pop($userData); // Remove the password from the array
        $_SESSION['userData'] = $userData; // Store the array into the session

        $householdId = $_SESSION['userData']['householdId'];
        $allExpenses = getExpenseOverview($householdId);

        $categoryList = buildCategoryList($categories); // Calls fxn to store results that will create a select list to be displayed
        $userList = buildUserList($users); // Calls fxn to create a select for users

        include '../view/dashboard.php'; // Send them to dashboard view
        exit;
    case 'login':
        include '../view/login.php';
        break;
    case 'register':
        include '../view/register.php';
        break;
    case 'Logout':
        session_unset();
        session_destroy();
        include '../index.php';
        break;
    default:
        //include '../view/500.php';
        $allExpenses = getExpenseOverview($householdId);

        $categoryList = buildCategoryList($categories); // Calls fxn to store results that will create a select list to be displayed
        $userList = buildUserList($users); // Calls fxn to create a select for users
        include '../view/dashboard.php';
        break;
}
