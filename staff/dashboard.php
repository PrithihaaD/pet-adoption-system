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

<!-- FIRST ROW -->
<div class="category-section">

    <div class="category-container" style="
        display:flex;
        justify-content:center;
        gap:20px;
        flex-wrap:nowrap;
    ">

        <!-- Manage Requests -->
        <div class="category-card" style="width:220px;">
            <a href="manage_requests.php">
                <h3>📋 Manage Requests</h3>
                <p>Approve or reject adoption</p>
            </a>
        </div>

        <!-- Add Pet -->
        <div class="category-card" style="width:220px;">
            <a href="add_pet.php">
                <h3>➕ Add Pet</h3>
                <p>Add new pets to system</p>
            </a>
        </div>

        <!-- Manage Appointments -->
        <div class="category-card" style="width:220px;">
            <a href="manage_appointments.php">
                <h3>🩺 Manage Appointments</h3>
                <p>View vet appointments</p>
            </a>
        </div>

        <!-- Vet Schedule -->
        <div class="category-card" style="width:220px;">
            <a href="view_schedule.php">
                <h3>📅 Vet Schedule</h3>
                <p>View vet availability</p>
            </a>
        </div>

    </div>

</div>