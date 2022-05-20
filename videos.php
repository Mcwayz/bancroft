<?php
include "includes/nav.php";
include 'admin/includes/database.php';
include "admin/includes/adminModel.php";
$admin = new adminModel();
$getSong = $admin->getVideos();

if(isset($_GET['id']))
{
  $id = intval($_GET['id']);
  $admin->likeSong($song_id);
  $admin->download($id);
}

?>
  <!-- ***** Breadcrumb Area Start ***** -->
  <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/2.jpg);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title mt-70">Music Videos</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="breadcumb--con">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Videos</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Breadcrumb Area End ***** -->

      <!-- Projects Menu -->
      <div class="container">
      <div class="poca-projects-menu mb-30 wow fadeInUp" data-wow-delay="0.3s">
        <div class="text-center portfolio-menu">
          <button class="btn active" data-filter="*">All</button>
        </div>
      </div>
    </div>

  <!-- ***** Featured Music Area Start ***** -->
  <?php while ($row = $getSong->fetch(PDO::FETCH_ASSOC)){ ?>
  <div class="poca-featured-music-area mt-50">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="poca-music-area box-shadow d-flex align-items-center flex-wrap border" data-animation="fadeInUp" data-delay="900ms">
            <div class="poca-music-thumbnail">
              <img src="./img/bg-img/3.jpg" alt="">
            </div>
            <div class="poca-music-content">
              <?php 
                $raw_file = $row['song_location'];
                $song = substr($raw_file, 3); 
              ?>
              <span class="music-published-date"><?php echo $row['upload_date']; ?></span>
              <h2><?php echo $row['artist_name']." - " .$row['song_title']; ?></h2>
              <div class="music-meta-data">
              </div>
              <!-- Music Player -->
              <div class="poca-music-player">
                 <!-- Likes, Share & Download -->
                <div class="likes-share-download d-flex align-items-center justify-content-between">
                <?php echo"<a href='$song' class='mr-4'><i class='fa fa-video' aria-hidden='true'></i>Play Video</a>";?>
                <a href="index.php?id=<?=$row['song_id']?>"><i class="fa fa-heart" aria-hidden="true"></i> Like (<?=$row['likes']?>)</a>
                <div>
                 <?php echo"<a href='$song' class='mr-4'><i class='fa fa-download' aria-hidden='true'></i> Download</a>";?>
              </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }?>
  <!-- ***** Featured Music Area End ***** -->


<?php
include "includes/footer.php";
?>
  