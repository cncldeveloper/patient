<?php
/**
 * @var $pdo
 */
include "config.php";

if (isset($_POST['form1'])) {

    try {
        $sql = "SELECT * FROM registration WHERE email=? AND password=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['email'], md5($_POST['password'])]);

        if ($stmt->rowCount() == 0) {
            header('LOCATION: login.php?error=Invalid email or password');
        } else {
            $_SESSION['user'] = $stmt->fetch(PDO::FETCH_OBJ);
            header('LOCATION: index.php');
        }
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
    <title>Patient Login</title>
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
    <h2 class="title">Patient Login</h2>

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" required>
        </div>


        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="form1"></label>
            <button type="submit" id="form1" name="form1">Login</button>
            <a href="registration.php" class="login">Registration</a>
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