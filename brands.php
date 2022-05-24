<?php
	include 'inc/header.php';
?>
<div class="main">
    <div class="content">
        <div class="content_top">
    		<div class="heading">
                <?php
                    $list_brand = $brand->list_brand();
                    if($list_brand){
                        while ($result = $list_brand->fetch_assoc()){
                ?>
                <a class="buysubmit" name="brandName" style="padding: 8px" href="productbybrand.php?brandId=<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></a>
                <?php
                        }
                    }
                ?>
    		</div>
    		<div class="clear"></div>
    	</div>
    </div>
</div>
<?php
	include 'inc/footer.php';
?>