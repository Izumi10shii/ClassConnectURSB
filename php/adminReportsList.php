<?php
include("db_conn.php");
session_start();

/*
// Check if the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: home.php'); // Redirect to home if not an admin
    exit;
}
    */

// Fetch all reports from the database
$query = "SELECT r.report_id, r.post_id, r.reason, r.status, r.reported_at, p.title, p.username AS poster
          FROM post_reports_tb r
          INNER JOIN post_tb p ON r.post_id = p.post_id
          ORDER BY r.reported_at DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reports</title>
    <link rel="stylesheet" href="../css/adminReportsList.css">
</head>
<body>

    <div class="container">
        <h2>Reported Posts</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Post Title</th>
                        <th>Reported By</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Date Reported</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['report_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['poster']); ?></td>
                            <td><?php echo htmlspecialchars($row['reason']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['reported_at']); ?></td>
                            <td>
                                <!-- Button to mark as reviewed -->
                                <form method="POST" action="reviewReport.php" style="display: inline;" onsubmit="location.href='adminDashboard.php';">
                                    <input type="hidden" name="report_id" value="<?php echo $row['report_id']; ?>">
                                    <button type="submit" class="review-btn">Mark as Reviewed</button>
                                </form>
                                <!-- Button to delete the report -->
                                <form method="POST" action="deleteReport.php" style="display: inline;" onsubmit="location.href='adminDashboard.php';">
                                    <input type="hidden" name="report_id" value="<?php echo $row['report_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No reports available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
