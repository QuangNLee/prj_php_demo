<?php
    include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }
?>
<?php
//    if(!isset($_GET['productId']) || $_GET['productId'] == NULL){
//        echo "<script>window.location ='404.php'</script>";
//    } else {
//        $id = $_GET['productId'];
//    }
//    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
//        $quantity = $_POST['quantity'];
//        $addToCart = $cartController->add_to_cart($quantity,$id);
//    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Profile</h3>
                </div>
                <div class="clear">
                    <table class="tblone">
                        <?php
                            $id = Session::get('customer_id');
                            $get_customer = $customer->show_customer($id);
                            if($get_customer){
                                while ($result = $get_customer->fetch_assoc()){
                        ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td>District</td>
                            <td>:</td>
                            <td><?php echo $result['district'] ?></td>
                        </tr>
                        <!--                <tr>-->
                        <!--                    <td>City</td>-->
                        <!--                    <td>:</td>-->
                        <!--                    <td>--><?php //echo $result['city'] ?><!--</td>-->
                        <!--                </tr>-->
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td><?php echo $result['zipcode'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><a href="changepassword.php" class="buysubmit" style="color: white">Change password</a></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Update information</a></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>