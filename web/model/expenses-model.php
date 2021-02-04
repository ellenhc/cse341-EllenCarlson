<?php
//This is the expenses model

function expenseSearch($expensename, $daterange, $categoryid, $userid){
    $db = databaseConnect();

    //default statement to pull EVERYTHING for a household
    $sql = 'SELECT * FROM expenses WHERE householdid = :householdid';

    if(!empty($expensename)){
        $sql .= ' AND expensename LIKE :expensename';
    }

    if(!empty($daterange)){
        $sql .= ' AND expensedate BETWEEN :value1 AND :value2';
    }

    if(!empty($categoryid)){
        $sql .= ' AND categoryid = :categoryid';
    }

    if(!empty($userid)){
        $sql .= ' AND userid = :userid';
    }

    echo $sql;

    /*$stmt = $db->prepare($sql);
    $stmt->bindValue(':expensename', $expensename, PDO::PARAM_STR);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $list;*/
}
?>