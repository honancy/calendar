<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
function validateForm() {
var xhttp;
if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
    var x = document.forms["form1"]["event"].value;
    var y = document.forms["form1"]["location"].value;
if (x == null || x == ""||y == null || y == "") {
        alert("Event and location must be filled out");
        return false;
    }

}
function validateForm1() {
var xhttp;
if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
    var x = document.forms["form1"]["event"].value;
    var y = document.forms["form1"]["location"].value;
    var z = document.forms["form1"]["chgdate"].value;
   if (x == null || x == ""||y == null || y == ""||z == null || z == "") {
        alert("Event,location and date must be filled out");
        return false;
    }

}


</script>
</head>
<body>
<center>
<br>
<?php
include 'header.php';
echo '<form role="form" name="form1" action="events.php?d='.$_GET["d"].'" 
 method="POST" >';
$date1=date_parse($_GET["d"]);
$monthName=date("F",mktime(0,0,0,$date1["month"]));
echo 'Events on'.' '.$date1["day"].' '.$monthName.' '.$date1["year"] ;
echo '<br>';
echo '<p id="demo"></p>';
$events='e';
$location='l';
if ($_POST['button']){
if (empty($_SESSION[$events.$_GET["d"]])){
$_SESSION[$events.$_GET["d"]]=array();
$_SESSION[$location.$_GET["d"]]=array();
array_push($_SESSION[$events.$_GET["d"]],$_POST['event']);
array_push($_SESSION[$location.$_GET["d"]],$_POST['location']);
}
else {
array_push($_SESSION[$events.$_GET["d"]],$_POST['event']);
array_push($_SESSION[$location.$_GET["d"]],$_POST['location']);
}
}else{
$date2=$_POST['chgdate'];
if (empty($_SESSION[$events.$date2])){
$_SESSION[$events.$date2]=array();
$_SESSION[$location.$date2]=array();
array_push($_SESSION[$events.$date2],$_POST['event']);
array_push($_SESSION[$location.$date2],$_POST['location']);
}
else {
array_push($_SESSION[$events.$date2],$_POST['event']);
array_push($_SESSION[$location.$date2],$_POST['location']);
}
}
$length1=count($_SESSION[$events.$_GET["d"]]);
for($i=0;$i<$length1;$i++){
print $_SESSION[$events.$_GET["d"]][$i];
echo ' ';
print $_SESSION[$location.$_GET["d"]][$i];
echo '<br>';
}
echo '<br>';
echo 'Events : <br>';
echo '<textarea rows="4" cols="50" name="event" placeholder="Enter event"></textarea>';
echo '<br>';
echo 'Location : <br>';
echo '<input type="text" name="location" placeholder="Enter location">';
echo '<br>';
echo '<input type="submit" class="btn btn-info" onclick="return validateForm()" name="button" value="Submit">';
echo '<br>';
echo 'if you want to move event to another date, please the date at below textbox';
echo '<br>';
echo '<input type="text" name="chgdate" placeholder="Enter date">';
echo '<br>';
echo '<input type="submit" class="btn btn-info" onclick="return validateForm1()"  name="button1" value="Submit">';




echo '</form>';
include 'footer.php';
?>
</center>
</body>
</html>
