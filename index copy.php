<?php
require 'HOTEL-BOOKING-FORM/db.php';
//create Query
$query = 'SELECT * FROM records';

//get results
$result = mysqli_query($conn, $query);

//fetch data
$music = mysqli_fetch_all($result,MYSQLI_ASSOC);
// var_dump($music);
//close connection
mysqli_close($conn);
?>
<?php
include 'index.php';
?>
    
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
</body>
</html>