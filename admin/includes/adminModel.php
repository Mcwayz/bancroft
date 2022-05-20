<?php
//Include required PHPMailer files

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

//Define name spaces

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class adminModel
{
    //------------------------- User Related Functions Start Here--------------------------------------


     //function that adds user information into the database

     
    public function createUser($username, $email, $role, $User_password)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO User_tbl VALUES(:Username, :Email, :Usr_Role, :Usr_Pass)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':Username',$username);
        $query->bindparam(':Email',$email);
        $query->bindparam(':Usr_Role',$role);
        $query->bindparam(':Usr_Pass',$User_password);
        if ($query->execute())
        {
            echo"<script>alert('User Creation Successful');</script>";
            echo"<script>window.location.href = 'users.php'</script>";
        }
            else
        { 
            $func = "User Creation Function";
            $this->displayError($func);
        }
         
    }



    // Function that logs the admin into the account


    public function login($email, $pass)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `User_tbl` WHERE `user_email` = '$email' AND `user_password` = '$pass' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
           $result = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['user_id'] = $result['user_id'];
           $_SESSION['email'] = $result['user_email'];
           $_SESSION['name'] = $result['username'];
           $_SESSION['role'] = $result['user_role'];
           $_SESSION['user_pass'] = $result['user_password'];
           $role =  $_SESSION['role'];
            if($role == 'admin')
            {
                echo "<script>alert('Login Successful');</script>";
                echo"<script>window.location.href='home.php'</script>";
            }
        } 
        else 
        {
            echo "<script>alert('Invalid Username / Password Error');</script>";
        }
    }


    //Function that Sends An Email Message 
    

    public function sendMail($message)
    {
            
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
    
            //Set smtp encryption type (ssl/tls)
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
    
            //Set gmail username
            $mail->Username = "bancroftmusic01@gmail.com";
            $mail->Password = "Bancroftmusic2021";
    
            //Email subject
            $mail->Subject = "Bancroft Music Questions - Via Website";
            $mail->setFrom("bancroftmusic01@gmail.com");
            $mail->isHTML(true);
            $mail->Body = $message;
            $mail->addAddress("bancroftmusic01@gmail.com");
    
            //Send email
            if ( $mail->send()) 
            {
                echo "Email Sent..!";
            }
            //Closing smtp connection
            $mail->smtpClose();
    }


    // Function that gets all system users present in the database


    public function getUsers()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM User_tbl ASC";
        return $dbConn->query($sql);
    }


    // Function that gets single user details


    public function getUser($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql ="SELECT * FROM User_tbl WHERE user_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that Updates User Details in the Database


    public function updateUser($id, $username, $email, $User_password)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE User_tbl SET username=:Username, user_email=:Email, user_password=:Usr_Pass 
        WHERE `user_id`=:User_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':User_id',$id);
        $query->bindparam(':Username',$username);
        $query->bindparam(':Email',$email);
        $query->bindparam(':Usr_Pass',$User_password);
        if ($query->execute())
        {
            echo"<script>alert('User Details Successfully Updated');</script>";
            echo"<script>window.location.href = 'users.php'</script>";
        }
            else
        { 
            $func = "Update User Details Function";
            $this->displayError($func);
        }
         
    }



    //Function that Deletes User from System Database


    public function deleteUser($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM user_tbl WHERE user_id=:user_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':user_id',$id);
        $query->execute();
        echo"<script>alert('User Successfully Deleted');</script>";
    }


    //-----------------User Related Functions End Here-----------------------------


    //-----------------Artist Related Functions Start Here-------------------------


    //Function that adds an Artist to The System


    public function addArtist($artist_name, $contact_no, $artist_desc)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `Artist_tbl` VALUES(NULL,:A_Name, :C_No, :A_Desc) ";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':A_Name',$artist_name);
        $query->bindparam(':C_No',$contact_no);
        $query->bindparam(':A_Desc',$artist_desc);
        if ($query->execute())
        {
            echo"<script>alert('Artist Successfully Added');</script>";
            echo"<script>window.location.href = 'artists.php'</script>";
        }
            else
        { 
            $func = "Add Artist Details Function";
            $this->displayError($func);
        }
        
    }


    //Function that Updates Artist Details

    public function updateArtist($id, $artist_name, $contact_no, $artist_desc)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `Artist_tbl` SET `artist_name`=:A_Name, `contact_no`=:C_No, `artist_desc`=:A_Desc WHERE Artist_id=:A_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':A_id',$id);
        $query->bindparam(':A_Name',$artist_name);
        $query->bindparam(':C_No',$contact_no);
        $query->bindparam(':A_Desc',$artist_desc);
        if ($query->execute())
        {
            echo"<script>alert('Artist Details Successfully Updated');</script>";
            echo"<script>window.location.href = 'artists.php'</script>";
        }
            else
        { 
            $func = "Artist Details Update Function";
            $this->displayError($func);
        }
       
    }

     //Function that Returns All Artist in the System

     public function getArtists()
     {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `Artist_tbl`";
        return $dbConn->query($sql);
     }


    //Function that Returns An Artist (Single)

    public function getArtist($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `Artist_tbl` WHERE artist_id ='$id'";
        return $dbConn->query($sql);
    }


     //Function that Deletes Artist Details from the System

     public function deleteArtist($id)
     {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM `Artist_tbl` WHERE Artist_id='$id'";
        return $dbConn->query($sql);
        echo"<script>alert('Artist Details Successfully Deleted');</script>";
     }

    //-----------------Artist Related Functions End Here--------------------------

   
    //-----------------Song Related Functions Start Here--------------------------


    // Function that gets all available songs in the Database
    public function getMusic()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT  Music_tbl.song_id, Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location, 
        Music_tbl.song_details, Music_tbl.upload_date, Music_tbl.song_type, Pic_tbl.pic_location, 
        Music_tbl.likes, Music_tbl.downloads
        FROM `Music_tbl` 
        INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id 
        INNER JOIN Pic_tbl ON Pic_tbl.song_id = Music_tbl.song_id
        WHERE Music_tbl.song_type = 'audio'
        ORDER BY Artist_tbl.artist_id DESC";
        return $dbConn->query($sql);
    }


        // Function that gets all available songs in the Database
    public function getSongs()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT  Music_tbl.song_id, Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location, 
        Music_tbl.song_details, Music_tbl.upload_date, Music_tbl.song_type, Music_tbl.views, Music_tbl.likes, Music_tbl.downloads
        FROM `Music_tbl` 
        INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id 
        WHERE Music_tbl.song_type = 'audio'
        ORDER BY Artist_tbl.artist_id DESC";
        return $dbConn->query($sql);
    }

    public function getMusic4()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT  Music_tbl.song_id, Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location, 
        Music_tbl.song_details, Music_tbl.upload_date, Music_tbl.song_type, Pic_tbl.pic_location, 
        Music_tbl.likes, Music_tbl.downloads
        FROM `Music_tbl` INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id 
        INNER JOIN Pic_tbl ON Pic_tbl.song_id = Music_tbl.song_id
        WHERE Music_tbl.song_type = 'audio'
        ORDER BY Artist_tbl.artist_id DESC LIMIT 4";
        return $dbConn->query($sql);
    }


    public function getLatest()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Music_tbl.song_id, Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location, 
        Music_tbl.song_details, Music_tbl.upload_date, Music_tbl.song_type, Pic_tbl.pic_location,
        Music_tbl.likes, Music_tbl.views, Music_tbl.downloads
        FROM `Music_tbl` INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id 
        INNER JOIN Pic_tbl ON Pic_tbl.song_id = Music_tbl.song_id
        WHERE Music_tbl.song_type = 'audio' 
        ORDER BY Music_tbl.song_id DESC LIMIT 1";
        return $dbConn->query($sql);
    }


    // Function that gets all available Videos in the Database

    public function getVideos()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT  Music_tbl.song_id, Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location, 
        Music_tbl.song_details, Music_tbl.upload_date, Music_tbl.song_type, Music_tbl.likes, 
        Music_tbl.views, Music_tbl.downloads
        FROM `Music_tbl` INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id 
        WHERE Music_tbl.song_type = 'video'
        ORDER BY Artist_tbl.artist_id DESC";
        return $dbConn->query($sql);
    }

    // Function that gets a single song from the database 

    public function getSong($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location, 
        Music_tbl.song_details, Music_tbl.song_type, Music_tbl.upload_date, Pic_tbl.pic_location,
        Music_tbl.likes, Music_tbl.views, Music_tbl.downloads
        FROM `Music_tbl` INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id
        INNER JOIN Pic_tbl ON Pic_tbl.song_id = Music_tbl.song_id WHERE Music_tbl.song_id = '$id'";
        return $dbConn->query($sql);
    }


   // Function that gets a single Video from the database 

   public function getVideo($id)
   {
       $db = new DBconnection();
       $dbConn = $db->getConnection();
       $sql = "SELECT Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location, 
       Music_tbl.song_details, Music_tbl.song_type, Music_tbl.upload_date, Music_tbl.likes, Music_tbl.views, Music_tbl.downloads
       FROM `Music_tbl` 
       INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id
       WHERE Music_tbl.song_id = '$id'";
       return $dbConn->query($sql);
   }



    // Function that Adds Songs to the Database


    public function uploadSong($artist_id, $song_title, $song_location, $song_details, $song_type, $user_id)
    {
        $date = date("F j, Y, g:i a");
        $likes = 0;
        $views = 0;
        $downloads = 0;
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `Music_tbl`(`artist_id`, `song_title`, `song_location`, 
        `song_details`, `song_type`, `user_id`, `upload_date`, `views`, `likes`, `downloads`) 
        VALUES (:artist_id, :song_title, :song_location, :song_details,
        :song_type, :user_i, :up_date, :views, :likes, :downloads)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':artist_id',$artist_id);
        $query->bindparam(':song_title',$song_title);
        $query->bindparam(':song_location',$song_location);
        $query->bindparam(':song_details',$song_details);
        $query->bindparam(':song_type',$song_type);
        $query->bindparam(':user_i',$user_id);
        $query->bindparam(':up_date',$date);
        $query->bindparam(':views',$views);
        $query->bindparam(':likes',$likes);
        $query->bindparam(':downloads',$downloads);
            if ($query->execute())
            {
                echo"<script>alert('Song Successfully Uploaded');</script>";
                echo"<script>window.location.href = 'addpic.php'</script>";
            }
            else
            { 
                $func = "Song Upload Function";
                $this->displayError($func);
            }
    }


     // Function that Adds Videos to the Database


     public function uploadvid($artist_id, $song_title, $song_location, $song_details, $song_type, $user_id)
     {
         $date = date("F j, Y, g:i a");
         $likes = 0;
         $views = 0;
         $downloads = 0;
         $db = new DBconnection();
         $dbConn = $db->getConnection();
         $sql = "INSERT INTO `Music_tbl`(`artist_id`, `song_title`, `song_location`, 
         `song_details`, `song_type`, `user_id`, `upload_date`, `views`, `likes`, `downloads`) 
         VALUES(:artist_id, :song_title, :song_location, :song_details,
        :song_type, :user_i, :up_date, :views, :likes, :downloads)";
         $query = $dbConn->prepare($sql);
         $query->bindparam(':artist_id',$artist_id);
         $query->bindparam(':song_title',$song_title);
         $query->bindparam(':song_location',$song_location);
         $query->bindparam(':song_details',$song_details);
         $query->bindparam(':song_type',$song_type);
         $query->bindparam(':user_i',$user_id);
         $query->bindparam(':up_date',$date);
         $query->bindparam(':views',$views);
         $query->bindparam(':likes',$likes);
         $query->bindparam(':downloads',$downloads);
             if ($query->execute())
             {
                 echo"<script>alert('Song Successfully Uploaded');</script>";
                 echo"<script>window.location.href = 'index.php'</script>";
             }
                 else
             { 
                 $func = "Song Upload Function";
                 $this->displayError($func);
             }
     }


        // Function that Adds Songs to the Database


        public function updateSongDetails($song_id, $song_title,$song_details, $user_id)
        {                                 
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "UPDATE `Music_tbl` SET `song_title`=:song_title, `song_details`=:song_details,
            `user_id`=:user_id WHERE song_id=:song_id";
            $query = $dbConn->prepare($sql);
            $query->bindparam(':song_id',$song_id);
            $query->bindparam(':song_title',$song_title);
            $query->bindparam(':song_details',$song_details);
            $query->bindparam(':user_id',$user_id);
                if ($query->execute())
                {
                    echo"<script>alert('Song Details Successfully Updated');</script>";
                    echo"<script>window.location.href = 'addPic.php'</script>";
                }
                    else
                { 
                    $func = "Song Details Update Function";
                    $this->displayError($func);
                }
        }



    //Function that Returns Search Results


    public function getResults($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Music_tbl.song_id, Artist_tbl.artist_name, Music_tbl.song_title, Music_tbl.song_location,
        Music_tbl.song_details, Music_tbl.upload_date, Music_tbl.song_type, Pic_tbl.pic_location,
        Music_tbl.likes, Music_tbl.views, Music_tbl.downloads
        FROM `Music_tbl` INNER JOIN Artist_tbl ON Artist_tbl.artist_id = Music_tbl.artist_id
        INNER JOIN Pic_tbl ON Pic_tbl.song_id = Music_tbl.song_id
        WHERE Music_tbl.song_title LIKE '%$id%' OR Artist_tbl.artist_name LIKE '%$id%'";
        return $dbConn->query($sql);
    }


    // Function that Deletes a Song From The Database

    public function deleteSong($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM Music_tbl WHERE song_id='$id'";
        return $dbConn->query($sql);
        echo"<script>alert('Song Successfully Deleted');</script>";
    }

    //-----------------Song Related Functions End Here--------------------------

   
    //-----------------Pic Related Functions Start Here--------------------------


    // Function That Attaches An Image To The Uploaded Song

    public function attachImage($song_id, $pic_name, $pic_location)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `Pic_tbl` VALUES(NULL, :song_id, :pic_name, :pic_location)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':song_id',$song_id);
        $query->bindparam(':pic_name',$pic_name);
        $query->bindparam(':pic_location',$pic_location);
            if ($query->execute())
            {
                echo"<script>alert('Pic Successfully Attached');</script>";
                echo"<script>window.location.href = 'audios.php'</script>";
            }
                else
            { 
                $func = "Attach Image Function";
                $this->displayError($func);
            }
    }


     // Function That Attaches An Image To The Uploaded Song

    public function getImages()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `Pic_tbl` ORDER BY pic_id DESC";
        return $dbConn->query($sql);
    }


      // Function that Deletes a Song From The Database

    public function deleteImage($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM Pic_tbl WHERE pic_id='$id'";
        return $dbConn->query($sql);
        echo"<script>alert('Image Successfully Deleted');</script>";
    }


    // Function that Likes a Song 


        //Function that Adds A Like To A Song



    public function likeSong($song_id)
    {                                 
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `Music_tbl` SET `likes`= `likes` + 1 WHERE song_id=:song_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':song_id',$song_id);
        if ($query->execute())
        {
            echo"<script>alert('You have Like It');</script>";
        }
        else
        { 
            $func = "Like Song Function";
            $this->displayError($func);
        }
    }


 // Function that Counts The Number Of Views a Song Has

    public function View($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `Music_tbl` SET `views` = `views` + 1 WHERE song_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that Counts The Number Of Downloads a Song Has

     public function download($id)
     {
         $db = new DBconnection();
         $dbConn = $db->getConnection();
         $sql = "UPDATE `Music_tbl` SET `downloads` = `downloads` + 1 WHERE song_id='$id'";
         return $dbConn->query($sql);
     }
       
      

    public function displayError($func)
    {
        echo"<script>alert('An Error Occurred At Function'+$func);</script>";
    }



}