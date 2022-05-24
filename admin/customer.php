<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . '/../controller/customerController.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    $customer = new customerController();
    if(!isset($_GET['customerId']) || $_GET['customerId'] == NULL){
        echo "<script>window.location ='inbox.php'</script>";
    } else {
        $id = $_GET['customerId'];
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer information</h2>
        <div class="block copyblock">
            <?php
            $get_customer = $customer->show_customer($id);
            if($get_customer){
                while($result = $get_customer->fetch_assoc()){
                    ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" name="name" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>" name="address" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>District</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['district'] ?>" name="district" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" name="city" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" name="zipcode" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" name="phone" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" name="email" class="medium">
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