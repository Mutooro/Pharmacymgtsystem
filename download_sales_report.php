<?php
include("dbcon.php");

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Fetch sales data for the specified date
    $select_sql = "SELECT * FROM sales WHERE Date = '$date'";
    $select_query = mysqli_query($con, $select_sql);

    // Create a CSV file
    $filename = "sales_report_$date.csv";
    $filepath = "C:/invoices/all_invoices/$filename";
    $fp = fopen($filepath, 'w');

    // Add headers to the CSV file
    $headers = array('Date', 'Receipt No.', 'Medicines', 'Total Amount', 'Total Profit');
    fputcsv($fp, $headers);

    // Add sales data to the CSV file
    while ($row = mysqli_fetch_array($select_query)) {
        $data = array($row['Date'], $row['invoice_number'], $row['medicines'], $row['total_amount'], $row['total_profit']);
        fputcsv($fp, $data);
    }

    fclose($fp);

    // Set headers for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($filepath));

    // Read the file and output its contents
    readfile($filepath);

    // Delete the file after download
    unlink($filepath);

    exit;
}
?>
