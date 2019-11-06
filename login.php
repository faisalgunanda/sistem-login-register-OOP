<?php 

require_once 'core/init.php';

if ( Session::exists('username')) {
	Redirect::to('profile');
}

if ( Session::exists('login')) {
	echo Session::flash('login');
}

$errors = array();

if ( Input::get('submit') ) {

	// 1. Memanggil Objek Validasi
	$validation = new Validation();

	//2. Metode Check
	$validation = $validation->check(array(
		'username' => array(
			'required' => true,
		),
		'password' => array(
			'required' => true,
		)
	));

	//3. Lolos Ujian
	if ($validation->passed()) {
	
		if ($user->cek_nama(Input::get('username'))) {
			# 
			if($user->login_user(Input::get('username'), Input::get('password'))){
				Session::set('username', Input::get('username'));
				header('Location: profile.php');
			}else{
				$errors[] = 'Login Gagal';
			}
		}else{
			$errors[] = 'Username Belum Terdaftar!';
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