<?php
    include("connection.php");

    $name = $_POST['name'];
    $mobile = $_POST['mob'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $email = $_POST['email'];
    $add = $_POST['add'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $role = $_POST['role'];

    if($cpass!=$pass){
        echo '<script>
                alert("Passwords do not match!");
                window.location = "../routes/register.php";
            </script>';
    }
    else{
        $duplicate=mysqli_query($connect,"select * from user where mobile='$mobile' or email='$email'");
        if (mysqli_num_rows($duplicate)>0)
        {
        echo '<script>
                alert("Given Number or Email Id is Already Registered");
                window.location = "../routes/register.php";
            </script>';
        }
        else{
            // Generate Vkey
            $vkey = md5(time().$mobile);

        move_uploaded_file($tmp_name,"../uploads/$image");
        $insert = mysqli_query($connect, "insert into user (name, mobile, password, email, address, photo, status, votes, role, vkey) values('$name', '$mobile', '$pass', '$email', '$add', '$image', 0, 0, '$role', '$vkey') ");
        if($insert){

            $to=$email;

            $msg= "Thanks for new Registration.";   

            $subject="Email verification";
            
            $headers = '';

            $headers .= "MIME-Version: 1.0"."\r\n";

            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

            $headers .= 'From:Online Voting System'."\r\n";

            $ms ='';

            $ms.="<html></body><div><div>Dear $name,</div></br></br>";

            $ms.="<div style='padding-top:8px;'>Please click The following link For verifying and activation of your account</div>

            <div style='padding-top:10px;'><a href='http://localhost:8080/project/online-voting-system/routes/email_verification.php?vkey=$vkey'>Click Here</a></div>
            </div>
            </body></html>";

            mail($to,$subject,$ms,$headers);
            echo '<script>
                    alert("Registration successfull! , please verify in the registered Email-Id");
                    window.location = "../";
                </script>';
        }
        else{
            echo '<script>
                    alert("Some Error Occured");
                    window.location = "../routes/register.php";
                </script>';
        }

        }
        
    }
    
?>


