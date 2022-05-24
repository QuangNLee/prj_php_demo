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
                        <h3>Payment</h3>
                    </div>
                    <div class="clear"></div>
                    <div class="wrapper_method">
                        <h3 class="payment">Choose your method payment</h3>
                        <a href="offlinepayment.php">Offline payment</a>
                        <a href="onlinepayment.php">Online payment</a><br><br><br>
                        <a style="background: grey" href="cart.php"><< Previous</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'inc/footer.php';
?>