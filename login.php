<?php 

require_once 'core/init.php';

$errors = array();

if ( Input::get('submit') ) {

	$validation = new Validation();
	$validation = $validation->check(array(
		'username' => array(
			'required' => true,
		),
		'password' => array(
			'required' => true,
		)
	));
	die(Input::get('password'));
	if ($validation->passed()) {
		if($user->login_user(Input::get('username'), Input::get('password'))){
			Session::set('username', Input::get('username'));
			header('Location: profile.php');
		}else{
			echo 'Login Gagal';
		}

	}else{
		$errors = $validation->errors();
	}
}

require_once 'templates/header.php';

?>

<h2>Login SekolahCoding</h2>
<form action="login.php" method="post" accept-charset="utf-8">
	<label>Username</label>
	<input type="text" name="username"><br>

	<label>Password</label>
	<input type="password" name="password"><br>

	<input type="submit" name="submit" value="Login Sekarang">


	<?php if(!empty($errors)) { ?>
		<div id="errors">
			<?php foreach ($errors as $error) {?>
				<li><?php echo $error; ?></li>
			<?php } ?>
		</div>
	<?php  } ?>
	
</form>

<?php require_once 'templates/footer.php'; ?>