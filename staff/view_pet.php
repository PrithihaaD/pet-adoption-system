<?php
include "../db.php";
?>

<link rel="stylesheet" href="../style.css">

<div class="navbar">
    <div class="logo">🐾 Staff Panel</div>
    <div class="nav-links">
        <a href="dashboard.php">Home</a>
        <a href="add_pet.php">Add Pet</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <div class="card">

        <h2>All Pets 🐾</h2>

        <?php
        $result = $conn->query("SELECT * FROM pet");

        while($row = $result->fetch_assoc()){
            echo "
            <div style='margin:10px 0;'>
                <b>{$row['name']}</b> ({$row['breed']})
                <br>
                <a href='update_pet.php?id={$row['pet_id']}'>
                    <button>Edit</button>
                </a>
            </div>
            ";
        }
        ?>

    </div>
</div>