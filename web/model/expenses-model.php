<?php
//This is the expenses model

function expenseSearch($expenseName, $dateRange, $categoryId, $userId, $householdId){
    $db = databaseConnect();

    //default statement to pull EVERYTHING for a household
    $sql = 'SELECT expenses.*, users."userFirstName", users."userLastName", categories."categoryName" FROM expenses INNER JOIN categories ON expenses."categoryId" = categories."categoryId"';
    $sql .= ' INNER JOIN users ON expenses."userId" = users."userId" WHERE expenses."householdId" = :householdId';

    if(!empty($expenseName)){
       // $sql .= ' AND "expenseName" LIKE :expenseName';
       $sql .= ' AND lower("expenseName") LIKE :expenseName';
    }

    if(!empty($dateRange)){
        $sql .= ' AND "expenseDate" BETWEEN :startDate AND :endDate';
    }

    if(!empty($categoryId)){
       $sql .= ' AND "categoryId" = :categoryId';
       
    }

    if(!empty($userId)){
        $sql .= ' AND "userId" = :userId';
    }

    /*if(empty($householdId)){
        THROW AN ERROR IF IT IS EMPTY
    }*/
   
    $stmt = $db->prepare($sql);
    if(!empty($expenseName)){
        strtolower($expenseName);
        $stmt->bindValue(':expenseName', '%'.$expenseName.'%', PDO::PARAM_STR);
    }
    if(!empty($categoryId)){
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    }
    if(!empty($userId)){
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    }
    if(!empty($dateRange)){
        $startDate = new DateTime();
        $endData = new DateTime();
        $startDate->modify("-$dateRange day");
        $stmt->bindValue(':startDate', $startDate->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $endData->format('Y-m-d H:i:s'), PDO::PARAM_STR);
    }
    $stmt->bindValue(':householdId', $householdId, PDO::PARAM_INT);

    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $list;
}

function getOneExpense($expenseId){
    $db = databaseConnect();
    $sql = 'SELECT expenses.*, users."userFirstName", users."userLastName", categories."categoryName" FROM expenses INNER JOIN categories ON expenses."categoryId" = categories."categoryId" INNER JOIN users ON expenses."userId" = users."userId" WHERE "expenseId" = :expenseId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':expenseId', $expenseId, PDO::PARAM_INT);
    $stmt->execute();
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $details[0];
}
?>