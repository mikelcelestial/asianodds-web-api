<?php
/* ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1); */
?>
<!doctype html>
<html>
	<?php include_once('includes/header.php');?>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Asianodds | The complete betting tool</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Hello, <strong style="color:red"><?php echo $_SESSION['user_name']; ?></strong>.</a></li>
						<li><a href="index.php?logout">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container-fluid">
			<div class="row">
				<div>
					<?php
					// show potential errors / feedback (from registration object)
					if (isset($registration)) {
						if ($registration->errors) {
							echo '<div class="alert alert-danger" role="alert"><ul class="list-group li-msgs-item">';
							foreach ($registration->errors as $error_r) {
								echo '<li><a href="#" class="alert-link">'.$error_r.'</a></li>';
							}
							echo '</div>';
						}
						if ($registration->messages) {
							echo '<div class="alert alert-success" role="alert"><ul class="list-group li-msgs-item">';
							foreach ($registration->messages as $message_r) {
								echo '<li><a href="#" class="alert-link">'.$message_r.'</a></li>';
							}
							echo '</div>';
						}
					}
					?>
					<!-- LOGGED IN BODY START-->
					<div style="margin: 50px 40px;">
						<table id="feed_table" class="table table-striped table-bordered dataTable no-footer" cellspacing="0" style="width: 100%;">
							<thead>
								<tr>
									<th>Sports</th>
									<th>Match ID</th>
									<th>Match</th>
									<th>Score</th>
									<th>Schedule</th>
									<th>Odds</th>
									<th>League</th>
									<th>Game Status</th>
									<th>Place Bet?</th>
									<th>Share</th>
									<th> </th>
								</tr>
							</thead>
						</table>
					</div>
					<!-- LOGGED IN BODY END-->
					
				</div>
			</div>
		</div>
		
		<?php include_once('includes/footer.php');?>
	</body>
</html>