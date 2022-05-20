<?php
session_start();
include "includes/dao.php";
include 'includes/header1.php';
include 'includes/database.php';
include 'includes/adminModel.php';

$admin = new adminModel();
$artist = $admin->getSongs();


if(isset($_POST['submit']))
{
    $maxsize = 10485760;
    $Song_ID = $_POST['Song_id'];
    $TargetDir = "../pics/";
    $pic_name = $_POST['pic_name'];
    $TargetFile = $TargetDir . $_FILES["file"]["name"];
    $User = $_SESSION['user_id'];

    // Select file type
    $picFileType = strtolower(pathinfo($TargetFile,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("png","jpg", "jpeg", "gif");

    // Check extension
    if( in_array($picFileType,$extensions_arr) ){
                
      // Check file size
        if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) 
        {
            echo"<script>alert('File too large, File Must Be Less Than 10MB!');</script>";
        }
        else
        {
            // Upload
          if(move_uploaded_file($_FILES['file']['tmp_name'],$TargetFile))
            {
                $addsong = $admin->attachImage($Song_ID, $pic_name, $TargetFile);
                
            }
            else
            {
                echo"<script>alert('Upload Failed!');</script>";
            }
        }

    }
    else
    {
        echo"<script>alert('Invalid File Extension!');</script>";
    }
        
}

?>
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ breadcrumb ] start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10">Attach Image Files</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="#">Media Uploads</a></li>
                                                <li class="breadcrumb-item"><a href="addpic.php">Pic Attachments</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ breadcrumb ] end -->
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ form-element ] start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <h5>Select Song Details</h5>
                                            <hr>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="InputName">Song Title</label>
                                                            <select class="mb-3 form-control" id='song_id' name='Song_id' required>
                                                                <option>-- Select Song --</option>
                                                                <?php while ($row = $artist->fetch(PDO::FETCH_ASSOC)){?>
                                                                <option value="<?=$row['song_id'] ?>"><?=$row['artist_name']?> - <?=$row['song_title']?></option>
                                                                    <?php }?>
                                                            </select>
                                                           
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="desc">Picture Content</label>
                                                            <input type="text" class="form-control" name="pic_name" id="pic_name">
                                                        </div>
                                                        </div>


                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                           <label for="desc">Select Picture</label>
                                                           <input type="file" class="form-control" name="file" id="file">
                                                    </div>
                                                        <input type="submit" name="submit" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ form-element ] end -->
                                <!-- [ Main Content ] end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <?php
        include 'includes/footer.php';
    ?>