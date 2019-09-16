<?php
ob_start();
require 'config/db.php';
include 'index.php';
if(isset($_POST['submit'])) {
    if (isset($_POST['save-booking'])) {
        $first_name =   $_POST['First_name'] ?? '';
        $second_name =   $_POST['Second_name'] ?? '';
        $hotel_name =   $_POST['Hotel_name'] ?? '';
        $check_in =   $_POST['Check_in'] ?? '';
        $check_out =   $_POST['Check_out'] ?? '';
        $total_price =   00;

        $check_out .= ' 00:00:00';
        $check_in .= ' 00:00:00';
    
        //create query 
        $query_insert   =   "INSERT INTO records(first_name, second_name, hotel_name, check_in, check_out, total_price) VALUES ('$first_name','$second_name','$hotel_name','$check_in', '$check_out', '$total_price')";
    
        if(mysqli_query($conn,$query_insert)){
            header('Location: ' . 'index.php');
            exit;
        }else{
            echo mysqli_error($conn);
            exit;
        }
    }
}
?>
<div class="container">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <input type="text" name="First name" placeholder="First name" required>
    <br>
    <input type="text" name="Second name" placeholder="Second name" required>
    <br>
    <select name="Hotel name">
          <option value="Hilton Resort">Hilton Resort</option>
          <option value="Sun City">Sun City</option>
          <option value="Protea Hotel">Protea Hotel</option>
    </select>
    <br>
    <input type="date" name="Check in" placeholder="Check in" required>
    <br>
    <input type="date" name="Check out" placeholder="Check in" required>
    <br>
    <input type="hidden" name='save-booking'>
    <br>
    <button type="submit" name="submit">Submit your booking</button>

</form>
</div>