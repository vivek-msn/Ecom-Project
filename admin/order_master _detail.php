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
                                        
                                       <?php                                                                                 
                                       $res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where order_status.id=`order`.order_status");                                            
                                       while($row=mysqli_fetch_assoc($res)){                                                
                                       ?>                                          
                                       <tr>
                                          <td class="product-add-to-cart"><a href="order_master_details.php?id=<?php echo $row['id']?>"><?php echo $row['id']?></a></td>
                                          <td class="product-name"><?php echo $row['added_on']?></td>     
                                          <td class="product-name">
                                          <?php echo $row['address']?><br/>
                                          <?php echo $row['city']?><br/>
                                          <?php echo $row['pincode']?><br/>
                                          </td>
                                          <td class="product-name"><a href="#"><?php echo $row['payment_type']?></a></td>
                                          <td class="product-price"><span class="amount"><?php echo $row['payment_status']?></span></td>
                                          <td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $row['order_status']?></span></td>                                                
                                       </tr>
                                       <?php  } ?>
                                    </tbody>                       
                           </table>
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