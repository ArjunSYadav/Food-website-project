
<?php
include "config.php";
  session_start();

  if(isset( $_SESSION["username"])){
    header("Location:{$hostname}/admin/post.php");
  }

?>
<!doctype html>
<html>
   <head>
   <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN | Login</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" href="../css/font-awesome.css"> -->
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
        <style>#header-admin{
    background-color: #455b70;}</style>
    </head>
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/header-logo.png">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->

                        <?php
                        if(isset($_POST['login']))
                        {
                            include "config.php";
                            include "_db_pdo.php";
                            $obj =new database();
                            if(empty($_POST['username'] || $_POST['password']))
                            {
                                echo'<div class ="alert alert-danger">Username and Password are nt enter</div>';
                                die();

                            }else{
                                $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $password =md5($_POST['password']);

                            $obj->select('user', " `user_id`, `user_name`, `user_roll` ",null,null, " user_name ='{$username}' AND `user_pass` ='{$password}'",null,null,null);
                            

                            $result =$obj->getResult();

                            if(!empty($result))
                            {
                                // while($row =mysqli_fetch_assoc($result))
                                foreach ($result as list("user_id"=>$uid, "user_name"=>$uname,"user_roll"=>$urole)) 
                                {
                                    session_start();
                                    $_SESSION["username"]=$uname;
                                    $_SESSION["user_id"]=$uid;
                                    $_SESSION["user_role"]=$urole;

                                    header("Location:{$hostname}/admin/post.php");
                                }

                            }
                            else{
                                echo'<div class ="alert alert-danger">Username and Password are nt matched</div>';
                            }
                            }
                            
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
