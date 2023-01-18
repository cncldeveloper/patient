<?php
/**
 * @var $pdo
 */
include "config.php";
if (isset($_POST['form1'])) {

    $stmt = $pdo->prepare("SELECT * FROM registration WHERE email=?");
    $stmt->execute([$_POST['email']]);
    if ($stmt->rowCount()) {
        header('LOCATION: registration.php?error=Email already exist');
        exit();
    }

    try {
        $sql = "INSERT INTO `registration`(
                    `name`,
                    `date_of_birth`,
                    `nid_or_birth_cer`,
                    `contact_number`,
                    `email`,
                    `password`,
                    `blood_group`,
                    `thana_or_upazila`,
                    `postcode`,
                    `district`,
                    `created_at`,
                    `updated_at`
                )
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['name'],
            str_replace('/', '-', $_POST['date_of_birth']),
            $_POST['nid_or_birth_cer'],
            $_POST['contact_number'],
            $_POST['email'],
            md5($_POST['password']),
            $_POST['blood_group'],
            $_POST['thana_or_upazila'],
            $_POST['post_code'],
            $_POST['district'],
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s')
        ]);

        header('LOCATION: registration.php?success=Registration Success!');
    } catch (Exception $exception) {
        $_SESSION['error'] = $exception->getMessage();
        header('LOCATION: index.php');
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
    <title>Patient Registration Form</title>
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
    <h2 class="title">Registration Form</h2>

    <form action="registration.php" method="post">
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth *</label>
            <input type="date" name="date_of_birth" id="date_of_birth" required>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number *</label>
            <input type="text" name="contact_number" id="contact_number" maxlength="11" required>
        </div>

        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="nid_or_birth_cer">NID / Birth Certificate Number *</label>
            <input type="text" name="nid_or_birth_cer" id="nid_or_birth_cer" required>
        </div>

        <div class="form-group">
            <label for="blood_group">Blood Group *</label>
            <select name="blood_group" id="blood_group" required>
                <option value="">Choose...</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="thana_or_upazila">Thana / Upazila *</label>
            <input type="text" name="thana_or_upazila" id="thana_or_upazila" required>
        </div>

        <div class="form-group">
            <label for="post_code">Post Code *</label>
            <input type="text" name="post_code" id="post_code" required>
        </div>

        <div class="form-group">
            <label for="district">District *</label>
            <input type="text" name="district" id="district" required>
        </div>

        <div class="form-group">
            <label for="form1"></label>
            <button type="submit" id="form1" name="form1">Signup</button>
            <a href="login.php" class="login">Login</a>
        </div>
    </form>
</div>

<script>
    setTimeout(function() {
        document.querySelector('.message').style.display = 'none';
    }, 5000);

</script>
</body>
</html>