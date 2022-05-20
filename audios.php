<?php
session_start();
include "includes/nav.php";
include 'admin/includes/database.php';
include "admin/includes/adminModel.php";
$admin = new adminModel();
$getSong = $admin->getMusic();

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);
    if(empty($_SESSION['current']))
    {
      $id = $_GET['id'];
      $like = $admin->likeSong($id);
      $_SESSION['current'] = $id;
    }
    elseif($_SESSION['current'] == $id)
    {
      echo"<script>alert('You have Already Liked This Track');</script>";
    }
    else
    {
      $id = $_GET['id'];
      $like = $admin->likeSong($id);
      $_SESSION['current'] = $id;
    }
   
}


if(isset($_GET['dow']))
{
  $key = $_GET['dow'];
  if(empty($_SESSION['download']))
  {
    $download = $admin->download($key);
    $_SESSION['download'] = $key;
    echo"<script>alert('Thanks For Choosing Bancroft Music');</script>";
  }
  elseif($_SESSION['download'] == $key)
  {
    echo"<script>alert('Thanks For Choosing Bancroft Music');</script>";
  }
  else
  {
    $download = $admin->download($key);
    $_SESSION['download'] = $key;
  }
   
}
 

?>
  <!-- ***** Breadcrumb Area Start ***** -->
  <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/2.jpg);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title mt-70">Music</h2>
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
              <li class="breadcrumb-item active" aria-current="page">Music</li>
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
          <button class="btn" data-filter=".media">Latest</button>
          <button class="btn" data-filter=".tech">Refresh</button>
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
            <?php 
                  $raw_pic = $row['pic_location'];
                  $pic = substr($raw_pic, 3); 
                  echo" <img src='".$pic."' width='200px' height='160px'>";
                ?>
            </div>
            <div class="poca-music-content">
            <?php 
                $raw_file = $row['song_location'];
                $song = substr($raw_file, 3); 
                $downloads = $row['downloads'];
                $key = $row['song_id'];
              ?>
              <span class="music-published-date"><?php echo $row['upload_date']; ?></span>
              <h2><?php echo $row['artist_name']." - " .$row['song_title']; ?></h2>
              <div class="music-meta-data">
              </div>
              <!-- Music Player -->
              <div class="poca-music-player">
                <audio preload="auto" controls>
                  <?php 
                    echo " <source src='$song' >";
                  ?>
                </audio>
              </div>
              <!-- Likes, Share & Download -->
              <div class="likes-share-download d-flex align-items-center justify-content-between">
                <?php echo"<a href='$song' class='mr-4'><i class='fa fa-share' aria-hidden='true'></i> Share</a>";?>
                <a href="audios.php?id=<?=$key?>"><i class="fa fa-heart" aria-hidden="true"></i> Like (<?=$row['likes']?>)</a>
                <div>
                 <?php echo"<a href='$song'?dow=$key class='mr-4'><i class='fa fa-download' aria-hidden='true'></i> Downloads ($downloads)</a>";?>
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
  