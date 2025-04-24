<?php
include 'db_conn.php';

if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $delete_query = "DELETE FROM post_tb WHERE post_id = $delete_id";
    
    if (mysqli_query($conn, $delete_query)) {
        header("Location: adminPostsList.php");
        exit();
    } else {
        echo "Error deleting post: " . mysqli_error($conn);
    }
}

// Fetch posts
$query = "SELECT * FROM post_tb ORDER BY post_id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Posts</title>
    <link rel="stylesheet" href="../css/adminPostsList.css">
</head>
<body>
    <h2>All Posts</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['post_id'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
                <td>
                    <a href="adminPostsList.php?delete_id=<?= $row['post_id'] ?>" 
                       class="delete-btn" 
                       onclick="return confirm('Are you sure you want to delete this post?');">
                       Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
mysqli_close($conn);
?>
