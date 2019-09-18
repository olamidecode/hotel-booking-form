
<?php
function dailyRateQuery($hotelQuery){

    include 'connection.php';
    // $hotelInput =   $_POST['hotels'];
//daily rate-- query database based on hotel selected.
    $daily_rate_query   =   "SELECT * FROM hotels WHERE name='$hotelQuery'";
    $result2 = $conn->query($daily_rate_query);
//check if result was successful
    if($result2->num_rows > 0){
        //outputdata
        $row2 = $result2->fetch_assoc();
        //hotel rate
        return $hotelRate = intval($row2['daily_rate']);          
    }
}
//return the amount of hotel stay
function amountDue($check_in,$check_out,$hotelDailyRate){
    $check_in = strtotime($check_in);
    $check_out = strtotime($check_out);
    $hotelstay =($check_out-$check_in)/(60*60*24);
    $amountdue   =   $hotelstay * $hotelDailyRate;
    return $amountdue;

}
function confirmBooking($guestName,$hotel_name,$check_in,$check_out,$amountdue,$first_name,$last_name){
    echo<<<END
    <h1 class="h1 text-center form-heading">CONFIRM BOOKING</h1>
<div class="container confirm-booking">
    <div class="row">
    <div class="col-12">
    <ul class="confirmation-final">
        <li>
        <span class="book-final">
        Guest Name: </span><span class"booking-inputs">$guestName</span>
        </li>
        <li>
        <span class="book-final">
        Hotel: </span><span class"booking-inputs">$hotel_name</span>
        </li>
        <li>
        <span class="book-final">
        Check-In Date: </span><span class"booking-inputs">$check_in</span>
        </li>
        <li>
        <span class="book-final">
        Check-Out Date: </span><span class"booking-inputs">$check_out</span>
        </li>
        <li>
        <span class="book-final">
        Cost: </span><span class"booking-inputs">R$amountdue</span>
        </li>
    </ul>
    </div>
    </div>
</div>              
    <form role="form" method="POST" class="form-holder">
    <input type="hidden" name="first_name-confirm" value="$first_name">
    <input type="hidden" name="last_name-confirm" value="$last_name">
    <input type="hidden" name="hotel-confirm" value="$hotel_name">
    <input type="hidden" name="check_in-confirm" value="$check_in">
    <input type="hidden" name="check_out-confirm" value="$check_out">
    <input type="hidden" name="cost-confirm" value="$amountdue">
    <input type="hidden" name="submit">
    <button type="submit" class="btn btn-primary btn-lg btn-block my-2" name="confirm-booking">Confirm Booking</button>   
    </form>
END;
 
}

//check dupplicate function
function deleteEntry($entryId,$first_name,$last_name,$hotel_name,$check_in,$check_out,$amountdue){
    include 'connection.php';
    $sql_delete =   "DELETE FROM records where id='$entryId'";
    if($conn->query($sql_delete)){
        echo "deleted";
        $sqlInsert = "INSERT INTO 
          records (first_name, last_name, hotel_name, check_in, check_out,amountdue)
           VALUES ('$first_name', '$last_name', '$hotel_name','$check_in','$check_out','$amountdue')";

         if ($conn->query($sqlInsert) === TRUE) {
            echo "New record created successfully";
         } else {
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    }

}


function insertEntry($first_name,$last_name,$hotel_name,$check_in,$check_out,$amountdue){
    include 'connection.php';
    $sqlInsert = "INSERT INTO 
            records (first_name, last_name, hotel_name, check_in, check_out,amountdue)
           VALUES ('$first_name', '$last_name', '$hotel_name','$check_in','$check_out','$amountdue')";
    if ($conn->query($sqlInsert) === TRUE) {
        echo "New record created successfully";
     } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }

}
?>

<!-- Preventing Double Booking 
use Selection -check if user name is already in database 
use the post superglobal to match what is in the database -->
