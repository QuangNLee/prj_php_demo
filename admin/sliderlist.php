<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/sliderController.php';
?>
<?php
    $slider = new sliderController();
    if(isset($_GET['change_type']) && isset($_GET['type'])){
        $id = $_GET['change_type'];
        $type = $_GET['type'];
        $update_type = $slider->update_type($id,$type);
    }
    if(isset($_GET['del_slider'])){
        $id = $_GET['del_slider'];
        $del_slider = $slider->del_slider($id);
    }
?>
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">
            <?php
                if(isset($del_slider)){
                    echo $del_slider;
                }
            ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
                    <th>Slider Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                <?php
                    $get_slider = $slider->show_slider_admin();
                    if($get_slider){
                        $i = 0;
                        while($result_slider = $get_slider->fetch_assoc()){
                            $i++;
                ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result_slider['sliderName'] ?></td>
					<td><img src="uploads/<?php echo $result_slider['image'] ?>" height="120px" width="400px"/></td>
                    <td>
                        <?php
                            if($result_slider['type'] == 1){
                        ?>
                        <a href="?change_type=<?php echo $result_slider['id'] ?>&type=0" style="color: green">ON</a>
                        <?php
                            } else {
                        ?>
                        <a href="?change_type=<?php echo $result_slider['id'] ?>&type=1" style="color: red">OFF</a>
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                        <a onclick="return confirm('Do you want to delete?');" href="?del_slider=<?php echo $result_slider['id'] ?>">Delete</a>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
			</tbody>
		</table>

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
