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
$LNG['register_closed']				= 'Registration geschlossen!';
$LNG['register_at']					= 'Registriert bei ';
$LNG['reg_mail_message_pass']		= 'Noch ein Schritt zur Aktivierung Ihres Usernamen';
$LNG['reg_mail_reg_done']			= 'Willkommen bei %s!';
$LNG['invalid_mail_adress']			= 'Ungültige E-mail Adresse!';
$LNG['empty_user_field']			= 'Sie müssen einen Usernamen eingeben!';
$LNG['password_lenght_error']		= 'Das Passwort muss mindestens 6 Zeichen lang sein!';
$LNG['user_field_specialchar']		= 'Im Username sind nur Zahlen, Buchstaben, Leerzeichen, _, -, . erlaubt!';
$LNG['planet_field_no']				= 'Sie müssen einen Planetennamen eingeben!';
$LNG['planet_field_specialchar']	= 'Im Planetennamen sind nur Zahlen, Buchstaben, Leerzeichen, _, -, . erlaubt!';
$LNG['terms_and_conditions']		= 'Sie müssen die Regeln akzeptieren!';
$LNG['user_already_exists']			= 'Der Username ist bereits vergeben!';
$LNG['mail_already_exists']			= 'Die E-mail Adresse ist bereits in Benutzung!';
$LNG['wrong_captcha']				= 'Sicherheitscode falsch!';
$LNG['different_passwords']			= 'Sie haben 2 unterschiedliche Passwörter eingegeben!';
$LNG['different_mails']				= 'Sie haben 2 unterschiedliche E-Mail Adressen angegeben!';
$LNG['welcome_message_from']		= 'Administrator';
$LNG['welcome_message_sender']		= 'Administrator';
$LNG['welcome_message_subject']		= 'Willkommen';
$LNG['welcome_message_content']		= 'Willkommen beim %s! Baue zuerst ein Solarkraftwerk, denn Energie wird für die spätere Rohstoffproduktion benötigt. Um diese zu bauen, klicke links im Menu auf "Gebäude". Danach baue das 4. Gebäude von oben. Da du nun Energie hast, kannst du anfangen Minen zu bauen. Gehe dazu wieder im Menü auf Gebäude und baue eine Metallmine, danach wieder eine Kristallmine. Um Schiffe bauen zu können musst du zuerst eine Raumschiffswerft gebaut haben. Was dafür benötigt wird findest du links im Menüpunkt Technologie. Das Team wünscht dir viel Spaß beim Erkunden des Universums!';
$LNG['reg_completed']				= 'Danke für ihre Anmeldung! Sie erhalten eine E-Mail mit einem aktivierungs Link.';
$LNG['planet_already_exists']		= 'Die Planetenposition ist bereits belegt!';

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