<?php
include './includes/dataBase.php';

if(isset($_POST['id']) && isset($_POST['account_head_name'])){
    echo $id = $_POST['id'];
    echo $account_head_name = $_POST['account_head_name'];
    
    
    $query_update = mysql_query("UPDATE `account_heads` SET `account_head_name` = '".$account_head_name."' WHERE `id` = '".$id."'");
    if($query_update){
        echo 'Awesome';
    }else{
        echo 'Nope';
    }
    
}
if(isset($_POST['id']) && isset($_POST['action'])){
    $id = $_POST['id'];
    $action = $_POST['action'];
    
    if($action == 'delete'){
        $query_del = mysql_query("DELETE FROM `account_heads` WHERE `id` = '".$id."'");
        if($query_del){
            echo 'Awesome';
        }else{
            echo 'Nope!';
        }
    }
}