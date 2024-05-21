<?php
include "functions/init.php";


if (isset($_GET['id'])) {
    $member_id = escape($_GET['id']);
    $result = query("SELECT * FROM kompanije WHERE id = {$member_id}");
    confirm($result);
    $member = mysqli_fetch_assoc($result);
} else {
    die("ID korisnika nije prosleđen.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <title>Edit Company</title>
</head>
<body>
<div class="profil">
        <h1>Edit Company</h1>
    <form action="update_company.php" method="POST" class="registerForm">
        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>"><br>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($member['address']); ?>"><br>
        <label for="Tax_id">Tax_id:</label>
        <input type="text" name="tax_id" value="<?php echo htmlspecialchars($member['tax_id']); ?>"><br>
        <span>Logo</span>
        <input type="hidden" name="photo_path" id="photoPathInput">
        <div id="dropzone-upload" class="dropzone"></div>
        <p>Veličina slike treba da bude manja od 20 MB. <br> Tip formata slike treba da bude JPG, PNG ili GIF.</p>
        <br>
        <button type="submit">Update</button>
        <br>
        <a href="index.php" class="btn btn-secondary">Back</a>
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
    
</body>
</html>
