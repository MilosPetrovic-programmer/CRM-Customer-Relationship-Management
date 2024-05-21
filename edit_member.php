<?php
include "functions/init.php"; // Ovo uključuje session_start(), db.php i functions.php

if (isset($_GET['id'])) {
    $member_id = escape($_GET['id']);
    $result = query("SELECT * FROM korisnici WHERE id = {$member_id}");
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
    <title>Edit Member</title>
</head>
<body>
    <h1>Edit Member</h1>
    <form action="update_member.php" method="POST">
        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($member['username']); ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" required><br>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) : ?>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) : ?>
    <span>Rola:</span><br>
    <select id="is_admin" name="is_admin" required>
        <option value="1" <?php if ($member['is_admin'] == 1) echo 'selected'; ?>>Admin</option>
        <option value="2" <?php if ($member['is_admin'] == 2) echo 'selected'; ?>>Super Admin</option>
    </select><br><br> 
<?php endif; ?>

        <?php endif; ?>
        <button type="submit">Update</button>
        <br>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
