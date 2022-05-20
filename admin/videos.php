<?php
session_start();
include 'includes/header1.php';
include 'includes/database.php';
include 'includes/adminModel.php';

$admin = new adminModel();
$getSongs = $admin->getVideos();

if(isset($_GET['del']))
{
    $id = $_GET['del'];
    $deleteFile = $admin->deleteSong($id);
}

?>
    <!-- [ Main Content ] start -->
    <section class="pcoded-main-container">
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
                                                <h5 class="m-b-10">Showing All Video Uploads</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="#!">Media Uploads</a></li>
                                                <li class="breadcrumb-item"><a href="#!">View Uploads</a></li>
                                                <li class="breadcrumb-item"><a href="videos.php">View Video Uploads</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ breadcrumb ] end -->
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                
                                <!-- [ stiped-table ] start -->
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Music Files</h5>
                                            <span class="d-block m-t-5">Use Actions To <code> View or Delete </code> Files In The Table Below</span>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Artist Name</th>
                                                            <th>Song Title</th>
                                                            <th>Type</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <?php while ($row = $getSongs->fetch(PDO::FETCH_ASSOC)) {?>
                                                    <tbody>
                                                        <tr>
                                                        <td><?=$row['song_id']?></td>
                                                        <td><?=$row['artist_name']?></td>
                                                        <td><?=$row['song_title']?></td>
                                                        <td><?=$row['song_type']?></td>
                                                        <td>
                                                            <a title="View Song" href="playvideo.php?id=<?=$row['song_id']?>" class=" btn-sm btn-success" >View</a>
                                                            -- 
                                                            <a title="Delete Song" href="videos.php?del=<?=$row['song_id']?>" onclick="return confirm("Do you want to delete");" class="btn-sm delete btn-danger">Delete</a>
                                                        </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ stiped-table ] end -->
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Main Content ] end -->
<?php
    include 'includes/footer.php';
?>