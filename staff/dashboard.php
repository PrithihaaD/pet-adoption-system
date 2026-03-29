<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../login.html");
    exit();
}
?>
<link rel="stylesheet" href="../style.css">

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🐾 Staff Panel</div>

    <div class="nav-links">
        <a href="dashboard.php">Home</a>
        <a href="manage_requests.php">Requests</a>
        <a href="view_pet.php">View pets</a>
        <a href="add_pet.php">Add Pet</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Staff Dashboard</h1>
    <p>Manage adoption requests and pets</p>
</div>
<!-- WELCOME TEXT -->
<div class="welcome">
    Welcome Staff 👋
</div>

<!-- ACTION CARDS -->
<div class="category-section">

    <div class="category-container">

        <div class="category-card">
            <a href="manage_requests.php">
                <h3>📋 Manage Requests</h3>
                <p>Approve or reject adoption</p>
            </a>
        </div>

        <div class="category-card">
            <a href="add_pet.php">
                <h3>➕ Add Pet</h3>
                <p>Add new pets to system</p>
            </a>
        </div>

    </div>

</div>