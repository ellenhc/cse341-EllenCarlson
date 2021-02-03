<?php
//This is the main model

//Function to get the category classifications
function getCategories(){
    $db = databaseConnect();
    $sql = 'SELECT categoryId, categoryName FROM categories';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $stmt->closeCursor();
    return $categories; //returns data back to the controller
}

function getUsers(){
    $db = databaseConnect();
    $sql = 'SELECT userId, userfirstname, userlastname FROM users';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    $stmt->closeCursor();
    return $users; //returns data back to the controller
}
?>