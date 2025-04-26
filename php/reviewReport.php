<?php
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];

    // Update the status of the report to 'reviewed'
    $query = "UPDATE post_reports_tb SET status = 'reviewed' WHERE report_id = $report_id";
    if (mysqli_query($conn, $query)) {
        header('Location: adminReportsList.php');
        exit;
    } else {
        echo "Error updating report status.";
    }
}
?>
