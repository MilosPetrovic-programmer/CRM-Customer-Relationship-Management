<?php
include "inc/header.php";


validate_company_registration();
display_message();

?>
<div class="profil">
        <h1 class="registerForm-header">Registration</h1>
    <form method="POST" class="registerForm">
        <input type="text" name="name" placeholder="Name" required class="formElement"><br>
        <input type="email" name="email" placeholder="Email" required class="formElement"><br>
        <input type="address" name="address" placeholder="Address" required class="formElement"><br>
        <input type="text" name="tax_id" placeholder="Tax_id" required class="formElement"><br>
        <span>Logo</span>
        <input type="hidden" name="photo_path" id="photoPathInput">
        <div id="dropzone-upload" class="dropzone"></div>
        <br>
        <input type="submit" name="register-submit" placeholder="Register Now" class="formButton"><br>
    </form>
</div>
<!-- For drag and drop -->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.options.dropzoneUpload = {
        url: "upload_photo.php", //php does the upload from user to database, js does the user interface
        paramName: "photo",
        maxFilesize: 20, // MB
        acceptedFiles: "image/*",
        init: function () {
            this.on("success", function (file, response) {
                // Parse the JSON response
                const jsonResponse = JSON.parse(response);
                // Check if the file was uploaded successfully
                if (jsonResponse.success) {
                    // Set the hidden input's value to the uploaded file's path
                    document.getElementById('photoPathInput').value = jsonResponse.photo_path;
                } else {
                    console.error(jsonResponse.error);
                }
            });
        }
    };
</script>