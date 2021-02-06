<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function buildCategoryList($categories){
    $categoryList = '<select name="categoryId" id="categoryId">'; 
    $categoryList .= "<option selected>Any Category</option>"; 
    foreach ($categories as $category) { 
     $categoryList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $categoryList .= '</select>'; 
    return $categoryList; 
}

function buildUserList($users){
    $userList = '<select name="userId" id="userId">';
    $userList .= "<option selected>Any Submitter</option>";
    foreach($users as $user){
        $userList .= "<option value='$user[userId]'>$user[userFirstName]</option>"; 
    }
    $userList .= '</select>'; 
    return $userList;
}

function listOfExpenses($expenses){
    $view = "<div class='expense-list'>";
    foreach($expenses as $expense){
        $view .= "<div class='expense-card'>";
        $view .= "<div class='expense-date'>$expense[expenseDate]</div>";
        $view .= "<div class='expense-text'><div class='expense-name'><a href='/expenses/?action=details&id=".urlencode($expense['expenseId'])."'>$expense[expenseName]</a></div>";
        $view .= "<div class='expense-price'>$expense[expensePrice]</div></div>";
        $view .= "</div>";
    }
    $view .= "</div>";
    return $view;
}

function buildExpenseDetails($details){
    $view = "<h1>$details[expenseName]</h1>";
    $view .= "<h2>$details[expensePrice]</h2>";
    $view .= "<p>$details[expenseDate]</p>";
    //$view .= "<p>$details[categoryId]</p>";
    //Want to show the category it's under....
    return $view;
}
