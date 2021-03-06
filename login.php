<?php
    include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check){
        header('Location:orderController.php');
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertCustomer = $customer->insert_customer($_POST);
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $loginCustomer = $customer->login_customer($_POST);
    }
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
            <?php
                if(isset($loginCustomer)){
                    echo $loginCustomer;
                }
            ?>
        	<form action="" method="post">
                <input type="text" name="email" class="field" placeholder="Enter email">
                <input type="password" name="password" class="field" placeholder="Enter password">
                <p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
                <div class="buttons"><div><input type="submit" name="login" class="grey" value="Sign in"></div></div>
            </form>
        </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
            <?php
                if(isset($insertCustomer)){
                    echo $insertCustomer;
                }
            ?>
    		<form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Enter your name ...">
                                </div>
                                <div>
                                    <input type="text" name="district" placeholder="Enter district ...">
                                </div>
                                <div>
                                    <input type="text" name="zipcode" placeholder="Enter zipcode ...">
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Enter your email ...">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Enter your address ...">
                                </div>
                                <div>
                                    <select id="city" name="city" onchange="change_country(this.value)" class="frm-field required">
                                        <option value="null">Select a City</option>
                                        <option value="HaNoi">H?? N???i</option>
                                        <option value="TPHCM">Th??nh ph??? H??? Ch?? Minh</option>
                                        <option value="H???i Ph??ng">H???i Ph??ng</option>
                                        <option value="???? N???ng">???? N???ng</option>
                                        <option value="C???n Th??">C???n Th??</option>
                                        <option value="L???ng S??n">L???ng S??n</option>
                                        <option value="Nha Trang">Nha Trang</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="text" name="phone" placeholder="Enter your phone number ...">
                                </div>
                                <div>
                                    <input type="text" name="password" placeholder="Enter your password ...">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search"><div><input type="submit" name="submit" class="grey" value="Create account"></div></div>
                    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
                <div class="clear"></div>
		    </form>
    	</div>  	
        <div class="clear"></div>
    </div>
</div>
<?php
	include 'inc/footer.php';
?>