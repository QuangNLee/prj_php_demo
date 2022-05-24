<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
                $getLastestIP = $product->getLastestIP();
                if($getLastestIP){
                    while ($resultIP = $getLastestIP->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $resultIP['productId'] ?>"> <img src="admin/uploads/<?php echo $resultIP['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><a href="productbybrand.php?brandId=<?php echo $resultIP['brandId'] ?>?"style="color: red; font-weight: bold">Apple</a></h2>
                    <p><?php echo $resultIP['productName'] ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $resultIP['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <?php
                $getLastestSS = $product->getLastestSamsung();
                if($getLastestSS){
                    while ($resultSS = $getLastestSS->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $resultSS['productId'] ?>"> <img src="admin/uploads/<?php echo $resultSS['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><a href="productbybrand.php?brandId=<?php echo $resultSS['brandId'] ?>?"style="color: red; font-weight: bold">Samsung</a></h2>
                    <p><?php echo $resultSS['productName'] ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $resultSS['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="section group">
            <?php
                $getLastestMSI = $product->getLastestMSI();
                if($getLastestMSI){
                    while ($resultMSI = $getLastestMSI->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $resultMSI['productId'] ?>"> <img src="admin/uploads/<?php echo $resultMSI['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><a href="productbybrand.php?brandId=<?php echo $resultMSI['brandId'] ?>?" style="color: red; font-weight: bold">MSI</a></h2>
                    <p><?php echo $fm->textShorten($resultMSI['productName'], 25) ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $resultMSI['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <?php
                $getLastestDELL = $product->getLastestDELL();
                if($getLastestDELL){
                    while ($resultDELL = $getLastestDELL->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?productId=<?php echo $resultDELL['productId'] ?>"> <img src="admin/uploads/<?php echo $resultDELL['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><a href="productbybrand.php?brandId=<?php echo $resultDELL['brandId'] ?>?" style="color: red; font-weight: bold">DELL</a></h2>
                    <p><?php echo $fm->textShorten($resultDELL['productName'], 25) ?></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $resultDELL['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <?php
                        $get_slider = $slider->show_slider();
                        if($get_slider){
                            while ($result_slider = $get_slider->fetch_assoc()){
                    ?>
                    <li><img src="admin/uploads/<?php echo $result_slider['image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>" /></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>