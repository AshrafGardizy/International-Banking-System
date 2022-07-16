<?php require_once('relative.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM customers WHERE id=".$id;
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        header('location: customersList.php?customerDeleted=true');
    }
} else header('location: customersList.php?customerDeleted=false');
?>