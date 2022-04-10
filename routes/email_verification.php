
<?php
include '../api/connection.php';
if(!empty($_GET['vkey']) && isset($_GET['vkey']))
{
$code=$_GET['vkey'];
$sql=mysqli_query($connect,"SELECT * FROM user WHERE vkey='$code'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
  $st=0;
  $result =mysqli_query($connect,"SELECT id FROM user WHERE vkey='$code' and verification_status='$st'");
  $result4=mysqli_fetch_array($result);   
  if($result4>0) 
  {
    $st=1;
    $result1=mysqli_query($connect,"UPDATE user SET verification_status='$st' WHERE vkey='$code'");
    $msg="Your account is activated"; 
  }
  else
{
    $msg ="Your account is already active, no need to activate again";
}
}
else
{
    $msg ="Wrong activation code.";
}
}

?>

<html>
    <head>
        <title>Online voting system - Registratrion</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>
    <body>
        <center>
            <div id="headerSection">
            <h1>Online Voting System - Email Verification Successful</h1>  
            </div>
            <hr>
            <h2>Registration</h2>
            <h3><?php echo htmlentities($msg); ?></h3>
            <p> Now you can login</p>
            <p>For login <a href="../">Click Here</a></p>
                
            </center>
    </body>
</html>