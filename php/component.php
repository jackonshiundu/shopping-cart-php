<?php
function components($productname,$productimage,$productprice,$product_id){

    $element= "
<div class='col-md-3 col-sm-6 my-3 my-md-0'>
    <form action='index.php' method='post'>
        <div class='card mb-8 shadow'>
            <div class='img-comtainer'>
                <img src='./images/$productimage' alt='image1' class='img-fluid card-img-top'>
            </div>
            <div class='card-body'>
                <h5 class='card-title'>$productname</h5>
                <h6>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='far fa-star'></i>
                </h6>
                <p class='card-text'>
                    some quick example text to build on the card.
                </p>
                <h5>
                    <small class='text-secondary'>
                        <s >KES.519</s>
                    </small>
                    <span class='price'>KES.$productprice</span>
                </h5>
                <button class='btn btn-warning my-3' type='submit' name='add'> Add to Cart <i class='fas fa-shopping-cart'></i> </button>
                <input type='hidden' name='product_id' value='$product_id'>
            </div>
        </div>
    </form>
</div>
    ";
    echo $element;
}


function cartComp($productIMG,$productname,$productprice,$productid){
    $element="
    <form action='cart.php?action=remove&id=$productid' method='post'class='cart-items'>
    <div class='border rounded'>
        <div class='row bg-white contain'>
            <div class='col-md-3 pl-0'>
                <img src='./images/$productIMG' alt='image1' class='img-fluid'>
            </div>
            <div class='col-md-6 py-4'>
                <h5 class='pt-2'>$productname</h5>
                <small class='text-secondary'>Seller:Daily Dat</small>
                <h5 class='pt-2'>KES.$productprice</h5>
                <button type='submit' class='btn btn-warning'>Save For later</button>
                <button type='submit' class='btn btn-danger mx-2' name='remove'>Remove</button>
            </div>
            <div class='col-md-3 py-5'>
                <div>
                    <button type='button' class='btn bg-light border rounded-circle'>
                        <i class='fas fa-minus'></i>
                    </button>
                    <input type='text' value='1' class='form-control w-25 d-inline'>
                    <button type='button' class='btn bg-light border rounded-circle'>
                        <i class='fas fa-plus'></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>";

echo $element;
}
?>