<?php
include('../db.php');

$type = $_GET['type'] ?? '';

// JOIN with shelter to get shelter name
$sql = "SELECT pet.*, shelter.name AS shelter_name 
        FROM pet 
        JOIN shelter ON pet.shelter_id = shelter.shelter_id";

if($type != ''){
    $sql .= " WHERE species='$type'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pets</title>
<link rel="stylesheet" href="../style.css">
</head>

<?php
include('../db.php');

$type = $_GET['type'] ?? '';

// JOIN with shelter to get shelter name
$sql = "SELECT pet.*, shelter.name AS shelter_name 
        FROM pet 
        JOIN shelter ON pet.shelter_id = shelter.shelter_id";

if($type != ''){
    $sql .= " WHERE species='$type'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pets</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<header>Available Pets</header>

<!-- ✅ POPUP (ADDED) -->
<div id="popup" class="popup">
    Request Sent Successfully ✅
</div>

<div class="pet-container">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="pet-card">

    <h3><?php echo $row['name']; ?></h3>

    <p><b>Breed:</b> <?php echo $row['breed']; ?></p>
    <p><b>Age:</b> <?php echo $row['age']; ?></p>
    <p><b>Status:</b> <?php echo $row['health_status']; ?></p>
    <p><b>Shelter:</b> <?php echo $row['shelter_name']; ?></p>

    <!-- ✅ ONLY THIS PART CHANGED -->
    <button onclick="adoptPet(<?php echo $row['pet_id']; ?>)">Adopt</button>

</div>

<?php } ?>

</div>

<!-- ✅ JAVASCRIPT (ADDED) -->
<script>
function adoptPet(petId){
    fetch("adopt.php?pet_id=" + petId)
    .then(response => response.text())
    .then(() => {
        document.getElementById("popup").style.display = "block";

        setTimeout(() => {
            document.getElementById("popup").style.display = "none";
        }, 2000);
    });
}
</script>

</body>
</html>