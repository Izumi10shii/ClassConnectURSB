<?php
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];

    // Delete the report from the reports_tb table
    $query = "DELETE FROM post_reports_tb WHERE report_id = $report_id";
    if (mysqli_query($conn, $query)) {
        header('Location: adminDashboard.php?page=reports_management');
        exit;
    } else {
        echo "Error deleting report.";
    }
}
?>
