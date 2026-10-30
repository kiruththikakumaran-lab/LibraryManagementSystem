
<?php

include 'config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM entries
        WHERE name LIKE '%$search%'
        OR email LIKE '%$search%'
        ORDER BY id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>View Entries - Library Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">


    <a class="navbar-brand" href="form.html">
        Library Management System
    </a>

    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">

        <ul class="navbar-nav ms-auto">

            <li class="nav-item">
               <a class="nav-link" href="index.html">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="form.html">Add Entry</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="view.php">View Entries</a>
            </li>

        </ul>

    </div>
</div>



</nav>


<div class="container mt-5">

    <h2 class="mb-4">All Entries</h2>
    <?php if (isset($_GET['success'])) { ?>

    <div class="alert alert-success" role="alert">
        Entry submitted successfully!
    </div>

<?php } ?>

    <!-- Search Form -->

    <form method="GET" class="mb-3">

        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search by Name or Email"
               value="<?php if(isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">

    </form>


    <!-- Entries Table -->
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover"
           id="entriesTable">

        <thead>

            <tr>

                <th>ID</th>

                <th onclick="sortTable(1)">Name</th>

                <th onclick="sortTable(2)">Email</th>

                <th onclick="sortTable(3)">Phone</th>

                <th>Created At</th>

                <th>Action</th>

            </tr>

        </thead>


        <tbody>

            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    echo "<tr onmouseover=\"this.style.backgroundColor='#f2f2f2'\"
                              onmouseout=\"this.style.backgroundColor=''\">

                        <td>".$row['id']."</td>

                        <td>".$row['name']."</td>

                        <td>".$row['email']."</td>

                        <td>".$row['phone']."</td>

                        <td>".$row['created_at']."</td>

                        <td>

                            <a href='update.php?id=".$row['id']."'
                               class='btn btn-primary btn-sm'>Edit</a>

                            <button type='button'
        class='btn btn-danger btn-sm'
        data-bs-toggle='modal'
        data-bs-target='#deleteModal".$row['id']."'>
    Delete
</button>
<div class='modal fade' id='deleteModal".$row['id']."' tabindex='-1' aria-hidden='true'>

    <div class='modal-dialog'>

        <div class='modal-content'>

            <div class='modal-header'>

                <h5 class='modal-title'>Confirm Delete</h5>

                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>

            </div>

            <div class='modal-body'>

                Are you sure you want to delete this entry?

            </div>

            <div class='modal-footer'>

                <a href='delete.php?id=".$row['id']."' class='btn btn-danger'>Yes, Delete</a>

                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>

            </div>

        </div>

    </div>

</div>

                        </td>

                    </tr>";

                }

            } else {

                echo "<tr>
                        <td colspan='6'>No entries found</td>
                      </tr>";

            }

            ?>

        </tbody>

    </table>
    </div>

</div>


<!-- JavaScript Table Sorting -->

<script>

function sortTable(n) {

    let table, rows, switching, i, x, y, shouldSwitch;

    table = document.getElementById("entriesTable");

    switching = true;

    while (switching) {

        switching = false;

        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {

            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];

            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {

                shouldSwitch = true;

                break;

            }

        }

        if (shouldSwitch) {

            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);

            switching = true;

        }

    }

}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

