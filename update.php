<?php

include 'config.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "SELECT * FROM entries WHERE id=$id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
}

if(isset($_POST['update'])){

    $name = $_POST['name'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $sql = "UPDATE entries SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if($conn->query($sql) === TRUE){

        header("Location: view.php");

    } else {

        echo "Error updating record: " . $conn->error;

    }

}

?>
<form method="POST" action="">

    <div class="mb-3">

        <label>Name</label>

        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control">

    </div>

    <div class="mb-3">

        <label>Phone</label>

        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" class="form-control">

    </div>

    <button type="submit" name="update" class="btn btn-success">Update</button>

</form>