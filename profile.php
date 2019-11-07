<?php 
require_once 'core/init.php';

if ( !Session::exists('username')) {
	Session::flash('login', 'Anda Harus Login Terlebih Dahulu.');
	Redirect::to('login');
}

if (Session::exists('profile')) {
	echo Session::flash('profile');
}

require_once 'templates/header.php';
?>

<h2>Hai <?php echo Session::get('username') ?> </h2>

<?php if($user->is_admin(Session::get('username'))){ ?>
	Fungsi Khusus admin
<?php } ?>
<?php require_once 'templates/footer.php' ?>