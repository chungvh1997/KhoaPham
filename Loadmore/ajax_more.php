<?php
   if(!empty($_POST["id"])){

    // Include the database configuration file
    include_once "IndexModel.php";
    $a = new IndexModel;
     $check= $a->loadMoreAjax($_POST["id"]);
    $totalRowCount= $check->num_rows;

    $showLimit = 3;
    
    // Get records from the database
   $check = $a->getRecords($_POST["id"],$showLimit);

    if(!empty($check)){ 
        //showproduct
   foreach($check as $product){
        echo "
        <div class='col-md-4 product-men'>
        <div class='men-pro-item simpleCart_shelfItem'>
            <div class='men-thumb-item'>
                <img src='images/products/$product->image' alt=''>
                <div class='men-cart-pro'>
                    <div class='inner-men-cart-pro'>
                        <a href='single.html' class='link-product-add-cart'>Quick View</a>
                    </div>
                </div>
                <span class='product-new-top'>New</span>
            </div>
            <div class='item-info-product '>
                <h4>
                    <a href='single.html'>$product->name</a>
                </h4>
                <div class='info-product-price'>
                    <span class='item_price'>$149.00</span>
                    <del>$280.00</del>
                </div>
                <div class='snipcart-details top_brand_home_details item_add single-item hvr-outline-out'>
                    <form action='#' method='post'>
                        <fieldset>
                            <input type='hidden' name='cmd' value='_cart' />
                            <input type='hidden' name='add' value='1' />
                            <input type='hidden' name='business' value=' ' />
                            <input type='hidden' name='item_name' value='Almonds, 100g' />
                            <input type='hidden' name='amount' value='149.00' />
                            <input type='hidden' name='discount_amount' value='1.00' />
                            <input type='hidden' name='currency_code' value='USD' />
                            <input type='hidden' name='return' value=' ' />
                            <input type='hidden' name='cancel_return' value=' ' />
                            <input type='submit' name='submit' value='Add to cart' class='button' />
                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
    </div>
        ";
   }
   if($totalRowCount > $showLimit){
       echo "<div class='show_more_main' id='show_more_main$product->id'>
       <span id='$product->id' class='show_more' title='Load more posts'>Show more</span>
       <span class='loding' style='display: none;'><span class='loding_txt'>Loading...</span></span>
   </div>";
   }
}
    

    
}
?>