<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../controller/categoryController.php';
?>
<?php
    $cat = new categoryController();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">
            <table class="data display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $limit = 10;
                        $get_cat = $cat->show_category();
                        $total_cat = mysqli_num_rows($get_cat);
                        $current_page_cat = isset($_GET['page']) ? $_GET['page'] : 1;
                        $cat_start = ($current_page_cat -1) * $limit;
                        $total_page_cat = ceil($total_cat/$limit);
                        $get_pagination_cat = $cat->show_pagination_category($cat_start,$limit);
                        if($get_pagination_cat){
                            $i = 0;
                            while($result = $get_pagination_cat->fetch_assoc()){
                                $i++;
                    ?>
                        <tr class="odd gradeX">
                            <td style="text-align: center"><?php echo $i; ?></td>
                            <td><?php echo $result['catName'] ?></td>
                            <td style="text-align: center">
                                <?php
                                if($result['status'] == 1){
                                    ?>
                                    <span style="color: green">Available</span>
                                    <?php
                                } else {
                                    ?>
                                    <span style="color: red">Not available</span>
                                    <?php
                                }
                                ?>
                            </td>
                            <td><a href="catedit.php?catId=<?php echo $result['catId'] ?>">Edit</a></td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php
                    if ($current_page_cat -1 > 0){
                        ?>
                        <li><a href="catlist.php?page=<?php echo $current_page_cat - 1; ?>">&laquo;</a></li>
                        <?php
                    }
                ?>
                <?php
                    for($i = 1; $i <= $total_page_cat; $i++){
                ?>
                <li class="<?php echo (($current_page_cat == $i)?'active': '') ?>"><a href="catlist.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                    }
                ?>
                <?php
                    if($current_page_cat + 1 <= $total_page_cat){
                ?>
                <li><a href="catlist.php?page=<?php echo $current_page_cat + 1; ?>">&raquo;</a></li>
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

