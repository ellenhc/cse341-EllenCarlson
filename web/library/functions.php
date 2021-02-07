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

function listOfBudgets($budgets){
    $view = "<div class='budget-list>";
    foreach($budgets as $budget){
        $view .= "<div class='budget-card'>";
        $view .= "<div class='budget-category'>$budget[categoryName]</div>";
        $view .= "<div class='budget-text'><a class='budget-name' href='/budgets/?action=details&id=".urlencode($budget['budgetId'])."'>$budget[budgetName]</a>";
        $view .= "<div class='budget-amount'>$budget[budgetAmount]</div></div>";
        $view .= "</div><hr>";
    }
    $view .= "</div>";
    return $view;
}

function buildBudgetDetails($details){
    $view = "<h3>$details[budgetName]</h3>";
    $view .= "<h2>$details[budgetAmount]</h2>";
    $view .= "<h2>$details[categoryName]</h2>";
    return $view;
}
