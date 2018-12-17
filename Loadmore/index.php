<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    
    include_once "IndexModel.php";
  
            $model = new IndexModel;
            $product= $model->loadProductIndex();
           
            foreach($product as $p){ 
           
                echo "
                <div class='col-md-4 product-men'>
                <div class='men-pro-item simpleCart_shelfItem'>
                    <div class='men-thumb-item'>
                        <img src='images/products/$p->image' alt=''>
                        <div class='men-cart-pro'>
                            <div class='inner-men-cart-pro'>
                                <a href='single.html' class='link-product-add-cart'>Quick View</a>
                            </div>
                        </div>
                        <span class='product-new-top'>New</span>
                    </div>
                    <div class='item-info-product '>
                        <h4>
                            <a href='single.html'>$p->name</a>
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
         
            
    ?>
    <!-- loadmore -->
        <div class="product-sec1">
           
                <div class="show_more_main" id="show_more_main<?=$p->id?>">
                    <span id="<?=$p->id?>" class="show_more" title="Load more posts">Show more</span>
                    <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
               
            </div>
        </div>
		<!-- endloadmore -->
			<script >
		$(document).ready(function(){
			$(document).on('click','.show_more',function(){
				var ID = $(this).attr('id');
				$('.show_more').hide();
				$('.loding').show();
				$.ajax({
					type:'POST',
					url:'ajax_more.php',
					data:'id='+ID,
					success:function(html){
						$('#show_more_main'+ID).remove();
						$('.product-sec1').append(html);
					}
				});
			});
		});
		</script>
</body>
</html>