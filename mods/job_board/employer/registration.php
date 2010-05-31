<?php
/***********************************************************************/
/* ATutor															   */
/***********************************************************************/
/* Copyright (c) 2002-2009											   */
/* Adaptive Technology Resource Centre / Inclusive Design Institute	   */
/* http://atutor.ca													   */
/*																	   */
/* This program is free software. You can redistribute it and/or	   */
/* modify it under the terms of the GNU General Public License		   */
/* as published by the Free Software Foundation.					   */
/***********************************************************************/
// $Id: home.php 9947 2010-05-27 21:05:03Z hwong $

define(AT_INCLUDE_PATH, '../../../include/');
include(AT_INCLUDE_PATH.'vitals.inc.php');
include(AT_JB_INCLUDE.'classes/Job.class.php');
$_custom_css = $_base_path . AT_JB_BASENAME . 'module.css'; // use a custom stylesheet

$job = new Job();

//handle registration
//todo: handle spam.
if(isset($_POST['submit'])){
	$email = $_POST['jb_registration_email'];
	$name = $_POST['jb_registration_name'];
	$company = $_POST['jb_registration_company'];
	$website = $_POST['jb_registration_website'];
	$description = $_POST['jb_registration_description'];
	$password = $_POST['jb_registration_password_hidden'];

	if ($_POST['jb_registration_password_error'] != ''){
		$errors = explode(',', $_POST['jb_registration_password_error']);
		if(sizeof($errors) > 0){
			foreach($errors as $err){
				$msg->addError($err);
			}
		}
		$noerror = false;
	}
	
	// these fields cannot be empty
	if($email=='' || $name=='' || $company==''){
		$msg->addError('JB_MISSING_FIELDS');
		$noerror = false;
	} 

	// email taken

		
	if ($noerror){
		//no error
		$job->addEmployerRequest($name, $email, $password, $company, $description, $website);
	}


}

include(AT_INCLUDE_PATH.'header.inc.php');
$savant->display('employer/jb_registration.tmpl.php');
include(AT_INCLUDE_PATH.'footer.inc.php'); 
?>