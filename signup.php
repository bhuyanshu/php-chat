<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="signup-form">
        <form action="" method="post">
            <div class="form-header">
                <h2>Sign Up</h2>
                <p>Fill out this form and start chatting with your friends</p>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input  class="form-control" type="text" name="user_name" placeholder="Username" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input  class="form-control" type="password" name="user_pass" id="" placeholder="*********" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input  class="form-control" type="email" name="user_email" id="" placeholder="Enter your Email.." autocomplete="off" required>
            </div> 
            <div class="form-group">
                <label>Country</label>
                <select class="form-control" name="user_country" required>
                    <option disabled="">Select your Country</option>
                    <option>India</option>
                    <option>US</option>
                    <option>Singapore</option>
                    <option>China</option>
                    <option>Sri Lanka</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" name="user_gender" required>
                    <option disabled="">Select your Gender</option>
                    <option>MALE</option>
                    <option>FEMALE</option>
                    <option>OTHERS</option>
                </select>
            </div>
            <div class="form-group">
                <label class="checkbox-inline"><input type="checkbox" required>I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_up">Sign up</button>
            </div>
             <?php
               include("signup_user.php")
            ?> 
        </form>
        <div class="text-center small" style="color:#67428B;">Already Have an Account? <a href="signin.php">Sign in</a></div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>