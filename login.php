<?php 
include "inc/header.php";
login_check_pages(); 
?>
<?php 
display_message(); 
validate_user_login();
?>

<div class="login">
	<h1 class="registerForm-login">Login</h1>
    <form method="POST" class="loginForm">
        <input type="email" name="email" placeholder="Email" required class="formElement"><br>
        <input type="password" name="password" placeholder="Password" required class="formElement"><br>
        <input type="submit" name="login-submit" value="Log In" class="formButton">
    </form>
</div>