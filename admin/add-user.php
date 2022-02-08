<?php include "header.php"; 
 if($_SESSION["user_role"] =='0'){
    header("Location: {$hostname}/admin/post.php");

}


if(isset($_POST['save']))
{
    include "config.php";
    include "_db_pdo.php";
    $obj =new database();

    $fname =mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $user =mysqli_real_escape_string($conn, $_POST['user']);
    $password =mysqli_real_escape_string($conn,md5( $_POST['password']));
    $role =mysqli_real_escape_string($conn, $_POST['role']);

    // $sql =" SELECT username FROM user WHERE username ='{$user}'";
    $obj->select('user',"user_name",null,null,"user_name ='{$user}' ",null,null,null);
    $result =$obj->getResult();
    if(!empty($result))
    {
        echo "<p style ='color:red;text-align:center;margin:10px;0'>User already exist.</p>";
    }else{
        // $sql1 ="INSERT INTO user (first_name,last_name,username,password,role) VALUE ('{$fname}','{$lname}','{$user}','{$password}','{$role}')";
        $obj->insert('user',["first_name"=>$fname, "last_name"=>$lname, "user_name"=>$user, "user_pass"=>$password, "user_roll"=>$role]);
        $result1 =$obj->getResult();
        if(!empty($result1))
        {
            header("Location:{$hostname}/admin/users.php");
        }
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="post" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>