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
    <title>Chat App -Signup</title>
</head>

<body class="justify-content-center align-items-center vh-100">
    <div class="container">
        <h2>signUp Form</h2>
    <?php if (isset($_GET['error'])){?>

        <div class="alert alert-warning" role="alert">
        <?php echo htmlspecialchars($_GET['error']);?>
        </div>

        <?php }
        
        if (isset($_GET['name'])){
            $name = $_GET['name'];
        }else $name='';
        
        if (isset($_GET['username'])){
            $username = $_GET['username'];
        }else $username='';

        ?>

        <div class="w-400 p-1 rounded">
            <form method="post" action="app/http/signup.php" enctype="multipart/form-data">

            <div class="input-name">
            <input type="text" name="name" placeholder="Enter Your Name"class="name" value="<?=$name?>"> 
            </div>

            <div class="input-name">
            <input type="text" name="username" placeholder="Enter Your username"class="name"value="<?=$username?>"> 
            </div>

            <div class="input-name">
            <input type="password" name="password" placeholder="Enter Your Password"class="text-name"> 
            </div>

            <div class="input-name">
            <label class="form-label"> Profile Picture</label>
            <input type="file" name="pp" class="form-control"> 
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Sign Up</button>

                <a href="index.php">Login</a>
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