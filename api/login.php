<?php
    session_start();
    include("connection.php");

    $mobile = $_POST['mob'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    
    $check = mysqli_query($connect, "select * from user where mobile='$mobile' and password='$pass' and role='$role' ");
    // $num=mysqli_fetch_array($check);
    // $statuss=$num['verification_status'];
    if(mysqli_num_rows($check)>0){
        $getGroups = mysqli_query($connect, "select name, photo, votes, id from user where role=2 ");
            if(mysqli_num_rows($getGroups)>0){
                $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
                $_SESSION['groups'] = $groups;
            }
            $data = mysqli_fetch_array($check);
            $statuss=$data['verification_status'];
            if($statuss==0)
            {
                echo '<script>
                    alert("Verify  your Email Id by clicking  the link In your mailbox");
                    window.location = "../";
                </script>';
            }

            $_SESSION['id'] = $data['id'];
            $_SESSION['status'] = $data['status'];
            $_SESSION['data'] = $data;
        echo '<script>
                window.location = "../routes/dashboard.php";
            </script>';
        }
    else {
        echo '<script>
                alert("Invalid credentials!");
                window.location = "../";
            </script>';
    }
    
?>