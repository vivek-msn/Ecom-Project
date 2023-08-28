<?php
require('top.inc.php');

$order_id=get_safe_value($con,$_GET['id']);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Order Detail </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                           <table class="table">                                    
                                       <thead>
                                           <tr>
                                                <th class="product-thumbnail">Product Name</th>
                                                <th class="product-thumbnail">Product Image</th>
                                                <th class="product-name">Qty</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-price">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php
                                            $uid=$_SESSION['USER_ID'];
                                            $res=mysqli_query($con,"SELECT DISTINCT order_detail.id, order_detail.*, product.name, product.image
                                            FROM order_detail, product, `order`
                                            WHERE order_detail.order_id = '$order_id'
                                            AND order_detail.product_id = product.id");
                                            $total_price=0;
                                            while($row=mysqli_fetch_assoc($res)){
                                            $total_price=$total_price+($row['qty']*$row['price']);
                                            ?>
                                            
                                            <tr>                                               
                                                <td class="product-name"><?php echo $row['name']?></td>     
                                                <td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
                                                <td class="product-name"><?php echo $row['qty']?></td>
                                                <td class="product-name"><?php echo $row['price']?></td>
                                                <td class="product-name"><?php echo $row['qty']*$row['price']?></td>
                                            </tr>
                                            <?php  } ?>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name"><?php echo $total_price?></td>
                                            </tr>
                                        </tbody>                  
                              </table>
                              <div id="address_details">
                                 <strong>Address</strong>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
        <?php
        require('footer.inc.php');
        ?>