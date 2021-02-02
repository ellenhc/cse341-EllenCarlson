<?php
//This is the Accounts Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the accounts model
require_once '../model/accounts-model.php';
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

        // Check for existing email address
        $existingEmail = checkExistingEmail($userEmail);
        if ($existingEmail) {
            $message = '<p class="notice">This email already exists. Please login.</p>';
            include '../view/login.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = registerUser($userFirstName, $userLastName, $userEmail, $userPassword);

        if ($regOutcome === 1) {
            setcookie('firstname', $userFirstName, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $userFirstName. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p class='notice'>Sorry $userFirstName, but the registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }

        break;
    case 'Login':
        break;
    case 'login':
        include '../view/login.php';
        break;
    case 'register':
        include '../view/registration.php';
        break;
    default:
        include '../view/500.php';
        break;
}
