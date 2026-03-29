<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🐾 Pet Adoption System</div>

    <div class="nav-links">
        <a href="#">Home</a>
        <a href="view_status.php">View Status</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- HERO (FULL WIDTH GREEN) -->
<div class="hero">
    <h1>Find Your Perfect Companion</h1>
    <p>Adopt a pet and give them a loving home</p>
</div>

<!-- WELCOME -->
<div class="welcome">
  Welcome, 
  <?php 
  if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
  }else{
    echo "User";
  }
  ?> 👋
</div>

<!-- CATEGORY SECTION (WHITE AREA) -->
<div class="category-section">

    <div class="category-container">

        <!-- DOG -->
        <div class="category-card">
            <a href="search_pets.php?type=Dog">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1">
                <h3>Dogs 🐶</h3>
            </a>
        </div>

        <!-- CAT -->
        <div class="category-card">
            <a href="search_pets.php?type=Cat">
                <img src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131">
                <h3>Cats 🐱</h3>
            </a>
        </div>

        <!-- BIRD -->
        <div class="category-card">
            <a href="search_pets.php?type=Bird">
                <img src="https://images.unsplash.com/photo-1444464666168-49d633b86797">
                <h3>Birds 🐦</h3>
            </a>
        </div>

    </div>

</div>

</body>
</html>