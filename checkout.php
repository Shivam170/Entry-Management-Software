<?php include('header.php')?>
<?php
    include('connection.php');
    if(isset($_POST['checkout'])){
        include('connection.php');
        
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        
        

        if( $name && $email && $contact ) {
            $time=date('Y/m/d H:i:s');
            $query = "UPDATE `user` SET `checkout` = '$time' WHERE `name` = '$name' and `email` = '$email';";
            
    
            if( mysqli_query( $conn, $query ) ) {
                $query1 = "SELECT * from user WHERE name = '$name' and email = '$email';";
                $result = mysqli_query( $conn, $query1 );
                $row = mysqli_fetch_assoc($result);
                
                $str=$row["checkout"];
                $cout=explode(' ',$str,2);

                $str1=$row["checkin"];
                $cin=explode(' ',$str1,2);
                
                $query2 = "SELECT * from host WHERE id = 1;";
                $result1 = mysqli_query( $conn, $query2 );
                $row1 = mysqli_fetch_assoc($result1);
                
                $hname=$row1["name"];
                $add=$row1["address"];
                $mailto = $email;
                $mailSub = "Visit Details";
                $mailMsg = "Name-$name"."<br>"."Phone-$contact"."<br>"."Address visited-$add"."<br>"."Host name-$hname"."<br>"."Check-in time-$cin[1]"."<br>"."Check-out time-$cout[1]";
                require 'PHPMailer-master/PHPMailerAutoload.php';
                $mail = new PHPMailer();
                $mail ->IsSmtp();
                $mail ->SMTPDebug = 0;
                $mail ->SMTPAuth = true;
                $mail ->SMTPSecure = 'ssl';
                $mail ->Host = "smtp.gmail.com";
                $mail ->Port = 465; // or 587
                $mail ->IsHTML(true);
                $mail ->Username = "sureshsingh1793@gmail.com";
                $mail ->Password = "suresh@123";
                $mail ->SetFrom("Entry Management Software");
                $mail ->Subject = $mailSub;
                $mail ->Body = $mailMsg;
                $mail ->AddAddress($mailto);
                $mail->Send();


                
                // Authorisation details.
                $username = "sureshsingh1793@gmail.com";
                $hash = "a681621ea4a2566670b8dbb6763206a01184f53c08ebf2e4a99f2dcdbd0dfb62";

                // Config variables. Consult http://api.textlocal.in/docs for more info.
                $test = "0";
                $number = "91".$contact;
                    
                // Data for text message. This is the text message data.
                $sender = "TXTLCL"; // This is who the message appears to be from.
                $numbers = $number; // A single number or a comma-seperated list of numbers
                $message = "Name-$name "."Phone-$contact "."Address visited-$add "."Host name-$hname "."Check-in time-$cin[1] "."Check-out time-$cout[1]";
                // 612 chars or less
                // A single number or a comma-seperated list of numbers
                $message = urlencode($message);
                $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                $ch = curl_init('http://api.textlocal.in/send/?');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch); // This is the result from the API
                curl_close($ch);
                $result;
            } else {
                echo "<div class='alert alert-danger'>There was an error occured</div>";
                
            }
        }

                

                

        


    }
?>
        <h2 class="text-center mt-4">Visitor Checkout Form</h2>
        <div id="form"> 
                <form action="" method="POST">
                    
                    <div class="wrap-input100 mb-4">            
                        <label for="name">Name</label>
                        <input class="input100" type="text" name="name" placeholder="Type your Name" required>
                        <span class="focus-input100" ></span>
                    </div>
            
                    <div class="wrap-input100 mb-4">      
                        <label for="email">Email Id</label>      
                        <input class="input100" type="email" name="email" placeholder="Type your Email Id" required>
                        <span class="focus-input100" ></span>
                    </div>
            
                    <div class="wrap-input100 mb-4">            
                        <label for="contact">Contact No.</label>
                        <input class="input100" type="text" name="contact" placeholder="Type your Contact No." required>
                        <span class="focus-input100" ></span>
                    </div>
                    <button type="submit" name="checkout" class="btn btn-success">Check-Out</button>    
                </form>
                

        </div>
        <div id="foot">
                <div class="link pl-5">
                        <a id="link" href="index.php">Home</a>
                </div>
        </div>  
<?php include('footer.php')?>