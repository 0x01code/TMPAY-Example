<?php

require_once 'config.php';
require_once 'TMPAY.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>

    <?php
    if (isset($_POST['password'])) {
        $username = $con->real_escape_string($_POST['username']);
        $password = $con->real_escape_string($_POST['password']);

        $tmpay = new TMPAY('TEST', 'https://dev.0x01code.me/TMPAY.Webhook.php', 'razer_gold_pin');
        if ($tmpay->tmn_refill($password)) {
            $con->query("INSERT INTO tmpay (username,password) VALUES ('$username','$password')");
            echo '<script>alert("ทำรายการสำเร็จ")</script>';
        } else {
            echo '<script>alert("เกิดข้อผิดพลาด")</script>';
        }

    } else {
        $username = $con->real_escape_string($_GET['username']);
    }

    $result = $con->query("SELECT * FROM users WHERE username='$username'");
    $row = $result->fetch_object();
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <form action="check.php?username=<?php echo $row->username ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $row->username ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Point</label>
                        <input type="text" class="form-control" name="point" value="<?php echo $row->point ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">บัตรเติมเงิน</label>
                        <input type="text" minlength="14" maxlength="14" class="form-control" name="password" value="">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">เติมเงิน</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>