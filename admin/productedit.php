<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
    include '../controller/categoryController.php';
    include '../controller/productController.php';
?>
<?php
    $prod = new productController();
    if(!isset($_GET['productId']) || $_GET['productId'] == NULL){
        echo "<script>window.location ='productlist.php'</script>";
    } else {
        $id = $_GET['productId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $prod->update_product($_POST,$_FILES,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">
            <?php
                if(isset($updateProduct)){
                    echo $updateProduct;
                }
            ?>
            <?php
                $getproductbyId = $prod->getproductbyId($id);
                    if($getproductbyId){
                        while($result_product = $getproductbyId->fetch_assoc()){
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" placeholder="Enter New Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>Select Category</option>
                                <?php
                                    $cat = new categoryController();
                                    $catlist = $cat->show_category();
                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                ?>
                                <option 
                                    <?php
                                        if($result['catId'] == $result_product['catId']){ echo 'selected'; }
                                    ?>
                                    value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brand">
                                <option>Select Brand</option>
                                <?php
                                    $brand = new brandController();
                                    $brandlist = $brand->show_brand();
                                    if($brandlist){
                                        while($result = $brandlist->fetch_assoc()){
                                ?>
                                <option 
                                    <?php
                                        if($result['brandId'] == $result_product['brandId']){ echo 'selected'; }
                                    ?>
                                    value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="product_description" class="tinymce"><?php echo $result_product['product_description'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $result_product['price'] ?>" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                        <img src="uploads/<?php echo $result_product['image'] ?>" width="50px"/>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <?php
                                    if($result_product['type'] == 1){
                                ?>
                                <option selected value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                                <?php
                                    }else{
                                ?>
                                <option value="1">Featured</option>
                                <option selected value="0">Non-Featured</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Status</label>
                        </td>
                        <td>
                            <select id="select" name="status">
                                <?php
                                if($result_product['status'] == 1){
                                    ?>
                                    <option selected value="1">Available</option>
                                    <option value="0">Not available</option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="1">Available</option>
                                    <option selected value="0">Not available</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php 
    include 'inc/footer.php';
?>