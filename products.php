<?php
	include 'inc/header.php';
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php
                $limit = 12;
                $get_product = $product->show_product();
                $total_product = mysqli_num_rows($get_product);
                $current_page_product = isset($_GET['page']) ? $_GET['page'] : 1;
                $product_start = ($current_page_product -1) * $limit;
                $total_page_product = ceil($total_product/$limit);
                $get_pagination_product = $product->get_pagination_product($product_start,$limit);
                if($get_pagination_product){
                    while($result = $get_pagination_product->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                 <a href="details.php?productId=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" height="100px" alt="" /></a>
                 <h2><?php echo $result['productName'] ?></h2>
                 <p><span class="price"><?php echo $result['price'] ?> VND</span></p>
                 <div class="button"><span><a href="details.php?productId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="pagination">
            <?php
                if ($current_page_product -1 > 0){
            ?>
            <li><a href="product.php?page=<?php echo $current_page_product-1; ?>">&laquo;</a></li>
            <?php
                }
            ?>
            <?php
                for($i = 1; $i <= $total_page_product; $i++){
            ?>
                <li class="<?php echo (($current_page_product == $i)?'active': '') ?>"><a href="products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
                }
            ?>
            <?php
                if($current_page_product +1 <= $total_page_product){
            ?>
            <li><a href="product.php?page=<?php echo $current_page_product+1; ?>">&raquo;</a></li>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<?php
	include 'inc/footer.php';
?>