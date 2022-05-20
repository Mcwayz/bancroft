<?php
include "includes/nav.php";
include 'admin/includes/database.php';
include "admin/includes/adminModel.php";
$admin = new adminModel();

if(isset($_POST['submit']))
{
  $name = $_POST['message-name'];
  $email = $_POST['message-email'];
  $msg = $_POST['message'];
  $message = "Hi....
  My Name is ".$name. " 
  ". $msg ." ". "Email Sent From ". $email." "; 
  $admin->sendMail($message);
}


?>
  <!-- ***** Breadcrumb Area Start ***** -->
  <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/2.jpg);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title mt-70">Contact</h2>
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
              <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Breadcrumb Area End ***** -->
 
  <!-- ***** Contact Area Start ***** -->
  <section class="poca-contact-area mt-50 mb-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="google-maps mb-100">
            <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Chililabombwe+(Bancroft%20Music)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Contact Information -->
        <div class="col-12 col-md-6">
          <div class="contact-information">
            <div class="contact-heading mb-50">
              <h2>Contact Info</h2>
              <h6>We will be happy to assist you with any question</h6>
              <p><b>Bancroft Music is a Zambian Based Entertainment Website that Helps Both Local and Internation Talented Artists Showcase Their Art To The Rest Of the World. We Brand and Market Artists In Different Genres... <br><i>"We Are A Media Entertainment Publishing Company"</i></b></p>
            </div>


            <h5>Address: C304, Mine Township Chililabombwe, Zambia</h5>
            <h5>Phone: +260 97 000 2440</h5>
            <h5>Email: bancroftmusic01@gmail.com </h5>
            <h5>Open Hours: All Day, Every Day</h5>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="col-12 col-md-6">
          <div class="contact-form">
            <div class="contact-heading">
              <h2>Get In Touch</h2>
              <h5>Don't hesitate to contact us</h5>
            </div>
            <!-- Form -->
            <form  method="post">
              <div class="row">
                <div class="col-12">
                  <input type="text" name="message-name" class="form-control mb-30" placeholder="Your Name">
                </div>
                <div class="col-12">
                  <input type="email" name="message-email" class="form-control mb-30" placeholder="Your Email">
                </div>
                <div class="col-12">
                  <textarea name="message" class="form-control mb-30" placeholder="Your Message"></textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn poca-btn">Send Message</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Contact Area End ***** -->

  <!-- ***** Newsletter Area Start ***** -->
  <section class="poca-newsletter-area bg-img bg-overlay pt-50 jarallax" style="background-image: url(img/bg-img/15.jpg);">
    <div class="container">
      <div class="row align-items-center">
        <!-- Newsletter Content -->
        <div class="col-12 col-lg-6">
          <div class="newsletter-content mb-50">
            <h2>Sign Up To Newsletter</h2>
            <h6>Subscribe to receive info on our latest news and episodes</h6>
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
<?php
include "includes/footer.php";
?>
  