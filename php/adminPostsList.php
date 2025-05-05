<?php
include 'db_conn.php';

if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $delete_query = "DELETE FROM post_tb WHERE post_id = $delete_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: adminDashboard.php?page=post_management");
        exit();
    } else {
        echo "Error deleting post: " . mysqli_error($conn);
    }
}

// Fetch posts
$query = "SELECT p.*, s.username, s.profile_pic
FROM post_tb p
JOIN student_tb s ON p.account_id = s.account_id
ORDER BY p.post_id DESC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Manage Posts</title>
    <link rel="stylesheet" href="../css/adminPostsList.css">
</head>

<body>
    <div class="tableContainer">

        <h2>All Posts</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Media</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['post_id'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>

                    <?php            // Fetch images and files for the post
                    $getFiles = "SELECT file_url FROM post_files_tb WHERE post_id = $row[post_id]";
                    $filesResult = mysqli_query($conn, $getFiles);
                    $files = []; // Reset the files array for each post

                    if ($filesResult && mysqli_num_rows($filesResult) > 0) {
                        while ($fileRow = mysqli_fetch_assoc($filesResult)) {
                            $files[] = $fileRow['file_url'];
                        }
                    }
                    ?>

                    <td class="files">
                        <?php foreach ($files as $file): ?>
                            <?php
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            if (strtolower($fileExtension) === 'pdf'): ?>
                                <!-- Display PDF -->
                                <embed class="docs" src="<?php echo $file; ?>" type="application/pdf" style="width: 20px; height: 20px; overflow: hidden;">
                            <?php else: ?>
                                <!-- Display Image -->
                                <img class="imgs" src="<?php echo $file; ?>" alt="Post File" style="width: 50px; height: 50px; overflow: hidden;">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>

                    <td>
                        <a href="adminPostsList.php?delete_id=<?= $row['post_id'] ?>" class="delete-btn"
                            onclick="return confirm('Are you sure you want to delete this post?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="tableContainer">
        <h2>All Comments</h2>
        <table>
            <tr>
                <th>Post ID</th>
                <th>Username</th>
                <th>Comment Description</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php
            $commentsQuery = "SELECT c.comment_id, c.post_id, c.comment_desc, c.created_at, s.username, s.profile_pic
FROM comment_tb c
JOIN student_tb s ON c.account_id = s.account_id
ORDER BY c.created_at DESC
";
            $commentsResult = mysqli_query($conn, $commentsQuery);

            if ($commentsResult && mysqli_num_rows($commentsResult) > 0):
                while ($comment = mysqli_fetch_assoc($commentsResult)): ?>
                    <tr>
                        <td><?= htmlspecialchars($comment['post_id']); ?></td>
                        <td><?= htmlspecialchars($comment['username']); ?></td>
                        <td><?= htmlspecialchars($comment['comment_desc']); ?></td>
                        <td><?= htmlspecialchars($comment['created_at']); ?></td>
                        <td>
                            <a href="deleteComment.php?comment_id=<?= $comment['comment_id']; ?>" class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete this comment?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile;
            else: ?>
                <tr>
                    <td colspan="5">No comments available.</td>
                </tr>
            <?php endif; ?>
            <br>
        </table>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>