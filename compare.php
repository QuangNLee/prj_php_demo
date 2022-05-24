<?php
    include 'inc/header.php';
?>
<?php
    $customer_id = Session::get('customer_id');
    if (isset($_GET['compareId'])){
        $compareId = $_GET['compareId'];
        $delcompare = $cart->del_product_compare($compareId);
    }
?>
<?php
    if (!isset($_GET['id'])){
        echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
    }
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div>
                <h2 style="border-bottom: 1px solid #ddd; font-size: 30px; margin-bottom: 20px;">Compare Product</h2>
                <?php
                    if (isset($delcompare)){
                        echo $delcompare;
                    }
                ?>
                <table class="tblone">
                    <tr>
                        <th width="15%">No.</th>
                        <th width="25%">Product Name</th>
                        <th width="25%">Image</th>
                        <th width="15%">Price</th>
                        <th width="20%">Action</th>
                    </tr>
                    <?php
                        $get_compare_list = $cart->get_all_compare($customer_id);
                        if($get_compare_list){
                            $i = 0;
                            while($result = $get_compare_list->fetch_assoc()){
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
                        <td><?php echo $fm->format_currency($result['price']) ?> VND</td>
                        <td>
                            <a href="details.php?productId=<?php echo $result['productId'] ?>">View</a>
                            <a onclick="return confirm('Do you want to delete???')"
                               href="?compareId=<?php echo $result['id'] ?>"> || Delete</a></td>
                    </tr>
                    <?php
                            }
                        } else {
                            echo "Your compare list is empty!!!";
                        }
                    ?>
                </table>

            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>