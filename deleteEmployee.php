<?php require_once('relative.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM employees WHERE id=".$id;
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        header('location: employeesList.php?employeeDeleted=true');
    }
} else header('location: employeesList.php?employeeDeleted=false');
?>