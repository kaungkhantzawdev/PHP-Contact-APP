<?php

session_start();


function conn(){
    return mysqli_connect('localhost', 'root', '' ,'contact');
}
if(!conn()){
    die("Fail connect Database".mysqli_connect_error(con()));
}
ini_set("display_errors","1");
