<?php

session_start();

if(!isset($_POST['nam1']))
{
     $checkboxValue1 ="cb1";
} else {
     $checkboxValue1 = $_POST['nam1'];
}
if(!isset($_POST['nam2']))
{
     $checkboxValue2 = "cb2";
} else {
     $checkboxValue2 = $_POST['nam2'];
}
if(!isset($_POST['nam3']))
{
     $checkboxValue3 = "cb3";
} else {
     $checkboxValue3 = $_POST['nam3'];
}


$con= mysqli_connect("localhost","ParkingUser","epl606","epl606db");
$space = mysqli_query($con,"SELECT space FROM data where parking_id = ".$_POST["parking"]." order by timestamp DESC LIMIT 1") or die(mysqli_error($con));
while ($row = mysqli_fetch_array($space)) {
echo $row["space"];
$command = "python predictt.py ".$_POST["parking"]." ".$_POST["timestamp"]." ". $checkboxValue1." ". $checkboxValue2." ". $checkboxValue3." ".$row["space"];

echo $command;
$output = shell_exec($command);
echo $output;
$_SESSION["output"]=$output;
}
header ('Location: index.php');

?>
