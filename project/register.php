<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php
            include("php/config.php");

            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Verify email
                $verify_query = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                if(mysqli_num_rows($verify_query) != 0){
                    echo "<div class='message'>
                            <p>This Email is already in use. Please try another one.</p>
                        </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn1'>Go Back</button></a>";
                } else {
                    mysqli_query($con, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')") or die("Error Occurred");
                    echo "<div class='message'>
                            <p>Registration Successful!</p>
                        </div> <br>";
                    echo "<a href='index.html'><button class='btn1'>Login Now</button></a>";
                }
            } else {
        ?>
            <header>SignUp</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="SignUp" required>
                </div>
                <div class="link">
                    Already a member? <a href="login.php">Login Now</a>
                </div>
            </form>
        <?php } ?>
        </div>
    </div>
</body>
</html>
