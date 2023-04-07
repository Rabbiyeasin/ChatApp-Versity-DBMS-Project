<?php

#check if username,password, name submitted

if(isset($_POST['username'])&&
    isset($_POST['password'])&&
    isset($_POST['name'])){

    #database connection file
    include'../db.conn.php';


    #get data form POST request and store them in variable    
   $name=$_POST['name'];
   $username=$_POST['username'];
   $password=$_POST['password'];

    #making URL data format 
    $data='name='.$name.'&username='.$username;

    #simple form validation 
    if(empty($name)){
        #error message
        $em="Name is required";
        
        /*
        redirected to 'signup.php' and
        passing error message and data
        */
        header("location:../../signup.php?error=$em && $data");
        exit;
    }elseif(empty($username)){
         #error message
         $em="username is required";
        /*
        redirected to 'signup.php' and
        passing error message and data
        */
         header("location:../../signup.php?error=$em && $data");
         exit;
    } elseif(empty($password)){
         #error message
         $em="password is required";
        
         /*
        redirected to 'signup.php' and
        passing error message and data
        */
        header("location:../../signup.php?error=$em && $data");
         exit;
    }else {        
        #checking the database if the username is taken 
        $sql= "SELECT username FROM users where username=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$username]);

        if($stmt->rowCount()>0){
            $em="The username($username)is taken";
            header("location:../../signup.php?error=$em&$data");
            exit;
        }else{
            #profile picture uploading 
            if(isset($_FILES['pp'])){
                #get data and store then in var 
                $img_name=$_FILES['pp']['name'];
                $tmp_name=$_FILES['pp']['tmp_name'];
                $error=$_FILES['pp']['error'];

            #if there is not error occured while uploading 
            if($error==0){
                #get image extension store it in var 
                $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
               
                /**convert the image extension into lowwer caseand store it in var  */
            $img_ex_lc=strtolower($img_ex);
            /**creating array that stores allowred to upload image extension */
                $allowed_exs=array("jpg","jpeg","png");
            /**checking if the image extension is present  in$allowed_exs array */
            if(in_array($img_ex_lc,$allowed_exs)){
                /**renaming the image with users username */
                $new_img_name=$username.'.'.$img_ex_lc;

                /** cating ul;oad path to root directory */
                $img_upload_path='../../uploads/'.$new_img_name;

                #move uploaded image to ./upload folder
                move_uploaded_file($tmp_name,$img_upload_path);

            }else{
                $em="cannot upload this type of file";
                header("location:../../signup.php?error=$em&$data");
                exit;
            }
            }else{
                $em="unknown error occured!";
                header("location:../../signup.php?error=$em&$data");
                exit;
            }
            }
            //password hashing
            $password=password_hash($password,PASSWORD_DEFAULT);
            #if the user upload profile picture 
            if(isset($new_img_name)){
                #inserting data into database
                $sql="INSERT INTO users (name,username,password,p_p) VALUES(?,?,?,?)";
                $stmt =$conn->prepare($sql);
                $stmt->execute([$name,$username,$password,$new_img_name]);
            }else{
                 #inserting data into database
                 $sql="INSERT INTO users (name,username,password) VALUES(?,?,?)";
                 $stmt =$conn->prepare($sql);
                 $stmt->execute([$name,$username,$password]);
            }
            #success message 
            $sm="Account created successfully";
            #redirected to index.php and passing success message 
            header("location:../../index.php?success=$sm");
        }

    }  
}else{
        header("location:../../signup.php");
        exit;
    }



?>