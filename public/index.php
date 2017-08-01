<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:17 AM
 */
require_once '../private/core/init.php';

require_once 'includes/header.php';

?>



<?php require_once 'includes/content.php'; ?>

<div class="login-form">

    <div id="notifications">
        <ul id="success">
            <li class="alert-success" id="successMessage">you have been registered successfully</li>
        </ul>

        <ul id="error">
            <li class="alert-danger" id="errorMessage"></li>
        </ul>
    </div>

    <?php $token = Token::generate();?>
    <form action="register.php" method="POST" class="register" id="register-form">
        <input type="text" name="Username" placeholder="Username" class="form-control" value="" autocomplete="off" required>
        <input type="text" name="Fullname" placeholder="Full name" value="" class="form-control" autocomplete="off" required>
        <input type="password" name="Password" class="form-control" placeholder="Password" required>
        <input type="password" name="ConfirmPassword" class="form-control" placeholder="Confirm Password" required>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input onclick="register()" type="button" id="signUp" value="Sign Up" class="log-btn" />
        <p class="message" id="message-register">Already registered? <a href="#" class="link3">Log In</a></p>
    </form>

    <form action="login.php" method="POST" class="login" id="login-form">
        <input type="text" name="Username" placeholder="Username" class="form-control" value="" autocomplete="off" required>
        <i class="fa fa-user"></i>
        <input type="password" name="Password" class="form-control" placeholder="Password" autocomplete="off" required>
        <i class="fa fa-lock"></i>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <span class="alert">Invalid Credentials</span>
        <a class="link" href="#">Lost your password?</a>
        <p class="message"><a class="link2" href="#">Create an account</a></p>

        <input onclick="logIn()" type="button" class="log-btn" value="Log in" id="login" >
        <input type="checkbox" checked="checked" id="checkbox" name="checkbox">
        <label class="remember" for="checkbox">Remember Me</label>
    </form>

</div>

<?php require_once 'includes/footer.php';?>
