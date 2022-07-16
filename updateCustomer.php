<!DOCTYPE html>
<html>
<head>
    <?php require_once('relative.php'); ?>
<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: index.php?PleaseLogin');
}

// Update Employee
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sel_query = "SELECT * FROM customers WHERE id=".$id;
    $sel_query_run = mysqli_query($con, $sel_query);
    $row = mysqli_fetch_assoc($sel_query_run);
} else header('location: customersList.php?error');

// Update Customer
if (isset($_POST['updateCustomer'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $balance = $_POST['balance'];
    $username = $_POST['username'];
    $account_no = $_POST['account_no'];

    $query = "UPDATE customers SET firstname='$firstname', lastname='$lastname', phone='$phone', email='$email', country='$country', city='$city', address='$address', balance='$balance', username='$username', account_no='$account_no' WHERE id=".$_GET['id'];
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        header('location: customersList.php?customerUpdate=true');
    }
}
?>
</head>
<body>

<!-- Menu Horizontal -->
<ul class="menu">
    <li><a href="admin.php">Dashboard</a></li>
    <li><a href="">Employees</a>
        <ul>
            <li><a href="EmployeesList.php"><i class="fa fa-list"></i> Employees List</a></li>
            <li><a href="addEmployee.php"><i class="fa fa-plus"></i> Add Employee</a></li>
        </ul>
    </li>
    <li class="current"><a href="">Customers</a>
        <ul>
            <li class="current"><a href=""><i class="fa fa-list"></i> Customers List</a></li>
            <li><a href="addCustomer.php"><i class="fa fa-plus"></i> Add Customer</a></li>
        </ul>
    </li>

    <li><a href="logout.php">Logout</a></li>
</ul>

<div class="grid">
    <div class="col_1"></div>
    <div class="col_10">
        <div class="md-container">
            <h3>Update Employee</h3>
            <form method="post">
                <label for="firstname">Firstname</label>
                <input id="firstname" type="text" name="firstname" class="col_12" placeholder="Enter the Firstname" value="<?= $row['firstname']; ?>" />

                <label for="lastname">Lastname</label>
                <input id="lastname" type="text" name="lastname" class="col_12" placeholder="Enter the Lastname" value="<?= $row['lastname']; ?>" />

                <label for="phone">Phone</label>
                <input id="phone" type="text" name="phone" class="col_12" placeholder="Enter the Phone No" value="<?= $row['phone']; ?>" />
                
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="col_12" placeholder="Enter the Email" value="<?= $row['email']; ?>" />
                
                <label for="country">Country</label>
                <input id="country" type="text" name="country" class="col_12" placeholder="Enter the Country" value="<?= $row['country']; ?>" />
                
                <label for="city">City</label>
                <input id="city" type="text" name="city" class="col_12" placeholder="Enter the City" value="<?= $row['city']; ?>" />
                
                <label for="address">Address</label>
                <div>
                    <textarea class="col_12" name="address" id="address" placeholder="Enter the Address"><?= $row['address']; ?></textarea>
                </div>
                
                <label for="balance">Balance</label>
                <input id="balance" type="number" name="balance" class="col_12" placeholder="Enter the Balance" value="<?= $row['balance']; ?>" />

                <label for="username">Username</label>
                <input id="username" type="text" name="username" class="col_12" placeholder="Enter the Username" value="<?= $row['username']; ?>" />

                <label for="account_no">Account No</label>
                <input id="account_no" type="number" name="account_no" class="col_12" placeholder="Enter the Account No" value="<?= $row['account_no']; ?>" />

                <!-- Inset -->
                <button class="outset green" type="submit" name="updateCustomer"><i class="fa fa-save"></i> Update Customer</button>
            </form>
        </div>
    </div>
    <div class="col_1"></div>
</div>



</body>
</html>