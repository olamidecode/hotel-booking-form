<?php
ob_start();
include ('user.php');
include('connection.php');
include 'inc/header.php';
?>
    <div class="container">
        <div class="row">
        <div class="col-lg-6 mx-2 my-2 bg-transparent form-col">
            <div class="form-container body-form">
            <h1 class="h1 text-center form-heading"> NAV HOTEL BOOKINGS</h1>
            </div>
            <!--Form Starts Here-->
            <form role="form" method="POST" class="form-holder"> 
            <div class="form-group"> 
                <label for="name">Name</label> 
                <input type="text" class="form-control" id="name"  
                    placeholder="Please Enter First Name" name="name" required> 
            </div> 
            <div class="form-group"> 
                <label for="surname">Surname</label> 
                <input type="text"  class="form-control" id="surname" placeholder="Please Enter Your Surname." name="surname"required> 
            </div>
            <div class="form-group"> 
            <label for="name">Select hotel</label> 
            <!--PHP CODE TO INSTERT HOTELS IN THE DATABASE-->
            <select name ="hotels"class="form-control">
            <?php
            // function to load hotels
            include 'hotels.php';
            loadHotels();
            ?>
            </select>  
            </div>
            <div class="form-row">
                <div class="col-5 check-in-date">
                <label for="check-in">Select Check-in Date<span class="glyphicon glyphicon-calender"></span></label>
                <input type="date" class="form-control" placeholder=".col-5" name="check-in" value="<?php echo date("Y-m-d");?>"required>
                </div>
                <div class="col-5 check-out-date">
                <label for="check-out">Select Check-out Date<span class="glyphicon glyphicon-calender"><i class="fab fa-html5"></i></span></label>
                <input type="date" class="form-control" placeholder=".col-3" name="check-out" required> 
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block my-2" name="submit">Submit Booking</button> 
            </form>
            <!--Form ENDS Here-->
        </div>
        <div class="col-lg-4 my-2 confirm-container">

        <?php
        if(isset($_POST['submit'])){
            if(!isset($_POST['confirm-booking'])){
                //display the inputs
                 //first name of guest
            $first_name  =   $_POST['name'];
            //surname of guest
            $last_name   =   $_POST['surname'];
            //concatenate names to one-- for outoput purposes
            $guestName  =   $first_name." ".$last_name;
            //important variables
            //hotel selected
            $hotel_name =   $_POST['hotels'];
            include 'dailyrate.php';
            $hotelRate = dailyRateQuery($hotel_name);
            //code block to calculate the number of days guest will stay at hotel.
            //Check in date -STRING
            $check_in    =  $_POST['check-in'];
            //check out date -STRING
            $check_out    = $_POST['check-out'];
            $amountdue = amountDue($check_in,$check_out,$hotelRate);
            // // create a function
            confirmBooking($guestName,$hotel_name,$check_in,$check_out,$amountdue,$first_name,$last_name);
            }//else statement to check for duplicate bookings or insert new bookings
            else{
                //once set send to mySQL
                $first_name  =   $_POST['first_name-confirm'];
                $last_name   =   $_POST['last_name-confirm'];
                $check_in    =   $_POST['check_in-confirm'];
                $check_out   =   $_POST['check_out-confirm'];
                $hotel_name =  $_POST['hotel-confirm'];
                $amountdue  =   $_POST['cost-confirm'];
                //select from database where name,hotel, if non exits insert into database

                //query the database 

                $sql_search ="SELECT * FROM  records WHERE first_name = '$first_name 'AND  last_name= '$last_name'";
                $tableSearch_result = $conn->query($sql_search);
                if($tableSearch_result->num_rows>0){
                    $existBooking   = $tableSearch_result->fetch_assoc();
                    $existingBooking_id = $existBooking['id'];
                    $existBooking_first_name = $existBooking['first_name'];
                    $existBooking_last_name = $existBooking['last_name'];
                    $existBooking_hotel = $existBooking['hotel_name'];
                    $existBooking_check_in =$existBooking['check_in'];
                    $existBooking_check_out =$existBooking['check_out'];
                    echo<<<END
                    <div class="container">
                    <div class="row">
                        <div class="col-12">
                        <h2 class="h2 text-center">Previous Booking Found!!</h2>
                        <p>Would you like to delete your previous booking or continue with this one?</p>
                        <ul>
                            <li>Name: $existBooking_first_name $existBooking_last_name</li>
                            <li>Hotel: $existBooking_hotel</li>
                            <li> Check In Date: $existBooking_check_in</li>
                            <li> Check Out Date: $existBooking_check_out</li>
                        </ul>
                        <form method="POST">
                        <input type="hidden"  name="replace-id" value="$existingBooking_id">
                        <input type="hidden" name="confirm-booking">
                        <input type="hidden" name="first_name-confirm" value="$first_name">
                        <input type="hidden" name="last_name-confirm" value="$last_name">
                        <input type="hidden" name="hotel-confirm" value="$hotel_name">
                        <input type="hidden" name="check_in-confirm" value="$check_in">
                        <input type="hidden" name="check_out-confirm" value="$check_out">
                        <input type="hidden" name="cost-confirm" value="$amountdue">
                        <input type="hidden" name="submit">
                        <input type="submit" name="previous" value="Yes">
                        <input type="submit" name="previous" value="No">
                        </form>
                        </div>
                    </div>
                    </div>
END;
            }else{include 'dailyrate.php';
                insertEntry($first_name,$last_name,$hotel_name,$check_in,$check_out,$amountdue);}  
        }
        if(isset($_POST['previous'])){
            if($_POST['previous'] == 'Yes'){
                $existingBooking_id = $_POST['replace-id'];
                include 'dailyrate.php';
                deleteEntry($existingBooking_id,$first_name,$last_name,$hotel_name,$check_in,$check_out,$amountdue);
                echo "replace ---- ". $existingBooking_id; 
                echo "last_name: " . $first_name;
            }else{
                header('Location: index.php');
            }
        }
    }
        ?>
        </div>  
        </div>
    </div>
</body>
</html>