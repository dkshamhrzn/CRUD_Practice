<html>

<head>
    <title>Admin Feedback List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Feedback List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Message</th>
            <th>evidence</th>
            <th>Status</th>

            <th>action</th>
        </tr>
        <?php

        foreach ($feedbackList as $fb): ?>
            <tr>
                <td><?= htmlspecialchars($fb['id']) ?></td>
                <td><?= htmlspecialchars($fb['username']) ?></td>

                <td><?= htmlspecialchars($fb['feedback_text']) ?></td>

                <td>
                    <?php if (!empty($fb['image'])): 
                        ?>

                        <img src="<?= htmlspecialchars($fb['image']) ?>" alt="Feedback Image" width="150">
                    <?php else: ?>
                        No image
                    <?php endif; ?>
                </td>


                <td>
                    <form action="index.php?action=update_feedback_status" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($fb['id']) ?>">
                        <select name="status" id="status" aria-label="Change Status">
                            <option value="open" <?= $fb['status'] === 'open' ? 'selected' : '' ?>>pending</option>
                            <option value="resolved" <?= $fb['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                            <option value="ignored" <?= $fb['status'] === 'ignored' ? 'selected' : '' ?>>Ignored</option>
                        </select>
                        <button type="submit" style="background-color: #007BFF;">Update</button>


                    </form>

                </td>
                <td>
                    <form action="index.php?action=delete_feedback" method="POST"
                        onsubmit="return confirm('Are you sure?')">
                        <input type="hidden" name="id" value="<?= $fb['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="index.php?action=logout">Logout</a></p>
</body>

</html>