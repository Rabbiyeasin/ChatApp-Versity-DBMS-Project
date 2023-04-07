<?php
session_start();
    if (!isset($_SESSION['username'])){


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!--custom css link-->
    <link rel="stylesheet" href="style.css">
    <title>Chat App -login</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <h2>Login Form</h2>
        <?php if (isset($_GET['error'])){?>
        <div class="alert alert-warning" role="alert">
        <?php echo htmlspecialchars($_GET['error']);?>
        </div>
        <?php }?>

        <?php if (isset($_GET['success'])){?>
        <div class="alert alert-success" role="alert">
        <?php echo htmlspecialchars($_GET['success']);?>
        </div>

        <?php }?>

        <div class="w-400 p-1  rounded">
            <form method="post" action="app/http/auth.php">
            
            <div class="input-name">
            <input type="text" name="username" placeholder="Enter Your Username"class="name"> 
            </div>

            <div class="input-name">
            <input type="password" name="password" placeholder="Enter Your Password"class="text-name"> 
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">LOGIN</button>

                <a href="signup.php">Sign Up</a>
            </div>

            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</body>

</html>
<?php
}else{
    header("location:home.php");
    exit;
}
?>