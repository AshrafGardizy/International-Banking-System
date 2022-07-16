<!DOCTYPE html>
<html>
<head>
    <?php require_once('relative.php'); ?>
<?php
if (!isset($_SESSION['cust_id'])) {
    header('location: index.php?PleaseLogin');
}
$cust_id = $_SESSION['cust_id'];

$query_sel_customer = "SELECT * FROM customers WHERE id=".$cust_id;
$query_sel_customer_run = mysqli_query($con, $query_sel_customer);
$customer_row = mysqli_fetch_assoc($query_sel_customer_run);

$query_sel_transactions = "SELECT * FROM transactions WHERE sender_id='$customer_row[id]'";
$query_sel_transactions_run = mysqli_query($con, $query_sel_transactions);
$transactions_num = mysqli_num_rows($query_sel_transactions_run);
$transactions_row = mysqli_fetch_assoc($query_sel_transactions_run);
?>
</head>
<body>

<!-- Menu Horizontal -->
<ul class="menu">
    <li class="current"><a href="customerDashboard.php">Dashboard</a></li>
    <li><a href="transactions.php">Transactions</a></li>
    <li><a href="">Payments</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<div class="grid">
    <div class="col_2"></div>
    <div class="col_8">
        <h3>Hi, <?= $customer_row['firstname']; ?></h3>
        <p>(Total Money <?= $customer_row['balance']; ?>)</p>
        <strong>Account No: (<?= $customer_row['account_no']; ?>)</strong>
        <hr>
        <h5>Recent Transactions</h5>
        <?php if ($transactions_num == 0) {
            echo '<p>No Recent Transactions!</p>';
        } else { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Account No</th>
                <th>Amount</th>
                <th>Transaction Date</th>
            </tr>
            <?php do { ?>
                <tr>
                    <td><?= $transactions_row['id']; ?></td>
                    <td><?= $transactions_row['account_no']; ?></td>
                    <td><?= $transactions_row['amount']; ?></td>
                    <td><?= $transactions_row['trans_date']; ?></td>
                </tr>
            <?php } while ($transactions_row = mysqli_fetch_assoc($query_sel_transactions_run)); ?>
        </table>
        <?php } ?>
    </div>
    <div class="col_2"></div>
</div>

</body>
</html>