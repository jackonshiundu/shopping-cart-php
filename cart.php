<?php
    session_start();
    require_once('php/CreateDb.php');
    require_once('./php/component.php');

    $db=new CreatedDb(dbname:"ProductDB",tablename:"Producttb");

    if(isset($_POST['remove'])){
        if($_GET['action']=='remove'){
            foreach($_SESSION['cart'] as $key=>$value){
                if($value['product_id']==$_GET['id']){
                    unset($_SESSION['cart'][$key]);
                    echo "<script>alert('Product has been removed')</script>";
                    echo "<script>window.location=='cart.php'</script>";
                }
            }
        }
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <title>Cart</title>
</head>
<body class='bg-light'>
    <?php
        require_once('php/header.php')
    ?>
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart ">
                    <h6>My Cart</h6>
                    <hr>
                    <?php
                       $total=0;
                       if(isset($_SESSION['cart'])){
                        $product_id=array_column($_SESSION['cart'],column_key:'product_id');
                        
                        $results=$db->getData();
                        while($row=mysqli_fetch_assoc($results)){
                            //print_r($row);
                            foreach($product_id as $id){
                                if($row['id']==$id){
                                    cartComp($row['product_image'],$row['product_name'],$row['product_price'],$row['id']);
                                    $total=$total+(int)$row['product_price'];
                                }
                            }
                        }
                       }else{
                        echo "<h5>Cart Is Empty</h5>";
                       }
                    ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if(isset($_SESSION['cart'])){
                                $count=count($_SESSION['cart']);
                                echo "<h5>Price: ($count)</h5>";
                            }else{
                                echo "<h5>Price: (0)</h5>";
                            }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>
                                <?php
                                    echo $total;
                                ?>
                            </h6>
                            <h6 class='text-success'>Free</h6>
                            <hr>
                            <h6>
                                KES <?php
                                    echo $total;
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="./bootstrap/js/bootstrap.min.js"></script>
</body>
</html>