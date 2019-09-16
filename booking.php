<!-- php code -->
<?php
require 'config/db.php';
//create Query
$query = 'SELECT * FROM hotel_booking';

//get results
$hotel_booking = mysqli_query($conn, $query);

//fetch data
$records=[];
// var_dump($music);
//close connection
if($hotel_booking) {
  $records = mysqli_fetch_all($hotel_booking,MYSQLI_ASSOC);
  mysqli_close($conn);

}

?>
<?php
include 'inc/header.php';
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap cdn stylesheet -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- main stylesheet -->
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <title>Hotel-Booking-form</title>
</head>
<body>
<!-- form method -->
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<!-- nav-bar -->
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Akin's-Bookings</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="booking.php">Booking Page </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Hotels
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> -->
<!-- ending of nav-bar -->
<div class="card text-center">
  <div class="card-header">
    <p>HOTEL BOOKING</p>
  </div>
  <div class="card-body">
    <h5 class="card-title">Our moto and goals</h5>
    <p class="card-text">The harder you work for something, the greater you'll feel when you achieve it.</p>
    <a href="#formbooking" class="btn btn-primary">To the booking form</a>
  </div>
</div>
<!-- <div id="formbooking">
<p>First name<p>
<input type="text" name="first name" required>
<p>Second name<p>
<input type="text" name="second name" required>
<p>Select a hotel of your choice</p>
<select name="hotels" required>
    <option value="Protea hotel">Protea hotel</option>
    <option value="Hilton Resort">Hilton Resort</option>
    <option value="Sun City">Sun City</option>
  </select>
<p>Pick your check in date</p> 
<input type="date" name="check in" required>
<p>Pick your check in date</p> 
<input type="date" name="check out" required>
<p>How many people </p> 
<input type="number"name="amount people" required>
<br>
<input type="submit" name="submit">
</div> -->

<!-- hotel booking form -->
<div class="container">
        <?php foreach($records as $key):?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $key['first_name']?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $key['second_name'];?></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $key['hotel_name'];?></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $key['check_in'];?></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $key['check_out'];?></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $key['total_amount'];?></h6>

            </div>
        </div>
        <?php endforeach;?>
    </div>

<!-- bootstrap js and jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- main js -->
<script src="js/main.js"></script>

</body>

</html>