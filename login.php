<!DOCTYPE html>
<html>
<head>
    <?php require_once('relative.php'); ?>
<?php
$flag = '';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM employees WHERE username='$username' AND password=md5('$password')";
    $login_query_run = mysqli_query($con, $login_query);
    $num = mysqli_num_rows($login_query_run);
    $row = mysqli_fetch_assoc($login_query_run);
    if ($num == 1) {
        if ($row['role'] == 'admin') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_info'] = $row;
            header('location: admin.php');
        } elseif ($row['role'] == 'emp') {
            $_SESSION['emp_logged_in'] = true;
            $_SESSION['emp_info'] = $row;
            header('location: employee.php');
        }
    } else {
        $flag = 'Incorrect username or password!';
    }
}
?>
</head>
<body>

    <div class="grid">
        <div class="col_12" style="margin-top:100px;">
            <h1 class="center">
            <p><i class="fa fa-money"></i></p>
            Welcome to International Bank System</h1>
            <h4 style="color:#999;margin-bottom:40px;" class="center">
                Employees and Managers can log in from the form below!
            </h4>

            <div class="md-container">
                <span class="error-text"><?= $flag; ?></span>
                <form method="post">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" class="col_12" placeholder="Enter the Username" />

                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="col_12" placeholder="Enter the Password" />
                    <!-- Inset -->
                    <button class="inset" type="submit"><i class="fa fa-lock"></i> Login</button>
                </form>
            </div>
        </div>
    </div> <!-- End Grid -->

</body>
</html>