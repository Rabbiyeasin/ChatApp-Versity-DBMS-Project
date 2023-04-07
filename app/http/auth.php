<?php
session_start();
#check if username & password are submitted
if(isset($_POST['username'])&&
    isset($_POST['password'])){

    #database connection file
    include'../db.conn.php';


    #get data form POST request and store them in variable    
   $username=$_POST['username'];
   $password=$_POST['password'];

   #simple form validation 
   if(empty($username)){
        #error message
        $em="Username is required";
        /* redirected to 'index.php' and passing error message and data */
        header("location:../../index.php?error=$em");

   }elseif(empty($password)){
        #error message
        $em="password is required";
        
        /* redirected to 'index.php' and passing error message and data */
        header("location:../../index.php?error=$em");
   }else{
        $sql="SELECT* FROM users WHERE username=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$username]);

        #if the username is exist
        if($stmt->rowCount()===1){
            #fetching user data 
            $user =$stmt->fetch();

            #if both username's are strictly equal
            if($user['username']===$username){
                
                #verifying the encrypted password
                if(password_verify($password,$user['password'])){
                    #successfully logged in 
               
                    #creating the SESSION
                    $_SESSION['username']=$user['username'];
                    $_SESSION['name']=$user['name'];
                    $_SESSION['user_id']=$user['user_id'];

                    #redirect to home.php
                    header("location:../../home.php");


                }else{
                    #error message
                 $em="Incorrect Username or Password ";
                /* redirected to 'index.php' and passing error message and data */
                header("location:../../index.php?error=$em");
                }

            }else{
            #error message
            $em="Incorrect Username or Password ";
                
                /* redirected to 'index.php' and passing error message and data */
                header("location:../../index.php?error=$em");
            }

        }


   }

}else{
    header("location:../../index.php");
    exit;
}

?>