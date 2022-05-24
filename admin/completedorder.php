<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . '/../controller/orderController.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    $order = new orderController();
    $fm = new Format();
    $get_successful_order = $order->get_completed_order();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <table class="data display">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Order time</th>
                    <th>Type</th>
                    <th>Customer ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $limit = 10;
                    $get_order = $order->get_completed_order();
                    $total_order = mysqli_num_rows($get_order);
                    $current_page_order = isset($_GET['page']) ? $_GET['page'] : 1;
                    $order_start = ($current_page_order -1) * $limit;
                    $total_page_order = ceil($total_order/$limit);
                    $get_pagination_order = $order->get_pagination_completed_order($order_start,$limit);
                    $i = 0;
                    if($get_pagination_order){
                        while($result = $get_pagination_order->fetch_assoc()){
                            $i++;
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i ?></td>
                    <td><?php echo $fm->formatDate($result['createdAt']) ?></td>
                    <td>
                        <?php
                            if($result['orderType'] == 0){
                                echo '<span style="text-align: center; color: red">Offline Payment</span>';
                            } else {
                                echo '<span style="text-align: center; color: green">Online Payment</span>';
                            }
                        ?>
                    </td>
                    <td><?php echo $result['customerId'] ?></td>
                    <td><a href="customer.php?customerId=<?php echo $result['customerId'] ?>">View customer</a></td>
                    <td><?php echo $result['productName'] ?></td>
                    <td><?php echo $result['quantity'] ?></td>
                    <td><?php echo $fm->format_currency($result['total']) ?></td>
                    <?php
                        if($result['status'] == 2){
                    ?>
                            <td><a style="color: green">Success</a></td>
                    <?php
                        } else {
                    ?>
                            <td><a style="color: #8B0000">Canceled</a></td>
                    <?php
                        }
                    ?>
                </tr>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php
                if ($current_page_order -1 > 0){
                    ?>
                    <li><a href="order.php?page=<?php echo $current_page_order-1; ?>">&laquo;</a></li>
                    <?php
                }
                ?>
                <?php
                for($i = 1; $i <= $total_page_order; $i++){
                    ?>
                    <li class="<?php echo (($current_page_order == $i)?'active': '') ?>"><a href="order.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
                ?>
                <?php
                if($current_page_order +1 <= $total_page_order){
                    ?>
                    <li><a href="order.php?page=<?php echo $current_page_order+1; ?>">&raquo;</a></li>
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
