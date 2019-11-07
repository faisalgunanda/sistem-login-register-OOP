<?php 
require_once 'core/init.php';

if ( !$user->is_loggedIn()) {
	Session::flash('login', 'Anda Harus Login Terlebih Dahulu.');
	Redirect::to('login');
}

if (Session::exists('profile')) {
	echo Session::flash('profile');
}
$user_data = $user->get_data( Session::get('username'));
require_once 'templates/header.php';
?>

<h2>Profile</h2>
<h3>Hai <?php echo $user_data['username'] ?> </h3>

<?php if($user->is_admin(Session::get('username'))){ ?>
	Fungsi Khusus admin
<?php } ?>
<?php require_once 'templates/footer.php' ?>