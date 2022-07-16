<!DOCTYPE html>
<html>
<head>
    <?php require_once('relative.php'); ?>
<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: index.php?PleaseLogin');
}

$admin_info = $_SESSION['admin_info'];

$flag = 0;
// Select Employees
$query = "SELECT * FROM employees";
$query_run = mysqli_query($con, $query);
$nums = mysqli_num_rows($query_run);
$rows = mysqli_fetch_assoc($query_run);

?>
</head>
<body>

<!-- Menu Horizontal -->
<ul class="menu">
    <li><a href="admin.php">Dashboard</a></li>
    <li class="current"><a href="">Employees</a>
        <ul>
            <li class="current"><a href="EmployeesList.php"><i class="fa fa-list"></i> Employees List</a></li>
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

<div class="grid">
    <div class="col_1"></div>
    <div class="col_10">
        <h3>Employees List (Total: <?= $nums; ?>)</h3>
        
        <?php if ($flag == 1) { ?>
            <div class="notice success"><i class="icon-ok icon-large"></i> Operation Succeed
            <a href="#close" class="icon-remove"></a></div>
        <?php } ?>
        
        <?php if ($nums == 0) { ?>
            <div class="notice danger"><i class="icon-ok icon-large"></i> No Record Found!
            <a href="#close" class="icon-remove"></a></div>
        <?php } else { ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <?php do { ?>
                    <tr>
                        <td><?= $rows['id']; ?></td>
                        <td><?= $rows['firstname']; ?></td>
                        <td><?= $rows['lastname']; ?></td>
                        <td><?= $rows['phone']; ?></td>
                        <td><?= $rows['email']; ?></td>
                        <td><?= $rows['country']; ?></td>
                        <td><?= $rows['city']; ?></td>
                        <td><?= $rows['address']; ?></td>
                        <td><?= $rows['username']; ?></td>
                        <td><?= ($rows['role']=='emp')?('Employee'):('Admin'); ?></td>
                        <td>
                            <?php if ($admin_info['id'] != $rows['id']) { ?>
                                <a href="updateEmployee.php?id=<?= $rows['id'] ?>"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirmation()" href="deleteEmployee.php?id=<?= $rows['id'] ?>"><i class="fa fa-minus-square"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } while ($rows = mysqli_fetch_assoc($query_run)); ?>
            </table>
        <?php } ?>
    </div>
    <div class="col_1"></div>
</div>



</body>
</html>