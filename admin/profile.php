<?php
session_start();
include "includes/dao.php";
include 'includes/header1.php';
include 'includes/database.php';
include 'includes/adminModel.php';

$admin = new adminModel();
$id = $_SESSION['user_id'];
$profile = $admin->getUser($id);
$row = $profile->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{
    $id = $_SESSION['user_id'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $update = $admin->updateUser($id, $username, $email, $password);
    
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
                                                <h5 class="m-b-10">Administrators Profile</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
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
                                            <h5>Profile Details</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="InputName">Username</label>
                                                            <input type="text" class="mb-3 form-control" value="<?=$row['username']?>" id='name' name='name' required>
                                                            <small id="emailHelp" class="form-text text-muted">this data is primary Administrators data</small>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input type="email" class="form-control"  value="<?=$row['user_email']?>" name="email" id="email" placeholder="example@email.com" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                           <label for="desc">Password</label>
                                                           <input type="password" class="form-control" name="password" id="file">
                                                    </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="desc">Confirm Password</label>
                                                        <input type="text" class="form-control" name="confirm" id="desc"  >
                                                    </div>
                                                        <input type="submit" name="submit" class="btn btn-primary" value="Update">
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