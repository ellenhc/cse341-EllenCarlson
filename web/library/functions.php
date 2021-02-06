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
        $view .= "<div class='expense-text'><a class='expense-name' href='/expenses/?action=details&id=".urlencode($expense['expenseId'])."'>$expense[expenseName]</a>";
        $view .= "<div class='expense-price'>$expense[expensePrice]</div></div>";
        $view .= "</div><hr>";
    }
    $view .= "</div>";
    return $view;
}

function buildExpenseDetails($details){
    $view = "<h3>$details[expenseDate] | $details[expenseName]</h3>";
    $view .= "<h3>$details[expensePrice]</h3>";
    $view .= "<div><h3>Category</h3>";
    $view .= "<p>$details[categoryName]</p></div>";
    $view .= "<div><h3>Submitted by</h3>";
    $view .= "<p>$details[userFirstName] $details[userLastName]</p></div>";
    return $view;
}
