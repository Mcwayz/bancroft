<?php
session_start();
include "includes/dao.php";
include 'includes/header1.php';
include 'includes/database.php';
include 'includes/adminModel.php';

$admin = new adminModel();
$artist = $admin->getArtists();


if(isset($_POST['submit']))
{
    $maxsize = 134217728;
    $Artist = $_POST['Artist_id'];
    $SongTitle = $_POST['InputTitle'];
    $SongType = 'Video';
    $SongDetails = $_POST['desc'];
    $TargetDir = "../video/";
    $TargetFile = $TargetDir . $_FILES["file"]["name"];
    $User = 1;//$_SESSION['user_id'];

    // Select file type
    $videoFileType = strtolower(pathinfo($TargetFile,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

    // Check extension
    if( in_array($videoFileType,$extensions_arr) ){
                
      // Check file size
        if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) 
        {
            echo"<script>alert('File too large, File Must Be Less Than 128MB!');</script>";
        }
        else
        {
            // Upload
          if(move_uploaded_file($_FILES['file']['tmp_name'],$TargetFile))
            {
                $addsong = $admin->uploadSong($Artist, $SongTitle, $TargetFile, $SongDetails, $SongType, $User);
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
                                                <h5 class="m-b-10">Add Video Files</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="#">Media Uploads</a></li>
                                                <li class="breadcrumb-item"><a href="addsong.php">Video File Uploads</a></li>
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
                                            <h5>Enter Song Details</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="InputName">Artist Name</label>
                                                            <select class="mb-3 form-control" id='Artist_id' name='Artist_id' required>
                                                                <option>-- Select Artist --</option>
                                                                <?php while ($row = $artist->fetch(PDO::FETCH_ASSOC)){ ?>
                                                                <option value="<?=$row['artist_id'] ?>"><?=$row['artist_name']?></option>
                                                                <?php }?>
                                                            </select>
                                                            <small id="emailHelp" class="form-text text-muted">if artist name is not available in the list then register the artist.</small>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Song Title</label>
                                                            <input type="Text" class="form-control" name="InputTitle" id="InputTitle" placeholder=" E.g Never Go Back..." required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                           <label for="desc">Select Video File</label>
                                                           <input type="file" class="form-control" name="file" id="file">
                                                    </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="desc">Song Details</label>
                                                        <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="E.g Time of Release, Writer and Producer ...." required></textarea>
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