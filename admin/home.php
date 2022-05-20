<?php 
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/adminModel.php";
include "includes/database.php";

$admin = new adminModel();

$getData = $admin->getSongs();


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
												<li class="breadcrumb-item"><a href="home.php"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#!">Analytics Dashboard</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->
							<div class="row">

								<!-- Media Content -->
								<?php
									$sql = "Select Count(*)AS media FROM Music_tbl";
									$result = mysqli_query($mysqli,$sql);
									$row = $result->fetch_row();
                                                    {?>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-red">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Media Content</h6>
													<h3 class="m-b-0 text-white"><?php echo $row[0];?></h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-database text-c-red f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php }?>

								<!-- Audio Content -->
								<?php
								$sql = "Select Count(*)AS media FROM Music_tbl WHERE song_type='Audio'";
								$result = mysqli_query($mysqli,$sql);
								$row = $result->fetch_row();
                                 {?>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-blue">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Audio Files</h6>
													<h3 class="m-b-0 text-white"><?php echo $row[0];?></h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-database text-c-blue f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php }?>

								<!-- Video Content -->
								<?php
								$sql = "Select Count(*)AS media FROM Music_tbl WHERE song_type='Video'";
								$result = mysqli_query($mysqli,$sql);
								$row = $result->fetch_row();
                                 {?>

								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-green">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Video Files</h6>
													<h3 class="m-b-0 text-white"><?php echo $row[0];?></h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-database text-c-green f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php }?>

								<!-- Artists -->
								<?php
								$sql = "Select Count(*)AS artist FROM Artist_tbl";
								$result = mysqli_query($mysqli,$sql);
								$row = $result->fetch_row();
                                 {?>

								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-yellow">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Artists</h6>
													<h3 class="m-b-0 text-white"><?php echo $row[0];?></h35>
												</div>
												<div class="col-auto">
													<i class="fas fa-tags text-c-yellow f-18"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php }?>
								<!-- product profit end -->

								<!-- sessions-section start -->
								<div class="col-xl-8 col-md-6">
									<div class="card table-card">
										<div class="card-header">
											<h5>Available Media Content</h5>
										</div>
										<div class="card-body px-0 py-0">
										<div class="row">
                                
                                <!-- [ stiped-table ] start -->
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Artist Name</th>
                                                            <th>Song Title</th>
                                                            <th>Type</th>
                                                        </tr>
                                                    </thead>
													<?php while ($row = $getData->fetch(PDO::FETCH_ASSOC)) {?>
                                                    <tbody>
                                                        <tr>
														<td><?=$row['song_id']?></td>
                                                        <td><?=$row['artist_name']?></td>
                                                        <td><?=$row['song_title']?></td>
                                                        <td><?=$row['song_type']?></td>
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
										</div>
									</div>
								</div>
								<!-- sessions-section end -->
								<div class="col-md-6 col-xl-4">
									<div class="card user-card">
										<div class="card-header">
											<h5>Developer</h5>
										</div>
										<div class="card-body  text-center">
											<div class="usre-image">
												<img src="assets/images/widget/img-round1.jpg" class="img-radius wid-100 m-auto" alt="User-Profile-Image">
											</div>
											<h6 class="f-w-600 m-t-25 m-b-10">System Developer</h6>
											<p>0965-178740 | Niza Tembo</p>
										</div>
									</div>
								</div>
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
