<?php

//general
$LNG['index']				= 'Index';
$LNG['register']			= 'Register';
$LNG['forum']				= 'Forum';
$LNG['send']				= 'Send';
$LNG['menu_index']			= 'Index';
$LNG['menu_news']			= 'News';
$LNG['menu_rules']			= 'Rules';
$LNG['menu_pranger']		= 'Banned';
$LNG['menu_top100']			= 'Hall of Fame';
$LNG['menu_disclamer']		= 'Contact';
$LNG['uni_closed']			= ' (closed)';

//index.php
//case lostpassword

$LNG['lost_empty']			= 'You must fill in all of the fields';
$LNG['lost_not_exists']		= 'No user with this email addres could be found';
$LNG['lost_mail_title']		= 'New Password';
$LNG['mail_sended']			= 'Your password has been successfully sent to %s';

//case default

$LNG['server_infos']			= array(
	"A space strategy game in real time.",
	"Play along with hundreds of users.",
	"No downloading, only a standard web browser is needed..",
	"Free registration",
);

$LNG['login_error_1']		= 'Wrong Username/Password!';
$LNG['login_error_2']		= 'Someone has logged in from another PC into your account';
$LNG['login_error_3']		= 'Your session has expired';
$LNG['login_error_4']		= 'There was an error in the external authorization. Please try again later.';
$LNG['screenshots']			= 'Screenshots';
$LNG['universe']			= 'Universe';
$LNG['chose_a_uni']			= 'Choose a Universe';

/* ------------------------------------------------------------------------------------------ */

//lostpassword.tpl
$LNG['lost_pass_title']			= 'Password Recovery';

//index_body.tpl
$LNG['user']					= 'User';
$LNG['pass']					= 'Password';
$LNG['remember_pass']			= 'Auto-Login';
$LNG['lostpassword']			= 'Forgot Password?';
$LNG['welcome_to']				= 'Welcome to';
$LNG['server_description']		= '<strong>%s</strong> is a <strong>space strategy game with hundreds of players</strong> around the world <strong>simultaneously</strong> trying to be the best. All you need to play is a standard web browser.';
$LNG['server_register']			= 'Sign up now!';
$LNG['server_message']			= 'Sign up now  and experience a new and exciting world';
$LNG['login']					= 'Login';
$LNG['disclamer']				= 'Contact';
$LNG['login_info']				= 'By logging in I accept the <a href="index.php?page=rules">Rules</a>';

/* ------------------------------------------------------------------------------------------ */

//reg.php - Registrierung
$LNG['register_closed']				= 'Registration closed';
$LNG['register_at']					= 'Registered at ';
$LNG['reg_mail_message_pass']		= 'One more step to activate your account';
$LNG['reg_mail_reg_done']			= 'Welcome to %s!';
$LNG['invalid_mail_adress']			= 'Invalid email address';
$LNG['empty_user_field']			= 'You must enter a username';
$LNG['password_lenght_error']		= 'The password must be at least 6 characters long.';
$LNG['user_field_specialchar']		= 'In the username only numbers, letters, spaces, _, -, and . are allowed.';
$LNG['planet_field_no']				= 'You must enter a name for your planet';
$LNG['planet_field_specialchar']	= 'In the planet name only numbers, letters, spaces, _, -, and . are allowed. ';
$LNG['terms_and_conditions']		= 'You must accept the rules in order to play.';
$LNG['user_already_exists']			= 'The username is already in use';
$LNG['mail_already_exists']			= 'The email address is already in use.';
$LNG['wrong_captcha']				= 'Incorrect CAPTCHA answer. Please try again.';
$LNG['different_passwords']			= 'Passwords do not match';
$LNG['different_mails']				= 'Email addresses do not match';
$LNG['welcome_message_from']		= 'Administrator';
$LNG['welcome_message_sender']		= 'Administrator';
$LNG['welcome_message_subject']		= 'Welcome to %s';
$LNG['welcome_message_content']		= 'Welcome to %s! First build a solar power plant, because energy is required for the subsequent production of raw materials. To build it, go to the menu and click on "building". Then build the 4th Building from above. Since you have power now, you can begin to build mines. Jump to the menu again on building and construct a metal mine, then again a crystal mine. To build ships you need to have first built a space ship yard. To find what you need, go to the Technology menu.. The team wishes you much fun exploring the universe!';
$LNG['reg_completed']				= 'Thank you for registering! You will soon receive an email with an activation link.';
$LNG['planet_already_exists']		= 'The planet is already taken.';

//registry_form.tpl
$LNG['server_message_reg']			= 'Register now and become part of';
$LNG['register_at_reg']				= 'Register at';
$LNG['uni_reg']						= 'Universe';
$LNG['user_reg']					= 'Username';
$LNG['pass_reg']					= 'Password';
$LNG['pass2_reg']					= 'Password Confirmation';
$LNG['email_reg']					= 'Email address';
$LNG['email2_reg']					= 'Email address confirmation';
$LNG['planet_reg']					= 'Name of main planet';
$LNG['ref_reg']						= 'Referred by';
$LNG['lang_reg']					= 'Language';
$LNG['register_now']				= 'Register!';
$LNG['captcha_reg']					= 'CAPTCHA (enter the two words separated by a space)';
$LNG['accept_terms_and_conditions']	= 'I accept the <a href="index.php?page=rules">Rules</a>.';
$LNG['captcha_help']				= 'Help';
$LNG['captcha_get_image']			= 'Get image';
$LNG['captcha_reload']				= 'Reload CAPTCHA';
$LNG['captcha_get_audio']			= 'Audio CAPTCHA';
$LNG['user_active']					= 'User %s has been activated!';

//Rules
$LNG['rules_overview']				= "Rules";
$LNG['rules_info1']					= "You are informed about this at the <a href=\"%s\" target=\"_blank\">Forum</a> and on the homepage of the game...";


//NEWS

$LNG['news_overview']				= "News";
$LNG['news_from']					= "On %s by %s";
$LNG['news_does_not_exist']			= "No news available!";

//Impressum

$LNG['disclamer']					= "Disclaimer";
$LNG['disclamer_name']				= "Name:";
$LNG['disclamer_adress']			= "Address:";
$LNG['disclamer_tel']				= "Phone:";
$LNG['disclamer_email']				= "Email Address:";
?>