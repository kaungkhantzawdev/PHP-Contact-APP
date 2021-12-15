<?php
require_once 'core/base.php';
require_once 'core/functions.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Validation</title>
    <link rel="icon" href="img/forAdd.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/feather-icons-web/feather.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark">

<section class="container">
    <div class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body m-4">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12">
                            <div class="mb-5">
                                <h4 class="mb-3 text-center text-info" style="font-weight: 600"><i class="feather-edit-2 me-2" style="font-weight: 600"></i> Edit Contact</h4>
                                <h4 class="text-end"><a href="index.php" class="btn btn-outline-info"><i class="feather-list me-2"></i>contact list</a></h4>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3 mb-md-0 me-0 me-md-2 d-flex align-items-center justify-content-center h-100 ">
                                <img src="img/forAdd.png" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <?php
                            $nums = [];
                            foreach (contacts() as $num){
                                array_push($nums, $num['id']);
                            }

                            if(empty($_GET)){
                                echo linkTo();
                            }else{
                                if($_GET['id'] != ""){
                                    if(in_array($_GET['id'], $nums)){
                                        if(isset($_POST['edit'])){
                                            if(edit($_GET['id'])){
                                                echo linkTo();
                                            }
                                        }
                                    }else{
                                        echo "<a href='index.php' class='btn btn-info mb-2'>Go to Back</a>";
                                        return  alert("Contact is not found.");
                                    }

                                }else{
                                    echo "<a href='index.php' class='btn btn-info mb-2'>Go to Back</a>";
                                    return  alert("Contact is not found.");

                                }
                                $id = $_GET['id'];

                            }


                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $id;?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-primary"><i class="feather-user me-2"></i> Name</label>
                                    <input type="text" id="name" name="name" value="<?php echo textFilter(contact($id)['name']); ?>" class="form-control" aria-describedby="passwordHelpBlock">
                                    <?php if (getError('name')){ ?>
                                        <div id="passwordHelpBlock" class="form-text text-danger">
                                            <?php echo getError('name') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label text-primary"><i class="feather-phone me-2"></i> Phone</label>
                                    <input type="text" id="phone" name="phone" value="<?php echo textFilter(contact($id)['phoneNumber']);?>" class="form-control">
                                    <?php if (getError('phone')){ ?>
                                        <div id="passwordHelpBlock" class="form-text text-danger">
                                            <?php echo getError('phone') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-primary"><i class="feather-mail me-2"></i> Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo textFilter(contact($id)['email']); ?>" class="form-control" >
                                    <?php if (getError('email')){ ?>
                                        <div id="passwordHelpBlock" class="form-text text-danger">
                                            <?php echo getError('email') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="upload" class="form-label text-primary"><i class="feather-image"></i> Photo</label>
                                    <input type="file" name="upload" id="upload" class="form-control" >
                                    <?php if (getError('upload')){ ?>
                                        <div id="passwordHelpBlock" class="form-text text-danger">
                                            <?php echo getError('upload') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="mt-5 d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                        <label class="form-check-label text-primary" for="flexCheckDefault">
                                            Correct
                                        </label>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-info" name="edit">Create</button>
                                    </div>
                                </div>
                            </form>
                            <?php clearError(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>