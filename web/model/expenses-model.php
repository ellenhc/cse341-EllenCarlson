<?php
//This is the expenses model

function searchExpenses($expenseName, $dateRange, $categoryId, $userId, $householdId){
    $db = databaseConnect();

    //default statement to pull EVERYTHING for a household
    $sql = 'SELECT expenses.*, users."userFirstName", users."userLastName", categories."categoryName" FROM expenses INNER JOIN categories ON expenses."categoryId" = categories."categoryId"';
    $sql .= ' INNER JOIN users ON expenses."userId" = users."userId" WHERE expenses."householdId" = :householdId ';

    if(!empty($expenseName)){
       // $sql .= ' AND "expenseName" LIKE :expenseName';
       $sql .= ' AND lower("expenseName") LIKE :expenseName';
    }

    if(!empty($dateRange)){
        $sql .= ' AND "expenseDate" BETWEEN :startDate AND :endDate';
    }

    if(!empty($categoryId)){
       $sql .= ' AND expenses."categoryId" = :categoryId';
       
    }

    if(!empty($userId)){
        $sql .= ' AND expenses."userId" = :userId';
    }

    /*if(empty($householdId)){
        THROW AN ERROR IF IT IS EMPTY
    }*/
    $sql .= ' ORDER BY expenses."expenseDate" DESC';
   
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

// Gets ALL of a households transactions
function getAllExpenses($householdId){
    $db = databaseConnect();
    $sql = 'SELECT * FROM expenses WHERE "householdId" = :householdId ORDER BY expenses."expenseDate" DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':householdId', $householdId, PDO::PARAM_INT);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $list;
}

// Returns data needed for the overview pie chart on dashboard
function getExpenseOverview($householdId){
    $db = databaseConnect();
    $sql = 'SELECT categories."categoryName", grouped_expenses.*  FROM (
        SELECT expenses."categoryId", SUM("expensePrice") FROM expenses 
        WHERE expenses."householdId" = :householdId
        GROUP BY expenses."categoryId" 
    ) as grouped_expenses
    INNER JOIN categories ON grouped_expenses."categoryId" = categories."categoryId"  
    ORDER BY grouped_expenses."categoryId" ASC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':householdId', $householdId, PDO::PARAM_INT);
    $stmt->execute();
    $sum = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $sum;
}

// Returns a week's worth of transactions from all users in a household
function populateRecentTransactions($dateRange, $householdId){
    $db = databaseConnect();

    //default statement to pull EVERYTHING for a household
    $sql = 'SELECT expenses.*, users."userFirstName", users."userLastName", categories."categoryName" FROM expenses INNER JOIN categories ON expenses."categoryId" = categories."categoryId"';
    $sql .= ' INNER JOIN users ON expenses."userId" = users."userId" WHERE expenses."householdId" = :householdId';

    if(!empty($dateRange)){
        $sql .= ' AND "expenseDate" BETWEEN :startDate AND :endDate';
    }
   
    $stmt = $db->prepare($sql);
    
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

// Adds a NEW expense to the database
function addNewExpense($expenseName, $expensePrice, $expenseDate, $categoryId, $userId, $householdId){
    $db = databaseConnect();
    $sql = 'INSERT INTO expenses("expenseName", "expensePrice", "expenseDate", "categoryId", "userId", "householdId") VALUES (:expenseName, :expensePrice, :expenseDate, :categoryId, :userId, :householdId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':expenseName', $expenseName, PDO::PARAM_STR);
    $stmt->bindValue(':expensePrice', $expensePrice, PDO::PARAM_STR);
    $stmt->bindValue(':expenseDate', $expenseDate, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':householdId', $householdId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Deletes an expense from the database
function deleteExpense($expenseId){
    $db = databaseConnect();
    $sql = 'DELETE FROM expenses WHERE "expenseId" = :expenseId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':expenseId', $expenseId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function updateExpense($expenseId, $expenseName, $expensePrice, $expenseDate, $categoryId, $userId, $householdId){
    $db = databaseConnect();
    $sql = 'UPDATE expenses SET "expenseName" = :expenseName, "expensePrice" = :expensePrice, "expenseDate" = :expenseDate, "categoryId" = :categoryId, "userId" = :userId, "householdId" = :householdId WHERE "expenseId" = :expenseId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':expenseId', $expenseId, PDO::PARAM_INT);
    $stmt->bindValue(':expenseName', $expenseName, PDO::PARAM_STR);
    $stmt->bindValue(':expensePrice', $expensePrice, PDO::PARAM_STR);
    $stmt->bindValue(':expenseDate', $expenseDate, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':householdId', $householdId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
?>