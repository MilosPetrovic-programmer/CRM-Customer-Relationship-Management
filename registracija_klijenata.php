<?php
include "inc/header.php";

validate_client_registration();
display_message();

?>
<div class="profil">
        <h1 class="registerForm-header">Registration</h1>
    <form method="POST" class="registerForm">
        <input type="text" name="name" placeholder="Name" required class="formElement"><br>
        <input type="email" name="email" placeholder="Email" required class="formElement"><br>
        <input type="tel" name="phone" placeholder="Phone" required class="formElement"><br>
        <label for="company">Kompanija:</label><br>
        <select id="company" name="company" required>
        <option value="">Izaberite kompaniju</option>
        <?php
        $sql = "SELECT id, name FROM kompanije";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
        }
        ?>
    </select><br>
        <input type="submit" name="register-submit" placeholder="Register Now" class="formButton"><br>
    </form>
</div>
