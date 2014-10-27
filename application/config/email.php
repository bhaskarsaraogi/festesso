<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'ssl://smtp.googlemail.com';
	$config['smtp_port'] = 465;
	$config['newline'] = "\r\n";
	$config['smtp_user'] = ''; //Add email here
	$config['smtp_pass'] = ''; //Add password here
	$config['mailtype'] = 'html';
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = TRUE;