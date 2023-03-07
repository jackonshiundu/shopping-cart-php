<?php

//create sessions
session_start();
    require_once('php/CreateDb.php');
    require_once('./php/component.php');

    //create instance of CreateDb class
    $database=new CreatedDb(dbname:"ProductDB",tablename:"Producttb");

    if(isset($_POST['add'])){
        //print_r($_POST['product_id']);
        if(isset($_SESSION['cart'])){
            //print_r($_SESSION['cart']);

            $item_array_id=array_column($_SESSION['cart'],column_key:"product_id");
            if(in_array($_POST['product_id'],$item_array_id)){
                echo "<script> alert('Product is already added in the cart...!')</script>";
                echo "<script> window.location='index.php'</script>";
            }else{
               $count= count($_SESSION['cart']);
               $item_array=array(
                'product_id'=>$_POST['product_id']
               );

               $_SESSION['cart'][$count]=$item_array;
            }
        }else{
            $item_array=array(
                'product_id'=>$_POST['product_id']
            );
            //create session
            $_SESSION['cart'][0]=$item_array;

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
    <title>Shopping cart</title>
</head>
<body>
    <?php
    require_once('php/header.php')
    ?>
    <div class='container'>
        <div class='row text-center py-5 '>
            <?php
                $result=$database->getData();
                while($row= mysqli_fetch_assoc($result)){
                    components($row['product_name'],$row['product_image'],$row['product_price'],
                    $row['id']);
                }
            ?>
        </div>
    </div>
<script src="./bootstrap/js/bootstrap.min.js"></script>
</body>
</html>