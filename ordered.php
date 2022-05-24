<?php
    include 'inc/header.php';
?>
<?php
    $customer_id = Session::get('customer_id');
    $get_all_order_detail = $order->get_all_order_detail($customer_id);
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }
    if (isset($_GET['confirmId'])){
        $id = $_GET['confirmId'];
        $productId = $_GET['productId'];
        $quantity = $_GET['quantity'];
        $confirm_order = $order->confirm_order($id,$productId,$quantity);
        header('Location:ordered.php');
    }
    if(isset($_GET['cancelId'])){
        $id = $_GET['cancelId'];
        $productId = $_GET['productId'];
        $quantity = $_GET['quantity'];
        $cancel_order = $order->cancel_order($id,$productId,$quantity);
        header('Location:ordered.php');
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Ordered</h3>
            </div>
            <div class="clear"></div>
            <div class="box_order_detail">
                <div class="cartpage">
                    <table class="tblone">
                        <tr>
                            <th width="15%">Product Name</th>
                            <th width="15%">Image</th>
                            <th width="15%">Price</th>
                            <th width="5%">Quantity</th>
                            <th width="10%">VAT</th>
                            <th width="15%">Total Price</th>
                            <th width="10%">Order date</th>
                            <th width="5%">Type</th>
                            <th width="5%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                        <?php
                            $limit = 5;
                            $total_order = mysqli_num_rows($get_all_order_detail);
                            $current_page_order = isset($_GET['page']) ? $_GET['page'] : 1;
                            $order_start = ($current_page_order -1) * $limit;
                            $total_page_order = ceil($total_order/$limit);
                            $get_pagination_order = $order->get_pagination_all_order_detail($customer_id,$order_start,$limit);
                            if($get_pagination_order){
                                while($result = $get_pagination_order->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $result['productName'] ?></td>
                            <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
                            <td><?php echo $fm->format_currency($result['unitPrice']) ?> VND</td>
                            <td><?php echo $result['quantity'] ?></td>
                            <td><?php echo $result['VAT'] ?> %</td>
                            <td><?php echo $fm->format_currency($result['total']) ?> VND</td>
                            <td><?php echo $fm->formatDate($result['orderDate']) ?></td>
                            <td>
                                <?php
                                     if($result['orderType'] == 0){
                                         echo '<span style="text-align: center; color: red">Offline Payment</span>';
                                     } else {
                                         echo '<span style="text-align: center; color: green">Online Payment</span>';
                                     }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($result['status'] == 0) {
                                        echo '<span style="color: #FF8C00;">Delivering</span>';
                                    } else if ($result['status'] == 1){
                                        echo '<span style="color: #0000FF;">Waiting submit</span>';
                                    } else if ($result['status'] == 3){
                                        echo '<span style="color: #8B0000;">Canceled</span>';
                                    } else {
                                        echo '<span style="color: green;">Success</span>';
                                    }
                                ?>
                            </td>
                            <?php
                                if($result['status'] == 0){
                            ?>
                                <td>
                                    <a onclick="confirm('Do you want to cancel?')" href="?cancelId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>
                                        &quantity=<?php echo $result['quantity'] ?>">Cancel</a>
                                </td>
                            <?php
                                } else if ($result['status'] == 1){
                            ?>
                                <td>
                                    <a href="?confirmId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>
                                        &quantity=<?php echo $result['quantity'] ?>">Accept</a> ||
                                    <a onclick="confirm('Do you want to cancel?')" href="?cancelId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>
                                        &quantity=<?php echo $result['quantity'] ?>">Cancel</a>
                                </td>
                            <?php
                                } else {
                            ?>
                                    <td>x</a></td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                        <div class="pagination">
                            <?php
                                if ($current_page_order -1 > 0){
                            ?>
                            <li><a href="ordered.php?page=<?php echo $current_page_order-1; ?>">&laquo;</a></li>
                            <?php
                                }
                            ?>
                            <?php
                                for($i = 1; $i <= $total_page_order; $i++){
                            ?>
                            <li class="<?php echo (($current_page_order == $i)?'active': '') ?>"><a href="ordered.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                }
                            ?>
                            <?php
                                if($current_page_order +1 <= $total_page_order){
                            ?>
                            <li><a href="ordered.php?page=<?php echo $current_page_order+1; ?>">&raquo;</a></li>
                            <?php
                                }
                            ?>
                        </div>
                    </table>
                </div>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"><img src="images/shop.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>