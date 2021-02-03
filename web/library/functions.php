<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function buildCategoryList($categories){
    $categoryList = '<select name="categoryId" id="categoryId">'; 
    $categoryList .= "<option disabled selected>Choose a category</option>"; 
    foreach ($categories as $category) { 
     $categoryList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
     if(isset($categoryId)){
         if($category['categoryId'] === $categoryId){
             $categoryList .= ' selected ';
            }
        }
    } 
    $categoryList .= '</select>'; 
    return $categoryList; 
}

/*$categoryList = '<select id="categoryId" name="categoryId">';
$categoryList .= '<option value="" disabled selected hidden>Choose a category</option>';
foreach ($categories as $category) {
    $categoryList .= "<option value='$category[categoryId]'";
    if(isset($categoryId)){
        if($category['categoryId'] === $categoryId){
            $categoryList .= ' selected ';
        }
    }
}
$categoryList .= ">$category[categoryName]</option>";
$categoryList .= '</select>';*/
