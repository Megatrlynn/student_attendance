<?php
include 'dashboard/phpback/dbconn.php';
include 'dashboard/phpback/loginreglogic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/stylelogin.css">
</head>
<body style="background: url(assets/images/choosing-bg.jpg)">

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form id="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1>Create Account</h1>
            <input type="text" name="username" placeholder="Username" required />
            <input type="text" name="name" placeholder="Full Name" required />
            <input type="password" name="password" placeholder="Password" required />
            <div class="institution" style="margin-top:5px; width: 100%; text-align: left;">
                <select name="institution_id" id="institution" required style="border: none; color: #707070; width: 100%; height: 40px; background-color: #ebebeb;">
                    <option value="">Select An Institution</option>
                    <?php
                    include 'dashboard/phpback/dbconn.php';
                    $stmt_institutions = $pdo->query("SELECT id, name FROM institution");
                    while ($institution = $stmt_institutions->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$institution['id']}'>{$institution['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="roles" style="margin-top:13px; margin-bottom: 5px; width: 100%; height: auto; text-align: left;">
                <select name="role" id="role" required style="border: none; color: #707070; width: 100%; height: 40px; background-color: #ebebeb;">
                    <option value="">Select A Role</option>
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>
            </div>
            <input type="text" name="verification_code" placeholder="Verification Code" required />
            <button type="submit" name="register" id="register-btn">Create</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1>Login</h1>
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <!-- <a href="#">Forgot your password?</a> -->
            <button type="submit" name="login" id="login-btn">Login</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Have an account?</h1>
                <p>Tap the button below to login</p>
                <button class="ghost" id="signIn">Login</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>No Account?</h1>
                <p>Tap the button below and start the journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/javas.js"></script>
</body>
</html>
