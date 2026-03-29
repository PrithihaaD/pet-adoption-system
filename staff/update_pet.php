<?php
include "../db.php";

$id = $_GET['id'];

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age =$_POST['age'];
    $health_status = $_POST['health_status'];
    $conn->query("UPDATE pet 
    SET name='$name', breed='$breed',
    age='$age',health_status='$health_status'
    WHERE pet_id='$id'");

    echo "<script>alert('Updated Successfully');</script>";
}
?>

<link rel="stylesheet" href="../style.css">

<div class="container">
    <div class="card">

        <h2>Update Pet ✏️</h2>

        <form method="POST">
            <input type="text" name="name" placeholder="New Name" required>
            <input type="text" name="breed" placeholder="New Breed" required>
            <input type="text" name="age" placeholder="New age" required>
            <input type="text" name="health_status" placeholder="New health_status" required>

            <button name="update">Update</button>
        </form>

    </div>
</div>