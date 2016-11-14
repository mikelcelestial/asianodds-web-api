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
						<li><a href="/">Home</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php">Login</a></li>
						<li><a href="register.php">Register</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<!--START-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<?php
						// show potential errors / feedback (from registration object)
						if (isset($registration)) {
							if ($registration->errors) {
								echo '<div class="alert alert-danger" role="alert"><ul class="list-group li-msgs-item">';
								foreach ($registration->errors as $error) {
									echo '<li><a href="#" class="alert-link">'.$error.'</a></li>';
								}
								echo '</div>';
							}
							if ($registration->messages) {
								echo '<div class="alert alert-success" role="alert"><ul class="list-group li-msgs-item">';
								foreach ($registration->messages as $message) {
									echo '<li><a href="index.php" class="alert-link">'.$message.'</a></li>';
								}
								echo '</div>';
							}
						}
					?>
					<div class="panel panel-default">
						<div class="panel-heading">Register</div>
						<div class="panel-body">
							<form class="form-horizontal" name="registerform" role="form" method="POST" action="register.php">

								<div class="form-group">
									<label class="col-md-4 control-label">Username (only letters and numbers, 2 to 64 characters):</label>
									<div class="col-md-6">
										<input id="login_input_username" class="form-control login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">User's email:</label>
									<div class="col-md-6">
										<input id="login_input_email" class="form-control login_input" type="email" name="user_email" required />
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Password</label>
									<div class="col-md-6">
										<input type="password" id="login_input_password_new" class="form-control login_input" name="user_password_new" pattern=".{6,}" required autocomplete="off">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Confirm Password</label>
									<div class="col-md-6">
										<input type="password" id="login_input_password_repeat" class="form-control login_input" name="user_password_repeat" pattern=".{6,}" required autocomplete="off">
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" name="register" value="Register" class="btn btn-primary">
											Register
										</button>
										<a href="index.php">Back to Login Page</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--STOP-->
		<?php include_once('includes/footer.php');?>
	</body>
</html>