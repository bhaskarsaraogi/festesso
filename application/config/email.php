<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'ssl://smtp.googlemail.com';
	$config['smtp_port'] = 465;
	$config['newline'] = "\r\n";
	$config['smtp_user'] = 'Enter email here';
	$config['smtp_pass'] = 'Enter password for email';
	$config['mailtype'] = 'html';
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = TRUE;