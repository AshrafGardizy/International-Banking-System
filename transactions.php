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

// Transaction
$flag = 1;
if (isset($_POST['transfer'])) {
    $account_no = $_POST['account_no'];
    $amount = $_POST['amount'];
    if ($account_no == $customer_row['account_no']) {
        $flag = 'transfering to myself';
    }
    // Account Existence
    $query_exist = "SELECT * FROM customers WHERE account_no='$account_no'";
    $query_exist_run = mysqli_query($con, $query_exist);
    if (mysqli_num_rows($query_exist_run) == 0) {
        $flag = 'account is not exists';
    }

    $query_transfer = "INSERT INTO transactions VALUES(NULL, '$customer_row[id]', '$account_no', '$amount', CURRENT_TIMESTAMP())";
    $query_transfer_run = mysqli_query($con, $query_transfer);
    if ($query_transfer_run) {
        $final_balance = $customer_row['balance'] - $amount;
        $query_update = "UPDATE customers SET balance='$final_balance' WHERE id='$customer_row[id]'";
        $query_update_run = mysqli_query($con, $query_update);

        $query_receive_sel = "SELECT * FROM customers WHERE account_no='$account_no'";
        $query_receive_sel_run = mysqli_query($con, $query_receive_sel);
        $query_receive_row = mysqli_fetch_assoc($query_receive_sel_run);
        $receiver_balance = $query_receive_row['balance'];
        $final_receiver_balance = $receiver_balance + $amount;
        $query_receive_update = "UPDATE customers SET balance='$final_receiver_balance' WHERE account_no='$account_no'";
        $query_receive_update_run = mysqli_query($con, $query_receive_update);
        
        header('location: transactions.php?succeed=true');
    }
}
?>
</head>
<body>

<!-- Menu Horizontal -->
<ul class="menu">
    <li><a href="customerDashboard.php">Dashboard</a></li>
    <li class="current"><a href="transactions.php">Transactions</a></li>
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
        <h5>New Transactions</h5>
        
        <!-- Errors -->
        <?php if ($flag == 'transfering to myself') { ?>
            <b class="error-text">Error! You are Transfering to yourself!</b>
        <?php } ?>
        <?php if ($flag == 'account is not exists') { ?>
            <b class="error-text">Error! The Account You are Transfering is not Exists!</b>
        <?php } ?>
        <?php if (isset($_GET['succeed'])) { ?>
            <div class="notice success"><i class="icon-ok icon-large"></i> Operation Succeed
            <a href="#close" class="icon-remove"></a></div>
        <?php } ?>

        <form method="post">
            <label for="account_no">Account No</label>
            <input id="account_no" type="number" name="account_no" class="col_12" placeholder="Enter the Account No" required="" />

            <label for="amount">Amount</label>
            <input id="amount" min="1" max="<?= $customer_row['balance']; ?>" type="number" name="amount" class="col_12" placeholder="Enter the Amount to Transfer" required="" />

            <button class="inset green" name="transfer" type="submit"><i class="fa fa-send"></i> Transfer</button>
        </form>
    </div>
    <div class="col_2"></div>
</div>

</body>
</html>