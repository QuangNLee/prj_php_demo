<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
?>
<?php
    $brand = new brandController();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $insertbrand = $brand->insert_brand($brandName);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add new brand</h2>
               <div class="block copyblock"> 
               <?php
                    if(isset($insertbrand)){
                        echo $insertbrand;
                    }
                ?>
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>