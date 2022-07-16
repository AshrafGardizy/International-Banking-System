<!DOCTYPE html>
<html>
<head>
    <?php require_once('relative.php'); ?>
<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: index.php?PleaseLogin');
}

// Add Employee
$flag = 0;
if (isset($_POST['addEmployee'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $query = "INSERT INTO employees(firstname, lastname, phone, email, country, city, address, username, password, role) VALUES('$firstname', '$lastname', '$phone', '$email', '$country', '$city', '$address', '$username', '$password', '$role')";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $flag = 1;
    }
}
?>
</head>
<body>

<!-- Menu Horizontal -->
<ul class="menu">
    <li><a href="admin.php">Dashboard</a></li>
    <li class="current"><a href="">Employees</a>
        <ul>
            <li><a href="EmployeesList.php"><i class="fa fa-list"></i> Employees List</a></li>
            <li class="current"><a href=""><i class="fa fa-plus"></i> Add Employee</a></li>
        </ul>
    </li>
    <li><a href="">Customers</a>
        <ul>
            <li><a href=""><i class="fa fa-list"></i> Customers List</a></li>
            <li><a href=""><i class="fa fa-plus"></i> Add Customer</a></li>
        </ul>
    </li>

    <li><a href="logout.php">Logout</a></li>
</ul>

<div class="grid">
    <div class="col_1"></div>
    <div class="col_10">
        <div class="md-container">
            <h3>Add Employee</h3>
            
            <?php if ($flag == 1) { ?>
                <div class="notice success"><i class="icon-ok icon-large"></i> Operation Succeed
                <a href="#close" class="icon-remove"></a></div>
            <?php } ?>

            <form method="post">
                <label for="firstname">Firstname</label>
                <input id="firstname" type="text" name="firstname" class="col_12" placeholder="Enter the Firstname" />

                <label for="lastname">Lastname</label>
                <input id="lastname" type="text" name="lastname" class="col_12" placeholder="Enter the Lastname" />

                <label for="phone">Phone</label>
                <input id="phone" type="text" name="phone" class="col_12" placeholder="Enter the Phone No" />
                
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="col_12" placeholder="Enter the Email" />
                
                <label for="country">Country</label>
                <input id="country" type="text" name="country" class="col_12" placeholder="Enter the Country" />
                
                <label for="city">City</label>
                <input id="city" type="text" name="city" class="col_12" placeholder="Enter the City" />
                
                <label for="address">Address</label>
                <div>
                    <textarea class="col_12" name="address" id="address" placeholder="Enter the Address"></textarea>
                </div>
                
                <label for="username">Username</label>
                <input id="username" type="text" name="username" class="col_12" placeholder="Enter the Username" />
                
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="col_12" placeholder="Enter the Password" />
                
                <label for="role">Role</label>
                <select name="role" id="role" class="col_12">
                    <option value="emp">Employee</option>
                    <option value="admin">Admin</option>
                </select>
                
                <!-- Inset -->
                <button class="outset green" type="submit" name="addEmployee"><i class="fa fa-plus"></i> Add Employee</button>
            </form>
        </div>
    </div>
    <div class="col_1"></div>
</div>



</body>
</html>