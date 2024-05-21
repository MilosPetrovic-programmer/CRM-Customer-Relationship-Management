<?php
include "inc/header.php";
login_check_pages();
?>
<?php
validate_user_registration();
display_message();
?>
<div class="profil">
        <h1 class="registerForm-header">Registration</h1>
    <form method="POST" class="registerForm">
        <input type="text" name="name" placeholder="Name" required class="formElement"><br>
        <input type="email" name="email" placeholder="Email" required class="formElement"><br>
        <input type="text" name="username" placeholder="Username" required class="formElement"><br>
        <input type="password" name="password" placeholder="Password" required class="formElement"><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required class="formElement"><br>
        <input type="submit" name="register-submit" placeholder="Register Now" class="formButton"><br>
    </form>
</div>