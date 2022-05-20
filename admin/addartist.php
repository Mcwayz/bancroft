<?php
session_start();
include "includes/dao.php";
include 'includes/header1.php';
include 'includes/database.php';
include 'includes/adminModel.php';
$admin = new adminModel();
if(isset($_POST['submit']))
{
    $A_Name = $_POST['InputName'];
    $A_Contact = $_POST['InputNumber'];
    $A_Desc = $_POST['desc'];
    $admin->addArtist($A_Name, $A_Contact, $A_Desc);
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
                                                <h5 class="m-b-10">Add & Edit Artists</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="#">Artists</a></li>
                                                <li class="breadcrumb-item"><a href="addartist.php">Add Artist</a></li>
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
                                            <h5>Enter Artist Details</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="InputName">Artist Name</label>
                                                            <input type="Text" class="form-control" name="InputName" id="InputName" aria-describedby="emailHelp" placeholder="Enter Name" required>
                                                            <small id="emailHelp" class="form-text text-muted">We'll never share artist contact details with anyone else.</small>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input type="Text" class="form-control" name="InputNumber" id="InputNumber" placeholder="+260 --- --- ---" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                            <label for="desc">Artist Intro</label>
                                                            <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="E.g John Doe is a Zambia Artist Based in ...." required></textarea>
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