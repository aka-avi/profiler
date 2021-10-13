<?php 

	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$db = 'profiles';

	$conn = mysqli_connect($host, $user, $pass, $db);

	if(!$conn){
		die('Failed to connect to Database : ' . mysqli_connect_error());
	}

	$nameerr = '';
	$emailerr = '';
	$doberr = '';
	$abouterr = '';
	$vererr = '';

	if (isset($_POST['submit']) && $_POST['g-recaptcha-response'] != "") {
		$secret = '6LePzskcAAAAACXnWsklqsX9qnFc-HgpERvFKgYm';
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$verify = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'response='.$_POST['g-recaptcha-response'];
		$responseData = json_decode($verifyResponse);

		if($responseData->success){
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			if($name === ''){
				$nameerr = 'Enter Your name';
				$error = 1;
			}

			$email = mysqli_real_escape_string($conn, $_POST['email']);
			if($name === ''){
				$emailerr = 'Enter Your email';
				$error = 1;
			}

			$dob = mysqli_real_escape_string($conn, $_POST['dob']);
			if($name === ''){
				$doberr = 'Choose Your DOB';
				$error = 1;
			}

			$about = mysqli_real_escape_string($conn, $_POST['about']);
			if($name === ''){
				$abouterr = 'Add about your Bio';
				$error = 1;
			}

			if($error === 0){
				$sql ="INSERT INTO `profiles` (`name`, `email`, `dob`, `about`) VALUES ('$name', '$email', '$dob', '$about')";

				if(mysqli_query($conn, $sql)){
				}else{
					echo mysqli_error($conn);
				}
			}
		}else{
			$varerr = 'Captcha failed';
		}
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<title>Profiler</title>
</head>
<body>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container-md">
			<div class="navbar-brand"><span class="h1">Profiler</span></div>
		</div>
	</nav>
	<div class="container-md">
		<div class="row justify-content-center">
			<form class="col-sm-8" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="my-3">
		  			<label for="name" class="form-label">Please Enter Your Name</label>
		  			<input type="text" class="form-control" id="name" placeholder="Jhon Doe" name="name" required>
		  			<p class="my-2 text-danger"><?php echo $nameerr; ?></p>
		  		</div>
				<div class="my-3">
		  			<label for="email" class="form-label">Email address</label>
		  			<input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
		  			<p class="my-2 text-danger"><?php echo $emailerr; ?></p>
		  		</div>
				<div class="my-3">
		  			<label for="dob" class="form-label">Choose your DOB</label>
		  			<input type="date" class="form-control" id="dob" name="dob" required>
		  			<p class="my-2 text-danger"><?php echo $doberr; ?></p>
		  		</div>
				<div class="my-3">
					<label for="about" class="form-label">Tell Us More About Yourself</label>
					<textarea class="form-control" id="about" name="about" rows="3" required></textarea>
		  			<p class="my-2 text-danger"><?php echo $abouterr; ?></p>
				</div>
				<div class="g-recaptcha" data-sitekey='6LePzskcAAAAAFUCqU9yWbMj-L-Fh6i4S5xvzV0d'></div>
		  			<p class="my-2 text-danger"><?php echo $vererr; ?></p>
				<div class="my-3">
					<input type="submit" name="submit" value="submit" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</body>
</html>