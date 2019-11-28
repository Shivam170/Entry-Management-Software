<?php include('header.php')?>
<?php
    include('connection.php');
    $query = "SELECT * FROM admin";
    $result = mysqli_query( $conn, $query );
    
    if( mysqli_num_rows($result) > 0 ) {

        $row = mysqli_fetch_assoc($result);
               
        if(isset($_POST['ok'])){
            if($_POST['username']==$row["username"] && $_POST['password']==$row["password"]){
                    
                    header( "Location: host.php" );
            }else{
               echo "<div class='alert alert-danger'>Incorrect Username or Password</div>";
            }
        }
        

        

    } else {
        echo "Whoops! No results.";
    }

    


?>
            <h1 class="text-center mt-5">Admin Login</h1>
            <div id="form"> 
                <form action="" method="POST">
                    <!-- <img src="https://visualpharm.com/assets/381/Admin-595b40b65ba036ed117d3b23.svg" width=20% alt=""> -->
                    <div class="wrap-input100 mb-4">            
                        <label for="username">Username</label>
                        <input class="input100" type="text" name="username" placeholder="Type your Userame">
                        <span class="focus-input100" ></span>
                    </div>
            
                    <div class="wrap-input100 mb-4">      
                        <label for="password">Password</label>      
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" ></span>
                    </div>
            
                    <button type="submit" name="ok" class="btn btn-primary">Login</button>    
                </form>
            </div>
            <div id="foot">
                <div id="log" class="link pl-5">
                        <a id="link" href="index.php">Home</a>
                </div>
            </div> 
<?php include('footer.php')?>
