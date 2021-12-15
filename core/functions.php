<?php

//common
function alert( $message,$color="danger"){
    echo "<p class='alert alert-$color p-2'>$message</p>";
}

function runQuery($sql){
    $conn = conn();
    $query = mysqli_query($conn,$sql);
    if(!$query){
        die("Fail Query".mysqli_error($conn));
    }else{
        return true;
    };
}

function linkTo($link='index.php'){
    return "<script>location.href='$link'</script>";
}

function textFilter($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlentities($data, ENT_QUOTES);
    return $data;
}

//for validation

function oldData($inputName){
    if(isset($_POST[$inputName])){
        return $_POST[$inputName];
    }else{
        return "";
    }
}


function setError($inputName, $message){
    return $_SESSION['error'][$inputName] = $message;
}

function getError($inputName){
    if(isset($_SESSION['error'][$inputName])){
        return $_SESSION['error'][$inputName];
    }else{
        return "";
    }
}

function clearError(){
    return $_SESSION['error'] = [];
}

function create(){

    $errorStatus = 0;
    $name = "";
    $email = "";
    $phone = "";
    $photo = "";
    if(empty($_POST['name'])){
        setError("name","Name is required.");
        $errorStatus = 1;
    }else{
        if(strlen($_POST['name']) < 5){
            setError("name","Name is too Short.");
            $errorStatus = 1;
        }else{
            if(strlen($_POST['name']) > 20){
                setError("name","Name is too Long.");
                $errorStatus = 1;
            }else{
                if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['name'])){
                    setError("name","Only letters and white space allowed.");
                    $errorStatus = 1;
                }else{
                    $name = textFilter($_POST['name']);
                }
            }
        }
    }

    if(empty($_POST['phone'])){
        setError("phone", "Phone is required.");
        $errorStatus = 1;
    }else{
        if(strlen($_POST['phone']) > 20){
            setError("phone", "Phone number is less than twenty.");
            $errorStatus = 1;
        }else{
            if(!preg_match("/^[0-9-' ]*$/",$_POST['phone'])){
                setError("phone", "Only letters and white space allowed");
                $errorStatus = 1;
            }else{
                $phone = textFilter($_POST['phone']);
            }
        }
    }

    if(empty($_POST['email'])){
        setError("email","Email is required.");
        $errorStatus = 1;
    }else{
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            setError("email", "Invalid Email format.");
            $errorStatus = 1;
        }else{
            $email = textFilter($_POST['email']);
        }
    }

    if($_FILES['upload']['name']){
        $imageSupport = ['image/png','image/jpeg'];
        $imageType = $_FILES['upload']['type'];

        if(in_array($imageType, $imageSupport)){
            $imageName = $_FILES['upload']['name'];
            $tmpName = $_FILES['upload']['tmp_name'];
            $dir = "store/";
            $photo = uniqid().$imageName;
            move_uploaded_file($tmpName, $dir.$photo);
        }else{
            setError("upload", "This file is not support.");
            $errorStatus = 1;
        }

    }else{
        setError("upload", "Photo is required.");
        $errorStatus = 1;
    }

    if(!$errorStatus){
        $sql = "INSERT INTO contacts (name, email, photo, phoneNumber) VALUES ('$name','$email','$photo', '$phone')";
        return runQuery($sql);
    }

}

//for index

function contacts(){
    $sql = "SELECT * FROM `contacts` ORDER BY id DESC";
    $query = mysqli_query(conn(),$sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)){
        array_push($rows, $row);
    }
    return $rows;
}

function contact($id){
    $sql = "SELECT * FROM `contacts` WHERE id='$id'";
    $query = mysqli_query(conn(),$sql);
    return  mysqli_fetch_assoc($query);
}

//for delete
function delete($id){
    $sql = "DELETE FROM `contacts` WHERE id= '$id'";
    return runQuery($sql);
}

//for edit
function edit($id){

        $id = $_GET['id'];
        $errorStatus = 0;
        $name = "";
        $email = "";
        $phone = "";
        $photo = "";
        if(empty($_POST['name'])){
            setError("name","Name is required.");
            $errorStatus = 1;
        }else{
            if(strlen($_POST['name']) < 5){
                setError("name","Name is too Short.");
                $errorStatus = 1;
            }else{
                if(strlen($_POST['name']) > 20){
                    setError("name","Name is too Long.");
                    $errorStatus = 1;
                }else{
                    if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['name'])){
                        setError("name","Only letters and white space allowed.");
                        $errorStatus = 1;
                    }else{
                        $name = textFilter($_POST['name']);
                    }
                }
            }
        }

        if(empty($_POST['phone'])){
            setError("phone", "Phone is required.");
            $errorStatus = 1;
        }else{
            if(strlen($_POST['phone']) > 20){
                setError("phone", "Phone number is less than twenty.");
                $errorStatus = 1;
            }else{
                if(!preg_match("/^[0-9-' ]*$/",$_POST['phone'])){
                    setError("phone", "Only letters and white space allowed");
                    $errorStatus = 1;
                }else{
                    $phone = textFilter($_POST['phone']);
                }
            }
        }

        if(empty($_POST['email'])){
            setError("email","Email is required.");
            $errorStatus = 1;
        }else{
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                setError("email", "Invalid Email format.");
                $errorStatus = 1;
            }else{
                $email = textFilter($_POST['email']);
            }
        }

        if($_FILES['upload']['name']){
            $imageSupport = ['image/png','image/jpeg'];
            $imageType = $_FILES['upload']['type'];

            if(in_array($imageType, $imageSupport)){
                $imageName = $_FILES['upload']['name'];
                $tmpName = $_FILES['upload']['tmp_name'];
                $dir = "store/";
                $photo = uniqid().$imageName;
                move_uploaded_file($tmpName, $dir.$photo);
            }else{
                setError("upload", "This file is not support.");
                $errorStatus = 1;
            }

        }else{
            setError("upload", "Photo is required.");
            $errorStatus = 1;
        }

        if(!$errorStatus){
            $sql = "UPDATE contacts SET name='$name', email='$email', photo='$photo', phoneNumber='$phone' WHERE id='$id'";
            return runQuery($sql);
        }




}
ini_set("display_errors",1);

