<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
?>
<?php
    $brand = new brandController();
    if(!isset($_GET['brandId']) || $_GET['brandId'] == NULL){
        echo "<script>window.location ='brandlist.php'</script>";
    } else {
        $id = $_GET['brandId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $status = $_POST['status'];
        $updateBrand = $brand->update_brand($brandName,$status,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit brand</h2>
                <div class="block copyblock">
                <?php
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                ?>
                <?php
                    $get_brand_name = $brand->getbrandbyId($id);
                    if($get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){
                ?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td><label>Branch Name</label></td>
                                <td>
                                    <input type="text" value="<?php echo $result['brandName'] ?>" name="brandName" placeholder="Enter new brand name..." class="medium" />
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