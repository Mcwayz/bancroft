<?php 
session_start();
include "includes/dao.php";
include "includes/header.php";
include 'includes/database.php';
include 'includes/adminModel.php';

$admin = new adminModel();
$id = $_GET['id'];
$getSong = $admin->getSong($id);
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
												<h5>Home</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#!">Media Player</a></li>
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
                                    
                                    <div align='center' class="card">
                                        <div class="card-header">
                                            <h5>Bancroft Media Player </h5>
                                        </div>
                                        <div align='center' class="card-body table-border-style">
										
													<?php
														while ($row = $getSong->fetch(PDO::FETCH_ASSOC))
														{
															$location = $row['song_location'];
															$name = $row['artist_name']; 
															$title = $row['song_title'];
															$details = $row['song_details'];
															$uploaded = $row['upload_date'];
															$likes = $row['likes'];
															$views = $row['views'];
															$down = $row['downloads'];
															$pic = $row['pic_location'];
															echo" <div class='poca-music-thumbnail'>";
															echo" <img src='".$pic."' alt=''width='200px' height='200px'>";
															echo"</div>";
															echo "<div >";
															echo " <audio preload='auto' controls>";
															echo "<source src='".$location."' type='audio/mpeg'>";
															echo "</audio>";
															echo "</div>";
															echo "<br>";
															echo "<h6 align='center'>$name - $title - $uploaded</h6>";
															echo "<p align='center'>$details</p>";
															echo "
															<div class='likes-share-download d-flex align-items-center justify-content-between'>
															  <a href='#'><i class='fa fa-heart' aria-hidden='true'></i> Likes ($likes)</a>
															  <a href='#' class='mr-4'><i class='fa fa-view-alt' aria-hidden='true'></i> Views($views)</a>
															  <a href='#'><i class='fa fa-download' aria-hidden='true'></i> Download ($down)</a>
															</div>";
														}
													?>
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
	</div>
	<!-- [ Main Content ] end -->

	<!-- Required Js -->
	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/pcoded.min.js"></script>

</body>

</html>
