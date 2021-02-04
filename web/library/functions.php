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
