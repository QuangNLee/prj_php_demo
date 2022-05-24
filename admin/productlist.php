<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../controller/brandController.php';
	include '../controller/categoryController.php';
	include '../controller/productController.php';
	include_once '../helpers/format.php';
?>
<?php
	$product = new productController();
	$fm = new Format();
//	if(isset($_GET['productId'])){
//		$id = $_GET['productId'];
//		$delprod = $prod->delete_product($id);
//	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Products List</h2>
        <div class="block">
			<?php
				if(isset($delprod)){
					echo $delprod;
				}
			?>
            <table class="data display">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Product Name</th>
                        <th width="5%">Category</th>
                        <th width="5%">Brand</th>
                        <th width="20%">Description</th>
                        <th width="5%">Type</th>
                        <th width="10%">Product Price</th>
                        <th width="10%">Image</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $limit = 10;
                        $get_product = $product->show_product();
                        $total_product = mysqli_num_rows($get_product);
                        $current_page_product = isset($_GET['page']) ? $_GET['page'] : 1;
                        $product_start = ($current_page_product -1) * $limit;
                        $total_page_product = ceil($total_product/$limit);
                        $get_pagination_product = $product->get_pagination_product($product_start,$limit);
                        if($get_pagination_product){
                            while($result = $get_pagination_product->fetch_assoc()){
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $result['productId'] ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><?php echo $result['catName'] ?></td>
                        <td><?php echo $result['brandName'] ?></td>
                        <td><?php echo $fm->textShorten($result['product_description'], 30) ?></td>
                        <td><?php
                                if($result['type'] == 1){
                                    echo '<span style="color: blue">Featured</span>';
                                } else {
                                    echo 'Non-Featured';
                                }
                            ?>
                        </td>
                        <td style="text-align: center"><?php echo $fm->format_currency($result['price']) ?> VND</td>
                        <td style="text-align: center"><img src="uploads/<?php echo $result['image'] ?>" width="50px"/></td>
                        <td style="text-align: center">
                            <?php
                            if($result['status'] == 1){
                                echo '<span style="color: green">Available</span>';
                            } else {
                                echo '<span style="color: red">Not available</span>';
                            }
                            ?>
                        </td>
                        <td style="text-align: center"><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php
                if ($current_page_product -1 > 0){
                    ?>
                    <li><a href="productlist.php?page=<?php echo $current_page_product-1; ?>">&laquo;</a></li>
                    <?php
                }
                ?>
                <?php
                for($i = 1; $i <= $total_page_product; $i++){
                    ?>
                    <li class="<?php echo (($current_page_product == $i)?'active': '') ?>"><a href="productlist.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
                ?>
                <?php
                if($current_page_product +1 <= $total_page_product){
                    ?>
                    <li><a href="productlist.php?page=<?php echo $current_page_product+1; ?>">&raquo;</a></li>
                    <?php
                }
                ?>
            </div>
       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
