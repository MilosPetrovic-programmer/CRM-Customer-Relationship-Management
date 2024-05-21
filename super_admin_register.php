<?php
include "inc/header.php";
?>
<?php
validate_user_registration_admin();
?>
<div class="profil">
    <h1 class="registerForm-header">Registration</h1>
    <form method="POST" class="registerForm">
        <input type="text" name="name" placeholder="Name" required class="formElement"><br>
        <input type="email" name="email" placeholder="Email" required class="formElement"><br>
        <input type="text" name="username" placeholder="Username" required class="formElement"><br>
        <input type="password" name="password" placeholder="Password" required class="formElement"><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required class="formElement"><br>
        <label for="is_admin">Role:</label>
        <select name="is_admin" required class="formElement">
            <option value="1">Admin</option>
            <option value="2">Super Admin</option>
        </select><br>
        <input type="submit" name="register-submit" value="Register Now" class="formButton"><br>
    </form>
</div>