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
    if(isset($_GET['shippedId'])){
        $id = $_GET['shippedId'];
        $productId = $_GET['productId'];
        $quantity = $_GET['quantity'];
        $shipped = $order->shipped($id,$productId,$quantity);
    }
    if(isset($_GET['cancelId'])){
        $id = $_GET['cancelId'];
        $productId = $_GET['productId'];
        $quantity = $_GET['quantity'];
        $cancel_order = $order->cancel_order($id,$productId,$quantity);
        header('Location:ordered.php');
        echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
    }
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Order list</h2>
            <div class="block">
                <?php
                if(isset($shipped)){
                    echo $shipped;
                }
                ?>
                <table class="data display datatable" id="example">
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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $order = new orderController();
                        $fm = new Format();
                        $get_inbox_order = $order->get_inbox_order();
                        if($get_inbox_order){
                            $i = 0;
                            while ($result = $get_inbox_order->fetch_assoc()){
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
                        <td>
                            <?php
                                if($result['status'] == 0){
                                    echo '<span style="color: #7C2DC5">Pending</span>';
                                } else if ($result['status'] == 1){
                                    echo '<span style="color: #4d8cbc">Delivering</span>';
                                } else if ($result['status'] == 3){
                                    echo '<span style="color: #8B0000">Canceled</span>';
                                } else {
                                    echo '<span style="color: green">Success</span>';
                                }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                                if($result['status'] == 0){
                            ?>
                            <a href="?shippedId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>
                                &quantity=<?php echo $result['quantity'] ?>" style="color: blue">Ship</a> ||
                            <a onclick="confirm('Do you want to cancel?')" href="?cancelId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>
                                &quantity=<?php echo $result['quantity'] ?>" style="color: #8B0000">Cancel</a>
                            <?php
                                } else if ($result['status'] == 1 || $result['status'] == 2) {
                            ?>
                            <a onclick="confirm('Do you want to cancel?')" href="?cancelId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>
                                &quantity=<?php echo $result['quantity'] ?>" style="color: #8B0000">Cancel</a>
                            <?php
                                } else {
                                    echo 'x';
                                }
                            ?>
                        </td>
                        <td>

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
<?php
include 'inc/footer.php';
?>