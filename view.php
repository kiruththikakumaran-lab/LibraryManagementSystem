<?php

include 'config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM entries WHERE name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id DESC";

$result = $conn->query($sql);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

```
<title>View Entries - Library Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">
```

</head>

<body>

```
<div class="container mt-5">

    <h2>All Entries</h2>
    <form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
</form>

    <table class="table table-bordered table-striped table-hover">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>

            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['created_at']}</td>
                    </tr>";

                }

            } else {

                echo "<tr><td colspan='5'>No entries found</td></tr>";

            }

            ?>

        </tbody>

    </table>

</div>
```

</body>
</html>
