<?php
    
    if($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['add-admin'])){
        require_once '../includes/connection_db.php';

        $firstname= $_POST['firstname'];
        $lastname= $_POST['lastname'];
        $username= $_POST['username'];
        $email= $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        

        if($password != $repassword){
            $_SESSION['adminmsg'] = "password dont match";
            echo "<script>window.reload();";
            exit();
        }
        $password = password_hash($password,PASSWORD_DEFAULT);

        $stmt = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");

        if(mysqli_num_rows($stmt) > 0){
             $_SESSION['errormsg'] = "account already exist";
             echo "<script>window.history.back();</script>";
            exit();
        }else{
            $stmt = mysqli_query($conn, "INSERT INTO users (firstname, lastname, username, email, password, user_type) VALUES ('$firstname', '$lastname', '$username', '$email', '$password', 'admin')");
            if($stmt){
                $_SESSION['successmsg'] = "Successfully created an admin";
                echo "<script>window.history.back();</script>";
                exit();
             }

        }
        
    }

?>
<!-- add admin Modal -->
<form class="form-group" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" >
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" >Add admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" class="form-control" required>
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" class="form-control" required>
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required>
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"required >
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
                <label for="repassword">Confirm Password</label>
                <input type="password" name="repassword" class="form-control" required>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" value="ADD" name="add-admin" class="btn btn-primary" style="background-color: #186864; border-color: #186864;">
        </div>
    </div>
    </div>
</div>
</form>
           

