<?php
require_once 'core/base.php';
require_once 'core/functions.php';

//if(empty($_GET)){
//    echo linkTo();
//}else{
//    if($_GET['id'] != ""){
//        $id = $_GET['id'];
//    }else{
//        echo "<a href='index.php' class='btn btn-info'>Go to List</a>";
//        return  alert("Contact is not found.");
//    }
//}

$id = $_GET['id'];

$fileFromDelete = contact($id)['photo'];
unlink("store/$fileFromDelete");
if(delete($id)){
    header("location:index.php");
}