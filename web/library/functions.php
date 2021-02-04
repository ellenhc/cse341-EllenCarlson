<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function buildCategoryList($categories){
    $categoryList = '<select name="categoryid" id="categoryid">'; 
    $categoryList .= "<option selected>Any Category</option>"; 
    foreach ($categories as $category) { 
     $categoryList .= "<option value='$category[categoryid]'>$category[categoryname]</option>"; 
    } 
    $categoryList .= '</select>'; 
    return $categoryList; 
}

function buildUserList($users){
    $userList = '<select name="userid" id="userid">';
    $userList .= "<option selected>Any Submitter</option>";
    foreach($users as $user){
        $userList .= "<option value='$user[userid]'>$user[userfirstname]</option>"; 
    }
    $userList .= '</select>'; 
    return $userList;
}
