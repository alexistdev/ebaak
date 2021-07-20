<?php
defined('BASEPATH') or exit('No direct script access allowed');
function sanitasi($str)
{
	return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

/** Function untuk pengaturan captcha */
function config_captcha()
{
	$config = [
		'img_url' => base_url() . 'captcha/',
		'img_path' => './captcha/',
		'img_height' =>  50,
		'word_length' => 5,
		'img_width' => 150,
		'font_size' => 10,
		'expiration' => 300,
		'pool' => '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'
	];
	return $config;
}

/** Membatalkan session login */
function _unlogin(){
	$ci = get_instance();
	$ci->session->set_userdata('is_login_in', FALSE);
	redirect('Login');
}

function angkaUnik($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
