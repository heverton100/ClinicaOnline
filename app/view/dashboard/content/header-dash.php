<?php 

include __DIR__.'/header/h-main.php'; 

if (isset($_SESSION['email_user']) && isset($_SESSION['IDPROFISSIONAL'])) {

	include __DIR__.'/header/h-profissional.php'; 

}elseif(isset($_SESSION['email_user']) && isset($_SESSION['IDPACIENTE'])) {

	include __DIR__.'/header/h-paciente.php'; 

}

?>

<style>
.main-menu-wrapper {
    display: none;
}

li.nav-item.contact-item {
    display: none;
}

nav.navbar.navbar-expand-lg.header-nav {
    height: 60px;
    background-color: #203a74;
}

li.nav-item.dropdown.has-arrow.logged-item {
    height: 60px;
}

a.navbar-brand.logo {
    width: 110px;
}

.header .has-arrow .dropdown-toggle:after {
	border-bottom: 2px solid #ffffff;
    border-right: 2px solid #ffffff;
}
</style>
<script src="../../public/js/jquery.min.js"></script>
<script type="text/javascript">
	$(".custom-logotipo").attr("src", "../../public/img/logobranco.png");
</script>