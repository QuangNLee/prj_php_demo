<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../controller/brandController.php';
?>
<?php
    $brand = new brandController();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Brands List</h2>
        <div class="block">
            <table class="data display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $limit = 10;
                        $get_brand = $brand->show_brand();
                        $total_brand = mysqli_num_rows($get_brand);
                        $current_page_brand = isset($_GET['page']) ? $_GET['page'] : 1;
                        $brand_start = ($current_page_brand -1) * $limit;
                        $total_page_brand = ceil($total_brand/$limit);
                        $get_pagination_brand = $brand->show_pagination_brand($brand_start,$limit);
                        if($get_pagination_brand){
                            while($result = $get_pagination_brand->fetch_assoc()){
                    ?>
                    <tr class="odd gradeX">
                        <td style="text-align: center"><?php echo $result['brandId'] ?></td>
                        <td><?php echo $result['brandName'] ?></td>
                        <td style="text-align: center;">
                            <?php
                                if($result['status'] == 1){
                                    echo '<span style="color: green">Available</span>';
                                } else {
                                    echo '<span style="color: red">Not available</span>';
                                }
                            ?>
                        </td>
                        <td><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php
                if ($current_page_brand -1 > 0){
                    ?>
                    <li><a href="brandlist.php?page=<?php echo $current_page_brand-1; ?>">&laquo;</a></li>
                    <?php
                }
                ?>
                <?php
                for($i = 1; $i <= $total_page_brand; $i++){
                    ?>
                    <li class="<?php echo (($current_page_brand == $i)?'active': '') ?>"><a href="brandlist.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
                ?>
                <?php
                if($current_page_brand +1 <= $total_page_brand){
                    ?>
                    <li><a href="brandlist.php?page=<?php echo $current_page_brand+1; ?>">&raquo;</a></li>
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

