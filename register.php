<?php 

require_once 'core/init.php';

if ( Session::exists('username')) {
	Redirect::to('profile');
}

$errors = array();

if ( Input::get('submit') ) {

	$validation = new Validation();
	$validation = $validation->check(array(
		'username' => array(
			'required' => true,
			'min' 	   => 3,
			'max'      => 50,
		),
		'password' => array(
			'required' => true,
			'min'      => 3,
		),
		'password_verify' => array(
			'required' => true,
			'match' => 'password'
		)
	));

	if ($user->cek_nama(Input::get('username'))) {
		$errors[] = 'Nama Sudah Terdaftar';
	}else{
		if ($validation->passed()) {
			$user->register_user(array(
				'username' => Input::get('username'),
				'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
			));

			Session::flash('profile', 'Selamat! Anda Berhasil Mendaftar');
			Session::set('username', Input::get('username'));
			header('Location: profile.php');
		}else{
			$errors = $validation->errors();
		}
	}
}

require_once 'templates/header.php';

?>

<h2>Daftar SekolahCoding</h2>
<form action="register.php" method="post" accept-charset="utf-8">
	<label>Username</label>
	<input type="text" name="username"><br>

	<label>Password</label>
	<input type="password" name="password"><br>

	<label>Ulangi Password</label>
	<input type="password" name="password_verify"><br>

	<input type="submit" name="submit" value="Daftar Sekarang">


	<?php if(!empty($errors)) { ?>
		<div id="errors">
			<?php foreach ($errors as $error) {?>
				<li><?php echo $error; ?></li>
			<?php } ?>
		</div>
	<?php  } ?>
	
</form>

<?php require_once 'templates/footer.php'; ?>