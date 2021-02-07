<?php
//This is the budgets model

function getAllBudgets($budgetName, $budgetAmount, $categoryId, $householdId){
    $db = databaseConnect();
    $sql = 'SELECT budgets.*, categories."categoryName" FROM budgets INNER JOIN categories ON budgets."categoryId" = categories."categoryId" WHERE budgets."householdId" = :householdId';
    if(!empty($budgetName)){
        $sql .= ' AND lower("budgetName") LIKE :budgetName';
     }
     if(!empty($budgetAmount)){
        $sql .= ' AND "budgetAmount" = :budgetAmount';
     }
     if(!empty($categoryId)){
        $sql .= ' AND "categoryId" = :categoryId';
     }
 
     if(!empty($userId)){
         $sql .= ' AND "userId" = :userId';
     }

     $stmt = $db->prepare($sql);

    if(!empty($budgetName)){
        strtolower($budgetName);
        $stmt->bindValue(':budgetName', '%'.$budgetName.'%', PDO::PARAM_STR);
    }

    if(!empty($budgetAmount)){
        $stmt->bindValue(':budgetAmount', $budgetAmount, PDO::PARAM_INT);
    }

    if(!empty($categoryId)){
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    }

    $stmt->bindValue(':householdId', $householdId, PDO::PARAM_INT);

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