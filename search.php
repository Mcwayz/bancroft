<?php
include 'admin/includes/database.php';
include "admin/includes/adminModel.php";
$admin = new adminModel();

if(isset($_POST['submit']))
{

$str = $_POST['top-search-bar'];
$getSong = $admin->getResults($str);

}
else
{
    $getSong = $admin->getMusic();
}


if(isset($_GET['id']))
{
  $id = intval($_GET['id']);
  $admin->likeSong($song_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Poca - Podcast &amp; Audio Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Bancroft - Music</title>

  <!-- Favicon -->
  <link rel="icon" href="./img/core-img/favicon.ico">

  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="preloader-thumbnail">
      <img src="./img/core-img/preloader.png" alt="">
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area">
    <!-- Main Header Start -->
    <div class="main-header-area">
      <div class="classy-nav-container breakpoint-off">
        <!-- Classy Menu -->
        <nav class="classy-navbar justify-content-between" id="pocaNav">

          <!-- Logo -->
          <a class="nav-brand" href="index.php"><img src="./img/core-img/favicon.ico" alt=""></a>

          <!-- Navbar Toggler -->
          <div class="classy-navbar-toggler">
            <span class="navbarToggler"><span></span><span></span><span></span></span>
          </div>

          <!-- Menu -->
          <div class="classy-menu">

            <!-- Menu Close Button -->
            <div class="classycloseIcon">
              <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
            </div>

            <!-- Nav Start -->
            <div class="classynav">
              <ul id="nav">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./audios.php">Music</a></li>
                <li><a href="./videos.php">Videos</a></li>
                <li class="active"><a href="./search.php">Search</a></li>
                <li><a href="./contact.php">Contact</a></li>
              </ul>

              <!-- Top Search Area -->
              <div class="top-search-area">
                <form  method="post">
                  <input type="search" name="top-search-bar" class="form-control" placeholder="Search and hit enter...">
                  <button type="submit" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
              </div>

              <!-- Top Social Area -->
              <div class="top-social-area">
                <a href="https://touch.facebook.com/Bancroft-music-110013887292672/?ref=bookmarks" class="fa fa-facebook" aria-hidden="true"></a>
                <a href="https://www.instagram.com/bancroft_music?r=nametag" class="fa fa-instagram" aria-hidden="true"></a>
                <a href="https://www.youtube.com/channel/UCcKPx-bzdS7vD8dsxTTIedQ?app=desktop" class="fa fa-youtube-play" aria-hidden="true"></a>
              </div>

            </div>
            <!-- Nav End -->
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <!-- ***** Breadcrumb Area Start ***** -->
  <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/2.jpg);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title mt-70">Music Search</h2>
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
              <li class="breadcrumb-item active" aria-current="page">Search</li>
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
          <button class="btn active" data-filter="*">Results</button>
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
              ?>
              <span class="music-published-date"><?php echo $row['upload_date']; ?></span>
              <h2><?php echo $row['artist_name']." - " .$row['song_title']; ?></h2>
              <div class="music-meta-data">
              </div>
              <!-- Music Player -->
              <div class="poca-music-player">
                 <!-- Likes & Download -->
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