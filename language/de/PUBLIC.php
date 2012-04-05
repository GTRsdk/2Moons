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
$LNG['server_message_reg']			= 'Registriere dich jetzt und werde ein Teil von';
$LNG['register_at_reg']				= 'Registriert bei';
$LNG['uni_reg']						= 'Universum';
$LNG['user_reg']					= 'User';
$LNG['pass_reg']					= 'Passwort';
$LNG['pass2_reg']					= 'Passwort wiederhohlen';
$LNG['email_reg']					= 'E-Mail Adresse';
$LNG['email2_reg']					= 'E-Mail Adresse wiederhohlen';
$LNG['planet_reg']					= 'Name des Hauptplaneten';
$LNG['ref_reg']						= 'Geworben von';
$LNG['lang_reg']					= 'Sprache';
$LNG['register_now']				= 'Registrieren!';
$LNG['captcha_reg']					= 'Sicherheitsfrage';
$LNG['accept_terms_and_conditions']	= 'Ich bin mit den <a href="index.php?page=rules">Regeln</a> einverstanden.';
$LNG['captcha_help']				= 'Hilfe';
$LNG['captcha_get_image']			= 'Lade Bild-CAPTCHA';
$LNG['captcha_reload']				= 'Neues CAPTCHA';
$LNG['captcha_get_audio']			= 'Lade Sound-CAPTCHA';
$LNG['user_active']					= 'User %s wurde aktiviert!';

//Rules
$LNG['rules_overview']				= "Regelwerk";
$LNG['rules_info1']					= "Es wird aber im <a href=\"%s\" target=\"_blank\">Forum</a> und über die Startseite im Game darüber Informiert ...";


//NEWS

$LNG['news_overview']				= "News";
$LNG['news_from']					= "Am %s von %s";
$LNG['news_does_not_exist']			= "Keine News vorhanden!";

//Impressum

$LNG['disclamer']					= "Haftungsausschluss";
$LNG['disclamer_name']				= "Name:";
$LNG['disclamer_adress']			= "Adresse:";
$LNG['disclamer_tel']				= "Telefon Nr.:";
$LNG['disclamer_email']				= "E-Mail Adresse:";
?>