<?php 
include 'db_connect.php'; 
date_default_timezone_set('Asia/Manila'); // Set timezone to your local time

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch the logged-in user's name from the database
$user_name = 'N/A'; // Default value if user not found
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Fetch user name from the database
    $user_result = $conn->query("SELECT name FROM users WHERE id = '$user_id'");
    if ($user_result && $user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_name = htmlspecialchars($user_row['name']); // Sanitize output
    }
}
?>

<style>
h1 {
    margin-top: 50px;
    font-size: 24px;
    font-weight: 700;
    text-align: center;
}

/* Hide print button during printing */
@media print {
    #print-btn {
        display: none;
    }
}
</style>

<h1>Sales Orders Today</h1>

<div>
    Logged in as: 
    <span class="login-name">
        <?php echo $user_name; // Display the user name ?>
    </span>

    <p><span id="liveDateTime"></span></p>
</div>

<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-header">
            <b>List of Orders Today</b>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="sales-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Invoice</th>
                        <th>Order Number</th>
                        <th class="text-center">Amount</th>
                        <th>Date Created</th>
                        <th>User</th> <!-- User Column -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $today = date('Y-m-d');
                    
                    // Fetch orders along with the user name
                    $order = $conn->query("SELECT o.*, u.name AS user_name FROM orders o 
                                           LEFT JOIN users u ON o.user_id = u.id 
                                           WHERE DATE(o.date_created) = '$today' 
                                           ORDER BY unix_timestamp(o.date_created) DESC");

                    if ($order->num_rows > 0) {
                        while($row = $order->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td>
                            <p><?php echo date("M d,Y", strtotime($row['date_created'])); ?></p>
                        </td>
                        <td>
                            <p><?php echo $row['amount_tendered'] > 0 ? $row['ref_no'] : 'N/A'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $row['order_number']; ?></p>
                        </td>
                        <td class="text-center text-center-amount">
                            <p><?php echo '₱' . number_format($row['total_amount'], 2); ?></p>
                        </td>
                        <td>
                            <p><?php echo date("M d, Y h:i A", strtotime($row['date_created'])); ?></p>
                        </td>
                        <td>
                            <p><?php echo isset($row['user_name']) ? htmlspecialchars($row['user_name']) : 'N/A'; ?></p>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No orders found for today.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="col-md-12 mb-4">
                <center>
                    <button class="btn btn-success btn-sm col-sm-3" type="button" id="print-btn"><i class="fa fa-print"></i> Print</button>
                </center>
            </div>
        </div>
    </div>
</div>

<noscript>
    <style>
        table#sales-table{
            width:100%;
            border-collapse:collapse;
        }
        table#sales-table td, table#sales-table th{
            border:1px solid #000;
            padding:5px;
        }
        .text-center{
            text-align:center;
        }
        .text-right{
            text-align:right;
        }
    </style>
</noscript>

<script>
    // Attach print function to the print button
    document.getElementById('print-btn').addEventListener('click', function() {
        // Create a new window for the print view
        var printWindow = window.open('', '_blank', 'width=800,height=600');
        
        // Extract content to print
        var tableContent = document.querySelector('.card-body').innerHTML;

        // HTML structure for the print window
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Sales Orders Today</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        table, th, td {
                            border: 1px solid black;
                        }
                        th, td {
                            padding: 8px;
                            text-align: center;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                    </style>
                </head>
                <body>
                    <h1>Sales Orders Today</h1>
                    ${tableContent}
                </body>
            </html>
        `);

        // Trigger the print dialog
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();

        // Close the print window after printing
        printWindow.close();
    });
</script>
