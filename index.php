<?php
session_start();
include "includes/nav.php";
include 'admin/includes/database.php';
include "admin/includes/adminModel.php";
$admin = new adminModel();

if(isset($_GET['id']))
{
  $id = $_GET['id'];
  if(empty($_SESSION['current']))
  {
    $like = $admin->likeSong($id);
    $_SESSION['current'] = $id;
  }
  elseif($_SESSION['current'] == $id)
  {
    echo"<script>alert('You have Already Liked This Track');</script>";
  }
  else
  {
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
  <link rel="stylesheet" href="./css/cookie.css">
  <!-- ***** Welcome Area Start ***** -->
  <section class="welcome-area">
    <!-- Welcome Slides -->
    <div class="welcome-slides owl-carousel">

      <!-- Single Welcome Slide -->
      <div class="welcome-welcome-slide bg-img bg-overlay" style="background-image: url(img/bg-img/1.jpg);">
        <div class="container h-100">
          <div class="row h-100 align-items-center">
            <div class="col-12">
              <!-- Welcome Text -->
              <div class="welcome-text">
                <h2 data-animation="fadeInUp" data-delay="100ms">Bancroft Music</h2>
                <h5 data-animation="fadeInUp" data-delay="300ms">Music at your Fingertips.</h5>
                <div class="welcome-btn-group">
                  <a href="videos.php" class="btn poca-btn m-2 ml-0 active" data-animation="fadeInUp" data-delay="500ms">Latest Videos</a>
                  <a href="podcast.php" class="btn poca-btn btn-2 m-2" data-animation="fadeInUp" data-delay="700ms">Latest Mp3 Songs</a>
                </div>
              </div>
              <!-- Welcome Music Area -->
              <?php 
                  $getSong = $admin->getLatest();
                  while($row = $getSong->fetch(PDO::FETCH_ASSOC)){
              ?>
                <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms">
                  <?php 
                  $raw_pic = $row['pic_location'];
                  $pic = substr($raw_pic, 3); 
                  $song_id = $row['song_id'];
                   echo" <div class='poca-music-thumbnail'>";
                   echo" <img src='".$pic."' width='200px' height='160px'>";
                   echo"</div>";
                ?>
                <div class="poca-music-content">
                  <span class="music-published-date"><?php echo $row['upload_date']; ?></span>
                  <h2><?php echo $row['artist_name']." - " .$row['song_title']; ?></h2>
                  <div class="music-meta-data">
                    <p>By <a href="#" class="music-author">Admin</a> | <a href="#" class="music-catagory">Mp3 Music</a> </p>
                  </div>
                  <!-- Music Player -->
                  <?php 
                    $raw_file = $row['song_location'];
                    $song = substr($raw_file, 3);
                    $likes = $row['likes'];
                    $downloads = $row['downloads'];
                    echo "<div class='poca-music-player'>";
                    echo " <audio preload='auto' controls>";
                    echo "<source src='".$song."' type='audio/mpeg'>";
                    echo "</audio>";
                    echo "</div>";
                    echo "<div class='likes-share-download d-flex align-items-center justify-content-between'>";
                    echo"<a href='index.php?id=$song_id'><i class='fa fa-heart' aria-hidden='true'></i> Like ($likes)</a>";
                    echo"<a href='$song?dow=$song_id' class='mr-4'><i class='fa fa-download' aria-hidden='true'></i> Download ($downloads)</a>";
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php }?>


    </div>
  </section>
  <!-- ***** Welcome Area End ***** -->

  <!-- ***** Latest Episodes Area Start ***** -->
  <section class="poca-latest-epiosodes section-padding-80">
    <div class="container">
      <div class="row">
        <!-- Section Heading -->
        <div class="col-12">
          <div class="section-heading text-center">
            <h2>Latest</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Projects Menu -->
    <div class="container">
      <div class="poca-projects-menu mb-30 wow fadeInUp" data-wow-delay="0.3s">
        <div class="text-center portfolio-menu">
          <button class="btn active" data-filter="*">All</button>
          <button class="btn" data-filter="*">Videos</button>
          <button class="btn" data-filter="*">Audios</button>
        </div>
      </div>
    </div>


    <div class="container">
      <div class="row poca-portfolio">
      <?php 
        $getLatest4 = $admin->getMusic4();
        while ($file = $getLatest4->fetch(PDO::FETCH_ASSOC)){
      ?>
        <!-- Single gallery Item -->
        <div class="col-12 col-md-6 single_gallery_item entre wow fadeInUp" data-wow-delay="0.2s">
          <!-- Welcome Music Area -->
          <div class="poca-music-area style-2 d-flex align-items-center flex-wrap">
            <div class="poca-music-thumbnail">
                <?php
                  $raw_pic4 = $file['pic_location'];
                  $pic4 = substr($raw_pic4, 3); 
                  $s_id = $file['song_id'];
                  echo" <img src='".$pic4."' width='550px' height='80px'>";
              ?>
            </div>
            <div class="poca-music-content text-center">
              <span class="music-published-date mb-2"><?php echo $file['upload_date']; ?></span>
              <h2><?php echo $file['artist_name']." - " .$file['song_title']; ?></h2>
              <div class="music-meta-data">
              </div>
              <!-- Music Player -->
              <?php 
                    $raw_file1 = $file['song_location'];
                    $likes = $file['likes'];
                    $song1 = substr($raw_file1, 3);
                    echo "<div class='poca-music-player'>";
                    echo " <audio preload='auto' controls>";
                    echo "<source src='".$song1."' type='audio/mpeg'>";
                    echo "</audio>";
                    echo "</div>";
                    ?>
                <!-- Likes & Download -->
                    <div class='likes-share-download d-flex align-items-center justify-content-between'>
                    <a href='index.php?id=<?=$s_id?>'>  <i class='fa fa-heart' aria-hidden='true'></i> Like (<?=$likes?>)</a>
                    <a href='<?=$song1?>' class='mr-4'><i class='fa fa-download' aria-hidden='true'></i> Download</a>

                </div>
              </div>
            </div>
          </div>
        </div>
        <?php }?>


      <!-- Content Ends Here -->
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <a href="#" class="btn poca-btn mt-70">Load More</a>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Latest Episodes Area End ***** -->

  <!-- ***** Featured Guests Area Start ***** -->
  <section class="featured-guests-area">
    <div class="container">
      <div class="row">
        <!-- Section Heading -->
        <div class="col-12">
          <div class="section-heading text-center">
            <h2>Bancroft Team</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>

      <div class="row justify-content-around">
        <!-- Single Featured Guest -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="single-featured-guest mb-80">
            <img src="img/bg-img/ice.jpeg" alt="" style='width:683px; height:300px;'>
            <div class="guest-info">
              <h5>Musankabala Kelvin</h5>
              <span>C.E.O</span>
            </div>
          </div>
        </div>

        <!-- Single Featured Guest -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="single-featured-guest mb-80">
            <img src="img/bg-img/spaxy.jpeg" alt="" style='width:683px; height:300px;'>
            <div class="guest-info">
              <h5>Emmanuel Munthali</h5>
              <span>PRODUCER</span>
            </div>
          </div>
        </div>

        <!-- Single Featured Guest -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="single-featured-guest mb-80">
            <img src="img/bg-img/muka.jpeg" alt="" style='width:683px; height:300px;'>
            <div class="guest-info">
              <h5>Mukabanga Mujembe</h5>
              <span>SITE MANAGER</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Featured Guests Area End ***** -->

  <!-- ***** Newsletter Area Start ***** -->
  <section class="poca-newsletter-area bg-img bg-overlay pt-50 jarallax" style="background-image: url(img/bg-img/15.jpg);">
    <div class="container">
      <div class="row align-items-center">
        <!-- Newsletter Content -->
        <div class="col-12 col-lg-6">
          <div class="newsletter-content mb-50">
            <h2>Sign Up To Newsletter</h2>
            <h6>Subscribe to receive info on our latest news and music</h6>
          </div>
        </div>
        <!-- Newsletter Form -->
        <div class="col-12 col-lg-6">
          <div class="newsletter-form mb-50">
            <form action="#" method="post">
              <input type="email" name="nl-email" class="form-control" placeholder="Your Email">
              <button type="submit" class="btn">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ***** Newsletter Area End ***** -->
  <div class="cookie-container">
    <p>
      We use cookies in this website to give you the best experience
      and show you relevant ads. To find out more read our <a href="#">privacy policy</a> and <a href="#">cookie policy</a>
    </p>
    <button class="cookie-btn">
      Okay
    </button>
  </div>
  <!-- Cookie js -->
 
<?php
include "includes/footer.php";
?>
  