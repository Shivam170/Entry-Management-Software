<?php include('header.php')?>
<?php 
    include('connection.php');
    if(isset($_POST['update'])){
        include('connection.php');
        
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $address=$_POST['address'];
        

        if( $name && $email && $contact ) {
            $query = "UPDATE `host` SET `name` = '$name', `email` = '$email', `contact` = '$contact', `address` = '$address' WHERE `id` = 1;";
            
    
            if( mysqli_query( $conn, $query ) ) {
                echo "<div class='alert alert-success'>Record in updated!</div>";
            } else {
                echo "<div class='alert alert-danger'>". mysqli_error($conn)."</div>";
                
            }
        }
    }

?>              
            <h1 class="mt-3 text-center" >Host Details</h1>
            <div id="form" > 
                <form action="" method="POST">
                    
                    <div class="wrap-input100 mb-4">            
                        <label for="hname">Name</label>
                        <input class="input100" type="text" name="name" placeholder="Type your Name">
                        <span class="focus-input100" ></span>
                    </div>
            
                    <div class="wrap-input100 mb-4">      
                        <label for="hemail">Email Id</label>      
                        <input class="input100" type="text" name="email" placeholder="Type your Email Id">
                        <span class="focus-input100" ></span>
                    </div>
            
                    <div class="wrap-input100 mb-4">            
                        <label for="hcontact">Contact No.</label>
                        <input class="input100" type="text" name="contact" placeholder="Type your Contact No.">
                        <span class="focus-input100" ></span>
                    </div>

                    <div class="wrap-input100 mb-4">            
                            <label for="address">Address</label>
                            <input class="input100" type="text" name="address" placeholder="Type Address">
                            <span class="focus-input100" ></span>
                    </div>
                    <button type="submit" name="update" class="btn btn-success">UPDATE DETAILS</button>    
                </form>
            </div>
            <div id="host">
                <div id="" class="link pl-5">
                        <a id="link" href="index.php">Home</a>
                </div>
        </div>
<?php include('footer.php')?>                