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
						<li><a href="/">Home</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php">Login</a></li>
						<li><a href="register.php">Register</a></li>
					</ul>
				</div>
			</div>
		</nav>
	
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<?php
					// login errors and notifications
					if (isset($login)) {
						if ($login->errors) {
							echo '<div class="alert alert-danger" role="alert"><ul class="list-group li-msgs-item">';
							foreach ($login->errors as $error) {
								echo '<li><a href="#" class="alert-link">'.$error.'</a></li>';
							}
							echo '</div>';
						}
						if ($login->messages) {
							echo '<div class="alert alert-success" role="alert"><ul class="list-group li-msgs-item">';
							foreach ($login->messages as $message) {
								echo '<li><a href="index.php" class="alert-link">'.$message.'</a></li>';
							}
							echo '</div>';
						}
					}
					?>
				  <div class="panel panel-default">
					<div class="panel-heading">Login</div>
						<div class="panel-body">
						  
							<form id="login-form" name="loginform" class="form-horizontal" role="form" method="POST" action="index.php">
								<input type="hidden" name="_token" value="PGMgFQXm93f9PkKE6cREZ7RYWSMUBxd6yGAVOsmO">

								<div class="form-group">
									<label class="col-md-4 control-label">Username</label>
									<div class="col-md-6">
										<input id="login_input_username" type="text" class="form-control login_input" name="user_name" required />
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Password</label>
									<div class="col-md-6">
										<input id="login_input_password" type="password" class="form-control login_input" name="user_password" autocomplete="off" required>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" name="login" class="btn btn-primary" style="margin-right: 15px;">
										  Login
										</button>

										<a href="register.php">Register</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php include_once('includes/footer.php');?>
	</body>
</html>