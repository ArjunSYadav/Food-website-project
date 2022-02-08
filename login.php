<?php include 'admin/config.php';?>
<?php
    $login=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    
     
      
                        if(isset($_POST['login']))
                        {
                            include "admin/config.php";
                            include 'databasefile.php';
                            $obj =new homeclass();
                            if(empty($_POST['email'] || $_POST['password']))
                            {
                                echo'<div class ="alert alert-danger">Username and Password are nt enter</div>';
                                die();

                            }else{
                                $username = mysqli_real_escape_string($conn, $_POST['email']);
                            $password =md5($_POST['password']);

                            $obj->select('user', " `user_id`,`email`, `user_name`, `user_pass` ,`user_roll`",null,null, " `email` ='{$username}' AND `user_pass` ='{$password}'  ",null,null,null);
                            

                            $result =$obj->getResult();

                            if(count($result)==1)
                            {
                                // while($row =mysqli_fetch_assoc($result))
                                foreach ($result as list("user_id"=>$uid, "user_name"=>$uname,"user_roll"=>$urole)) 
                                {
                                    session_start();
                                    $_SESSION["loggedin"] =true;
                                    $_SESSION["username"]=$uname;
                                    $_SESSION["user_id"]=$uid;
                                    $_SESSION["user_role"]=$urole;

                                    
                                }
                                header("Location:{$hostname}/index.php");
                            }
                            else{
                                echo'<div class ="alert alert-danger">Username and Password are nt matched</div>';
                            }
                            }
                            
                        }
                        
                        
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <?php
    require'header.php';
    ?>
    <title>Login</title>
</head>

<body>

    <?php
        // <!-- Alert  -->
        if($login){
            echo'
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>You have been Logged in</strong> You can login now.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
        // <!-- Alert  --> 
        //warning password do not match

        if($showError){
            echo'
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$showError.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
        }
    ?>


    <div class="container my-4">
        <h1 class='text-center'>Login to our website!</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" style=" display: flex;
    flex-direction: column;
    align-items: center;
    ">
            <div class="form-group  col-md-8">
                <label for="username">Email:</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">

            </div>
            <div class="form-group col-md-8">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary"  name="login" value="login">Login</button>
        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    
</body>

</html>