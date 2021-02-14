<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function buildCategoryListSearch($categories){
    $categoryList = '<select name="categoryId" id="categoryId">'; 
    $categoryList .= "<option selected>Any Category</option>"; 
    foreach ($categories as $category) { 
     $categoryList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $categoryList .= '</select>'; 
    return $categoryList; 
}

// Creates dropdown selects for search forms
function buildUserListSearch($users){
    $userList = '<select name="userId" id="userId">';
    $userList .= "<option selected>Any Submitter</option>";
    foreach($users as $user){
        $userList .= "<option value='$user[userId]'>$user[userFirstName]</option>"; 
    }
    $userList .= '</select>'; 
    return $userList;
}

// Creates dropdown selects for NON-search instances
function buildCategoryList($categories, $categoryId = null){
    $categoryList = '<select name="categoryId" id="categoryId" required>'; 
    $categoryList .= "<option value='' disabled>Choose a category</option>"; 
    foreach ($categories as $category) { 
        $categoryList .= "<option value='$category[categoryId]'"; 
        if(isset($categoryId)){
            if($category['categoryId'] === $categoryId){
                $categoryList .= ' selected ';
            }
        }
        $categoryList .= ">$category[categoryName]</option>";
    }
    $categoryList .= '</select>'; 
    return $categoryList; 
}

function buildUserList($users, $userId = null){
    $userList = '<select name="userId" id="userId" required>';
    $userList .= "<option value='' disabled>Choose a user</option>";
    foreach($users as $user){
        $userList .= "<option value='$user[userId]'"; 
        if(isset($userId)){
            if($user['userId'] === $userId){
                $userList .= ' selected ';
            }
        }
        $userList .= ">$user[userFirstName]</option>";
    }
    $userList .= '</select>'; 
    return $userList;
}

function listOfExpenses($expenses){
    $view = "<div class='expense-list'>";
    foreach($expenses as $expense){
        $view .= "<div class='expense-card'><a class='expense-link' href='/expenses/?action=details&id=".urlencode($expense['expenseId'])."'><span class='expense-span'>";
        $view .= "<div class='expense-text'><p class='expense-date'>$expense[expenseDate]</p>";
        $view .= "<p class='expense-name'>$expense[expenseName]</p>";
        $view .= "<p class='expense-price'>$expense[expensePrice]</p></div>";
        $view .= "</span></a>";
        $view .= "<div class='button-wrap'><a class='button-link' href='/expenses/index.php?action=mod&id=" . urlencode($expense['expenseId']) . "' title='Click to edit'>Edit</a>";
        $view .= "<a class='button-link' href='/expenses/index.php?action=del&id=" . urlencode($expense['expenseId']) . "' title='Click to delete'>Delete</a></div></div><hr>";
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
    $view .= "<p>$details[userFirstName] $details[userLastName]</p></div><br>";
    return $view;
}

function listOfBudgets($budgets){
    $view = "<div class='budget-list>";
    foreach($budgets as $budget){
        $view .= "<div class='budget-text'><a href='/budgets/?action=details&id=".urlencode($budget['budgetId'])."'>$budget[budgetName] > $budget[categoryName]</a>";
        $view .= "<div class='budget-amount'>$budget[budgetAmount]</div>";
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
