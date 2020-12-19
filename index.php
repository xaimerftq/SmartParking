<!DOCTYPE html>

<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title> Smart Parking </title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIOuH3LKiE4RGFl3Gr45aopd7MyyHNEEA&libraries=places&sensor=false"></script>

</head>
<body >
<!-- Navigation Bar -->
<div class=" w3-border-bottom w3-xlarge w3-center">
<h1 class="w3-opacity">Smart Parking </h1>
</div>
<!-- end of Navigation Bar -->

<!-- Page content -->
<div class="w3-content w3-center " style="max-width:1100px;">

    <div class="w3-full w3-margin-bottom w3-padding-16">
        <div id="gmap_canvas" style="width:100%;"></div>

        <div id="gmap_input" style=" margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;">
            <img src="unnamed.jpg" style="width: 150px; padding-top: 5px; padding-left: 10px;"><img>

            <p>Parking Availability Prediction:</p>

            <form id="submit-form" action="backEnd.php" method="post">
                Parking List:  <select class="w3-input w3-border" name="parking">
                    <option value="pick">------SELECT-----</option>
<?php
session_start();

$con= mysqli_connect("localhost","ParkingUser","epl606","epl606db");
$sql = mysqli_query($con, "SELECT * From parking");
$row = mysqli_num_rows($sql);
while ($row = mysqli_fetch_array($sql)){
echo "<option value='". $row['uid'] ."'>" .$row['title'] ."</option>" ;
}
?>
</select>
                    <p>
                        <input class="w3-input w3-border" type="datetime-local" placeholder="Time" name="timestamp" id="time"></p>
                    <p><input type="checkbox" id="nam1" name="nam1" value="aTrue"> <label for="vehicle1">
                            Covered</label><br>
                    <p><input type="checkbox" id=nam2" name="nam2" value="bTrue"> <label for="vehicle2">With Asphalt road
                        </label><br>
                    <p><input type="checkbox" id="nam3" name="nam3" value="cTrue"> <label for="vehicle2">Illuminated</label><br>

                    <p><div id="availability" style="font-size:25px;display: inline-block;position: relative;">Availability: </div>
                   <div id="availabilitytValue" style="font-size:25px;display: inline-block;position: relative;">   <b>  
			<?php
			if (isset($_SESSION["output"])) {

			echo $_SESSION["output"];
			

                        }
                        ?>
			</div>
			</b>
			</p>
                    
  <input type="submit" name="select" value="Select" />
                    
                      

            </form>

        </div>
    </div>
</div>

</body>
</html>