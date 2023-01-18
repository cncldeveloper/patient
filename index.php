<?php
/**
 * @var $pdo
 */
include "config.php";

// LOGIN CHECK
if (empty($_SESSION['user'])) {
    header('LOCATION: login.php');
    exit();
}

// LOGIN USER
$stmt = $pdo->prepare("SELECT * FROM registration WHERE id=?");
$stmt->execute([$_SESSION['user']->id]);
$row = $stmt->fetch(PDO::FETCH_OBJ);

// UPDATE
if (isset($_POST['form1'])) {
    try {
        $sql = "UPDATE `registration`
                SET
                `name` = ?,
                `contact_number` = ?,
                `password` = ?,
                `blood_group` =?,
                `thana_or_upazila` = ?,
                `postcode` = ?,
                `district` = ?,
                `updated_at` = ?
                WHERE `id`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['name'],
            $_POST['contact_number'],
            (empty($_POST['password'])? $row->password: md5($_POST['password'])),
            $_POST['blood_group'],
            $_POST['thana_or_upazila'],
            $_POST['post_code'],
            $_POST['district'],
            date('Y-m-d H:i:s'),
            $row->id
        ]);

        header('LOCATION: index.php?success=Registration Successful!');
    } catch (Exception $exception) {
        header('LOCATION: index.php?error=' . $exception->getMessage());
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">

    <?php
    if (isset($_GET['success'])) {
        echo '<div class="success message">'. $_GET['success'] .'</div>';
    }

    if (isset($_GET['error'])) {
        echo '<div class="error message">'. $_GET['error'] .'</div>';
    }
    ?>
    <h2 class="title">Profile</h2>

    <div class="right-section">
        <a href="logout.php" class="logout">Logout</a>
        <a href="delete-profile.php" onclick="return confirm('Do you want to delete?')" class="delete">Delete Profile</a>
    </div>


    <form action="index.php" method="post">
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" value="<?= $row->name; ?>" id="name" required>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth *</label>

            <input type="text" name="date_of_birth" value="<?= date('m/d/Y', strtotime($row->date_of_birth)); ?>" id="date_of_birth" disabled>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" value="<?= $row->email; ?>" id="email" disabled>
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number *</label>
            <input type="text" name="contact_number" value="<?= $row->contact_number; ?>" id="contact_number" maxlength="11" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="nid_or_birth_cer">NID / Birth Certificate Number *</label>
            <input type="text" name="nid_or_birth_cer" value="<?= $row->nid_or_birth_cer; ?>" id="nid_or_birth_cer" disabled>
        </div>

        <div class="form-group">
            <label for="blood_group">Blood Group *</label>
            <select name="blood_group" id="blood_group" required>
                <option value="">Choose...</option>
                <option value="A+" <?= ($row->blood_group == 'A+'? 'selected': ''); ?>>A+</option>
                <option value="A-" <?= ($row->blood_group == 'A-'? 'selected': ''); ?>>A-</option>
                <option value="B+" <?= ($row->blood_group == 'B+'? 'selected': ''); ?>>B+</option>
                <option value="B-" <?= ($row->blood_group == 'B-'? 'selected': ''); ?>>B-</option>
                <option value="AB+" <?= ($row->blood_group == 'AB+'? 'selected': ''); ?>>AB+</option>
                <option value="AB-" <?= ($row->blood_group == 'AB-'? 'selected': ''); ?>>AB-</option>
                <option value="O+" <?= ($row->blood_group == 'O+'? 'selected': ''); ?>>O+</option>
                <option value="O-" <?= ($row->blood_group == 'O-'? 'selected': ''); ?>>O-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="thana_or_upazila">Thana / Upazila *</label>
            <input type="text" name="thana_or_upazila" value="<?= $row->thana_or_upazila; ?>" id="thana_or_upazila" required>
        </div>

        <div class="form-group">
            <label for="post_code">Post Code *</label>
            <input type="text" name="post_code" value="<?= $row->postcode; ?>" id="post_code" required>
        </div>

        <div class="form-group">
            <label for="district">District *</label>
            <input type="text" name="district" value="<?= $row->district; ?>" id="district" required>
        </div>

        <div class="form-group">
            <label for="created_at">Created At</label>
            <input type="text" name="post_code" value="<?= date('d-m-Y h:i A', strtotime($row->created_at)); ?>" id="created_at" disabled>
        </div>

        <div class="form-group">
            <label for="updated_at">Updated At *</label>
            <input type="text" name="updated_at" value="<?= date('d-m-Y h:i A', strtotime($row->updated_at)); ?>" id="updated_at" disabled>
        </div>

        <div class="form-group">
            <label for="form1"></label>
            <button type="submit" id="form1" name="form1">Update Profile</button>
        </div>
    </form>

    <script>
        setTimeout(function() {
            document.querySelector('.message').style.display = 'none';
        }, 5000);

    </script>
</div>
</body>
</html>