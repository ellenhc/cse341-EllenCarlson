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
    print_r($categories);
    return $categories; //returns data back to the controller
}
?>