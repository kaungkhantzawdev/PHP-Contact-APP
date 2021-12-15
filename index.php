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
    <title>Contact</title>
    <link rel="icon" href="img/forIndex.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/feather-icons-web/feather.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark">

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-5">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="img/forIndex.png" alt="" class="me-5" style="width: 200px">
                        <div class="my-3">
                            <h1 class="mb-0 fw-bold text-uppercase text-info">Contact App</h1>
                        </div>

                    </div>
                    <div class="text-center">
                        <a href="contact_add.php" class="btn btn-info d-inline-block w-50">create contact</a>
                    </div>
                    <hr class="text-primary">
                    <table class="table table-bordered table-responsive table-hover text-center" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Control</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (contacts() as $item){ ?>
                            <tr>
                                <td class="align-middle"><?php echo $item['id']; ?></td>
                                <td class="align-middle"><div class="mx-auto"
                                    style=" width: 50px;
                                            background-image: url('store/<?php echo $item['photo']; ?>');
                                            height: 50px;
                                            border-radius: 50%;
                                            background-repeat: no-repeat;
                                            background-position: center;
                                            background-size: cover;
                                            "
                                    ></div></td>
                                <td class="align-middle"><?php echo $item['name']; ?></td>
                                <td class="align-middle" class="text-wrap"><?php echo $item['phoneNumber']; ?></td>
                                <td class="align-middle"><?php echo $item['email']; ?></td>
                                <td class="align-middle">
                                    <a href="edit.php?id=<?php echo $item['id'];?>" class="btn btn-outline-info btn-sm"><i class="feather-edit-2"></i></a>
                                    <a href="delete.php?id=<?php echo $item['id'];?>" onclick="return confirm('Are you sure to delete.');" class="btn btn-outline-danger btn-sm"><i class="feather-trash-2"></i></a>
                                </td>
                                <td class="text-wrap align-middle"><?php echo date("d-M-Y", strtotime($item['created_at'])); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>