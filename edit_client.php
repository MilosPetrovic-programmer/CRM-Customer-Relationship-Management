<?php
include "functions/init.php"; // Ovo uključuje session_start(), db.php i functions.php

if (isset($_GET['id'])) {
    $member_id = escape($_GET['id']);
    $result = query("SELECT * FROM klijenti WHERE id = {$member_id}");
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
    <title>Edit Client</title>
</head>
<body>
    <h1>Edit Client</h1>
    <form action="update_client.php" method="POST">
        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" required><br>
        <label for="Phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($member['phone']); ?>" required><br>
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
        <button type="submit">Update</button>
        <br>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
