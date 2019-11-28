<?php include('header.php')?>
<?php 
    if(isset($_POST['login'])){
        include('connection.php');
        
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];

        $queryc="SELECT * from user where name='$name' and email='$email';";
        $resultc = mysqli_query( $conn, $queryc );
        $rowc = mysqli_fetch_assoc($resultc);
    
        

            if( $name && $email && $contact ) {
                $query = "INSERT INTO user (name, email, contact, checkin, checkout)
                VALUES ('$name', '$email', '$contact', CURRENT_TIMESTAMP, NULL)";
        
                if( mysqli_query( $conn, $query ) ) {
                
                    
                    //Sending email

                    $query1 = "SELECT * from host where id = 1;";
                    $result = mysqli_query( $conn, $query1 );
                    $row = mysqli_fetch_assoc($result);
    
                    $mailto = $row["email"];
                    $mailSub = "Visitor Details";
                    $mailMsg = "Name-$name"."<br>"."Email-$email"."<br>"."Phone-$contact";
                    require 'PHPMailer-master/PHPMailerAutoload.php';
                    $mail = new PHPMailer();
                    $mail ->IsSmtp();
                    $mail ->SMTPDebug = 0;
                    $mail ->SMTPAuth = true;
                    $mail ->SMTPSecure = 'ssl';
                    $mail ->Host = "smtp.gmail.com";
                    $mail ->Port = 465;
                    $mail ->IsHTML(true);
                    $mail ->Username = "sureshsingh1793@gmail.com";
                    $mail ->Password = "suresh@123";
                    $mail ->SetFrom("Entry Management Software");
                    $mail ->Subject = $mailSub;
                    $mail ->Body = $mailMsg;
                    $mail ->AddAddress($mailto);
                    $mail->Send();

                    //Sending SMS
                    // Authorisation details.
                    $username = "sureshsingh1793@gmail.com";
	                $hash = "a681621ea4a2566670b8dbb6763206a01184f53c08ebf2e4a99f2dcdbd0dfb62";

                    // Config variables. Consult http://api.textlocal.in/docs for more info.
                    $test = "0";
                    $number = "91".$row["contact"];
                        
                    // Data for text message. This is the text message data.
                    $sender = "TXTLCL"; // This is who the message appears to be from.
                    $numbers = $number; // A single number or a comma-seperated list of numbers
                    $message = "Name-$name "."Phone-$contact "."email-$email";
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
                    
                    
    
                
            }
        }else{
            echo "<div class='alert alert-info'>Already Checked-in!</div>";
        }
    
    }
?>
        <h2 class="text-center mt-4">Visitor Entry Form</h2>
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
                    <button type="submit" name="login" class="btn btn-success">Check-in</button>    
                </form>
        </div>
        <div id="foot">
                <div class="link pl-5">
                        <a id="link" href="index.php">Home</a>
                </div>
        </div>
<?php include('footer.php')?>