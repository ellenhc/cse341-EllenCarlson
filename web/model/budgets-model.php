<?php
//This is the budgets model

function getAllBudgets(){
    $db = databaseConnect();
    $sql = 'SELECT budgets.*, categories."categoryName" FROM budgets INNER JOIN categories ON budgets."categoryId" = categories."categoryId"';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $list;
}

function getOneBudget($budgetId){
    $db = databaseConnect();
    $sql = 'SELECT budgets.*, categories."categoryName" FROM budgets INNER JOIN categories ON budgets."categoryId" = categories."categoryId" WHERE "budgetId" = :budgetId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':budgetId', $budgetId, PDO::PARAM_INT);
    $stmt->execute();
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $details[0];
}
?>