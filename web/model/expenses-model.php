<?php
//This is the expenses model

// Get expenses by expense's name
function getExpensesByName($expensename){
    $db = databaseConnect();
    $sql = 'SELECT * FROM expenses WHERE expensename = :expensename';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':expensename', $expensename, PDO::PARAM_STR);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $list;
}

// Get expenses by categoryId
function getExpensesByCategory($categoryid){
    $db = databaseConnect();
    $sql = 'SELECT * FROM expenses WHERE categoryid = :categoryid';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':categoryid', $categoryid, PDO::PARAM_INT);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $list;
}
?>