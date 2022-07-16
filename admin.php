<!DOCTYPE html>
<html>
<head>
    <?php require_once('relative.php'); ?>
<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: index.php?PleaseLogin');
}
?>
</head>
<body>

<!-- Menu Horizontal -->
<ul class="menu">
    <li class="current"><a href="">Dashboard</a></li>
    <li><a href="">Employees</a>
        <ul>
            <li><a href="EmployeesList.php"><i class="fa fa-list"></i> Employees List</a></li>
            <li><a href="addEmployee.php"><i class="fa fa-plus"></i> Add Employee</a></li>
        </ul>
    </li>
    <li><a href="">Customers</a>
        <ul>
            <li><a href="customersList.php"><i class="fa fa-list"></i> Customers List</a></li>
            <li><a href="addCustomer.php"><i class="fa fa-plus"></i> Add Customer</a></li>
        </ul>
    </li>

    <li><a href="logout.php">Logout</a></li>
</ul>



</body>
</html>