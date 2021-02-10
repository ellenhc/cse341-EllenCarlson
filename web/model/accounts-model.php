<?php
/*
*Accounts model
*/
// Function to register a new user
function registerUser($userFirstName, $userLastName, $userEmail, $userPassword, $householdId){
    $db = databaseConnect();
    $sql = 'INSERT INTO users (userFirstName, userLastName, userEmail, userPassword, householdId) VALUES (:userFirstName, :userLastName, :userEmail, :userPassword, :householdId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userFirstName', $userFirstName, PDO::PARAM_STR);
    $stmt->bindValue(':userLastName', $userLastName, PDO::PARAM_STR);
    $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);
    $stmt->bindValue(':householdId', $householdId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Function to check for exisiting email address
function checkExistingEmail($userEmail) {
    $db = databaseConnect();
    $sql = 'SELECT userEmail FROM users WHERE userEmail = :userEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)) {
        return 0; // If array is empty, return zero
    }
    else {
        return 1;
    }
}

function getUser($userEmail){
    $db = databaseConnect();
    $sql = 'SELECT * FROM users WHERE userEmail = :userEmail'; // Do I need to add the householdId or leave it out?
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
}
?>