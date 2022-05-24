<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/categoryController.php';
?>
<?php
    $cat = new categoryController();
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
        echo "<script>window.location ='catlist.php'</script>";
    } else {
        $id = $_GET['catId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];
        $status = $_POST['status'];
        $updateCat = $cat->update_category($catName,$status,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit category</h2>
                <div class="block copyblock">
                <?php
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?>
                <?php
                    $get_cate_name = $cat->getcatbyId($id);
                    if($get_cate_name){
                        while($result = $get_cate_name->fetch_assoc()){
                ?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td><label>Category name</label></td>
                                <td>
                                    <input type="text" value="<?php echo $result['catName'] ?>" name="catName" placeholder="Enter new category name..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Status</label>
                                </td>
                                <td>
                                    <select id="select" name="status">
                                        <?php
                                        if($result['status'] == 1){
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
<?php include 'inc/footer.php';?>