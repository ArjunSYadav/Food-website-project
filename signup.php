<?php  require "admin/config.php";
?>
<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//   include 'res/dbconect.php';
 require "admin/config.php";
  
  $obj = new homeclass();

 
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $first_name=mysqli_real_escape_string($conn, $_POST['first_name']);
  $last_name=mysqli_real_escape_string($conn, $_POST['last_name']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

 
  $obj->select('user', "*", null, null,"email = '$email' AND user_name = '$username' ", null, null, null);
  $result = $obj->getResult();
  // $numExistRows= mysqli_num_rows($result);
  if (count($result) > 0) {
    // $exits=true;
    $showError = " Username already Exists";
  } else {
    // $exits=false;


    if (($password == $cpassword)) {
     
      $obj->insert('user', ["email"=>$email,"first_name"=>$first_name,"last_name"=>$last_name,"user_name" => $username, "user_pass" => $password,"user_roll"=>'0']);
      $result1 = $obj->getResult();
      if (!empty($result1)) {
        $showAlert = true;
      }
      // if ($result) {
      //   $showAlert = true;
      // }
    } else {
      $showError = "Password do not match ";
    }
  }
}



?>

<!doctype html>
<html lang="en">

<head>
<?php
//   require 'header.php';
  require 'header.php';
  ?>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <title>Signup</title>
</head>

<body>
 
  <?php
  // <!-- Alert  -->
  if ($showAlert) {
    echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong style="margin-top: 10%;">You have been SignUp</strong> You can login now.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
  }
  // <!-- Alert  --> 
  //warning password do not match

  if ($showError) {
    echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong style="margin-top: 10%;">Error!</strong> ' . $showError . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ';
  }
  ?>


  <div class="container my-4" >
    <h1 class='text-center'style="margin-top: 10%;">Signup to our website!</h1>
    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" style=" display: flex;
    flex-direction: column;
    align-items: center;
    ">
    <div class="form-group  col-md-8">
        <label for="email">Email:</label>
        <input type="email" maxlength="100" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="form-group  col-md-8">
        <label for="firstname">First Name:</label>
        <input type="text" maxlength="100" class="form-control" id="first_name" name="first_name" aria-describedby="emailHelp">
      </div>
      <div class="form-group  col-md-8">
        <label for="lastname">Last Name:</label>
        <input type="text" maxlength="100" class="form-control" id="last_name" name="last_name" aria-describedby="emailHelp">
      </div>
      <div class="form-group  col-md-8">
        <label for="username">User Name:</label>
        <input type="text" maxlength="100" class="form-control" id="username" name="username" aria-describedby="emailHelp">

      </div>
      <div class="form-group col-md-8">
        <label for="password">Password:</label>
        <input type="password" maxlength="23" class="form-control" id="password" name="password">
      </div>
      <div class="form-group col-md-8">
        <label for="cpassword">Confirm Password:</label>
        <input type="password" maxlength="23" class="form-control" id="cpassword" name="cpassword">
        <small id="emailHelp" class="form-text text-muted">Make sure type the same password.</small>
      </div>

      <button type="submit" class="btn btn-primary">Sign-Up</button>
    </form>

  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

 
</body>

</html>