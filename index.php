<?php
require_once 'includes/process.php';
require_once 'utility/utility.php';

$utility = new utility();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Search results for: <?php echo $keyword; ?></title>
      <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
   </head>
   <body class=" catalogsearch-result-index">
      <div class="wrapper">
         <div class="page">
            <!--header end-->
            <div class="content">
               <div class="main-container col2-left-layout">
                  <div class="main">
                     <div class="col-main">
                        <div class="clear"></div>
                        <div class="api-results">
                            <form action="" method="get">
                                <div class="confirmMobile" style="width:25%; margin:15px auto">
                                    <div align="left">
                                        <label style="width:75px; float:left">Keyword: </label>
                                        <input type="text" name="keyword" value="<?php echo $keyword; ?>" style="width:280px;" />
                                        <input type="hidden" name="Product" id="Product" value="Search"/>
                                    </div>
                                </div>
                                <div style="margin-top: 15px;">
                                    <input type="submit" name="action" value="Search" style="width:224px; font-size:19px" />
                                </div>
                            </form>
                        <div align="left" style="margin-top: 15px;"></div>
                            <?php
                                if($total_found){
                            ?>
                            <span class="info">
                            Your search for <b><i><?php echo $keyword; ?></i></b> 
                            having in <?php echo $total_found; ?> results
                            </span>
                            <div class="pagination">
                                <span>
                                    <?php if ($current_page != 1){ ?>
                                    <a class="page" href="<?php echo $utility->paginateUrl($current_url, ($current_page - 1), $keyword, $rows) ?>">Previous</a>
                                    <?php } ?>
                                    <span class="page active"><?php echo number_format($current_page)?> of <?php echo number_format(ceil($total_found / $rows))?></span>

                                    <?php if ($current_page < ceil($total_found / $rows)){ ?>
                                        <a class="page" href="<?php echo $utility->paginateUrl($current_url, ($current_page + 1), $keyword, $rows) ?>">Next</a>
                                    <?php } ?>
                                </span>
                            </div>
                            <?php } ?>
                            <div class="category-products">
                               
                        <?php
                         if($total_found){
                            foreach($result->products as $product)
                            {
                                $images = $product->image_urls;
                                foreach($images as $key=>$image)
                                {    
                                    //Need to display appropiate size product image
                                    if($key=='300x400'){
                                            foreach($image as $image_data){
                                                    $img['url'] = $image_data->url;
                                                    $img['width'] = $image_data->width;
                                                    $img['height'] = $image_data->height;
                                            }
                                            break;
                                    }else{
                                            //If 300x400 fails, let try another image from response object
                                            foreach($image as $image_data){
                                                    $img['url'] = $image_data->url;
                                                    $img['width'] = $image_data->width;
                                                    $img['height'] = $image_data->height;
                                                    break;
                                            }
                                    }
                                }
                                $sku = (array) $product->skus;
                            ?>
                               <div class="block">
                                 <div class="block_img">
                                    <a href="<?php echo $product->url; ?>" title="" class="product-image">
                                    <img src="<?php echo $img['url']; ?>" alt="" />
                                    </a>
                                 </div>
                                 <div class="block_footer">
                                    <div class="f-fix">
                                       <h2 class="product-name"><a href="<?php $product->url; ?>" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a></h2>
                                        <?php if (@$sku[0]->sale_price){ ?>
                                            Price: <span class="strike">$<?php echo $sku[0]->sale_price;?></span>
                                            <span class="salePrice">$<?php echo $sku[0]->msrp_price; ?></span>
                                        <?php }else{  ?>
                                            Price: <span class="salePrice">$<?php echo $sku[0]->msrp_price;?></span>
                                        <?php } ?>
                                       <p>
                                       <div class=prodDesc>
                                          <span class="fav_icon_div" rel="<?php echo $product->description; ?>" title="<?php echo $product->name; ?>" alt="3550">
                                          </span>
                                       </div>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                        <?php 
                            }
                        ?>
                            </div>
                        </div>
                        <div class="clear"></div>              
                        <?php
                        }elseif($result===false){
                        ?>
                            <span class="info">
                                Request not completed.
                            </span>
                        <?php
                        }elseif($error){
                        ?>
                                <span class="info">
                                    <?php echo $error?>
                                </span>
                        <?php	
                        }elseif(!empty($keyword)){
                        ?>
                            <div align="center" class="error">No Products Found.</div>
                        <?php
                        }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </body>
</html>
</div>
</div>
</body>
</html>