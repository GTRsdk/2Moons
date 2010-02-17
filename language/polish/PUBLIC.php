<?php

//general
$lang['index']				= 'Index';
$lang['register']			= 'Rejestracja';
$lang['forum']				= 'Forum';
$lang['send']				= 'Wys&#322ano';
$lang['menu_index']			= 'IndeX'; 	 
$lang['menu_news']			= 'News';	 
$lang['menu_rules']			= 'Regulamin'; 
$lang['menu_agb']			= 'SOK'; 
$lang['menu_pranger']		= 'Pr&#281gierz';	 
$lang['menu_top100']		= 'Hall of Fame';	 
$lang['menu_disclamer']		= 'Kontakt';	 
	 
/* ------------------------------------------------------------------------------------------ */

//index.php
//case lostpassword
$lang['mail_not_exist'] 		= 'Die angegebende E-Mail Adresse existiert nicht!';
$lang['mail_title']				= 'Neues Passwort';
$lang['mail_text']				= 'Dein neuen Passwort ist: ';
$lang['mail_sended']			= 'Dein Passwort wurde erfolgreich gesendet!';
$lang['mail_sended_fail']		= 'E-Mail konnte nicht gesendet werden.!';
$lang['server_infos']			= array(
	"Gra strategii kosmicznej w czasie rzeczywistym.",
	"Graj wraz z setkami u&#380ytkownik&#243w.",
	"Nie musisz nic pobiera&#263 potrzebujesz jedynie standardowej przegl&#261darki.",
	"Darmowa rejestracja.",
);

//case default
$lang['login_error']			= 'Z&#322a nazwa u&#380ytkownika i has&#322o! <br><a href="index.php">Zur&uuml;ck</a>';
$lang['screenshots']			= 'Screenshots';
$lang['universe']				= 'Universum';
$lang['chose_a_uni']			= 'Wybierz universum';

/* ------------------------------------------------------------------------------------------ */

//lostpassword.tpl
$lang['lost_pass_title']		= 'Passwort wiederherstellen';
$lang['lost_pass_text'] 		= 'To retrieve your password, enter the email used for registration. You will receive a new password as soon as possible.';
$lang['retrieve_pass']			= 'Wiederherstellen';
$lang['email']					= 'E-Mail Adresse';

//index_body.tpl
$lang['user']					= 'Login';
$lang['pass']					= 'Has&#322o';
$lang['remember_pass']			= 'Auto-Login';
$lang['lostpassword']			= 'Zapomnia&#322e&#347 has&#322a ?';
$lang['welcome_to']				= 'Witamy w';
$lang['server_description']		= '</strong> is a <strong>strategic space simulation game</strong> with <strong>thousands of players</strong> all over the world competing <strong>simultaneously</strong> to be the best. Everything you need to play is a standard web browser.';
$lang['server_register']		= 'Zarejestruj si&#281 teraz!';
$lang['server_message']			= 'Zarejestruj si&#281 i do&#347wiadcz nowe i fascynuj&#261ce przygody.';
$lang['login']					= 'Login';
$lang['disclamer']				= 'Kontakt';
$lang['login_info']				= 'Loguj&#261c si&#281, akceptuj&#281 <a onclick="ajax(\'?page=rules&amp;\'+\'getajax=1\');" style="cursor:pointer;">Regeln</a> und die <a onclick="ajax(\'?page=agb&amp;\'+\'getajax=1\');" style="cursor:pointer;">AGB`s</a>';

/* ------------------------------------------------------------------------------------------ */

//reg.php - Registrierung
$lang['register_closed']			= 'Rejestracja zamkni&#281ta!';
$lang['register_at']				= 'Rejestracja na ';
$lang['reg_mail_message_pass']		= 'jeszcze jeden krok, aby uaktywni&#263 swoj&#261 nazw&#281 u&#380ytkownika';
$lang['reg_mail_reg_done']			= 'Witamy w %s!';
$lang['invalid_mail_adress']		= 'Z&#322y adres E-Mail!<br>';
$lang['empty_user_field']			= 'Prosz&#281 wype&#322ni&#263 wszystkie pola!<br>';
$lang['password_lenght_error']		= 'Has&#322o musi mie&#263 min. 6 znak&#243w!<br>';
$lang['user_field_no_alphanumeric']	= 'Podaj nazw&#281 u&#380ytkownika tylko znaki alfanumeryczne!<br>';
$lang['user_field_no_space']		= 'Prosimy nie zostawia&#263 nazwy u&#380ytkownika pustej!<br>';
$lang['terms_and_conditions']		= 'Musisz zaakceptowa&#263 <a href="index.php?page=agb">AGB</a> und <a href="index.php?page=rules>Regeln</a> aktzeptieren!<br>';
$lang['user_already_exists']		= 'Nazwa u&#380ytkownika jest ju&#380 zaj&#281ta!<br>';
$lang['mail_already_exists']		= 'Adres e-mail jest ju&#380 w u&#380yciu!<br>';
$lang['wrong_captcha']				= 'Kod zabezpieczaj&#261cy jest nieprawid&#322owy!<br>';
$lang['different_passwords']		= 'Poda&#322e&#347 2 r&#243&#380ne has&#322a!<br>';
$lang['different_mails']			= 'Poda&#322e&#347 2 r&#243&#380ne adresy e-mail!<br>';
$lang['welcome_message_from']		= 'Administrator';
$lang['welcome_message_sender']		= 'Administrator';
$lang['welcome_message_subject']	= 'Witaj';
$lang['welcome_message_content']	= 'Zapraszamy do %s!<br>Baue zuerst eine Solaranlage, denn Energie wird f&uuml;r die sp&auml;tere Rohstoffproduktion ben&ouml;tigt. Um dies zu bauen, klicke links im Menu auf "Geb&auml;ude". Danach baue das 4. Geb&auml;ude von oben. Da du nun Energie hast, kannst du anfangen Minen zu bauen. Gehe dazu wieder im Men&uuml; auf Geb&auml;ude und baue eine Metallmine, danach wieder eine Kristallmine. Um Schiffe bauen zu k&ouml;nnen musst du zuerst eine Raumschiffswerft gebaut haben. Was daf&uuml;r ben&ouml;tigt wird findest du links im Men&uuml;punkt Technologie. Das Team w&uuml;nscht dir viel Spa&szlig; beim Erkunden des Universums!';
$lang['newpass_smtp_email_error']	= '<br><br>Ein Fehler trat auf. Dein Passwort ist: ';
$lang['reg_completed']				= 'Dzi&#281kujemy za rejestracj&#281. Otrzymasz e-mail';

//registry_form.tpl
$lang['server_message_reg']			= 'Zarejestruj si&#281 i b&#261d&#378 graczem wspania&#322ego &#347wiata';
$lang['register_at_reg']			= 'Registriert bei';
$lang['user_reg']					= 'Login';
$lang['pass_reg']					= 'Has&#322o';
$lang['pass2_reg']					= 'Powt&#243rz has&#322o';
$lang['email_reg']					= 'Adres E-mail';
$lang['email2_reg']					= 'Powt&#243rz adres E-mail';
$lang['register_now']				= 'Rejestracja!';
$lang['captcha_reg']				= 'Kod zabezpieczaj&#261cy';
$lang['accept_terms_and_conditions']= 'Akceptuje <a onclick="ajax(\'?page=rules&amp;\'+\'getajax=1\');" style="cursor:pointer;">Regulamin</a> i <a onclick="ajax(\'?page=agb&amp;\'+\'getajax=1\');" style="cursor:pointer;">SOK</a>';
$lang['captcha_reload']				= 'NowaCAPTCHA';
$lang['captcha_help']				= 'Hilfe';
$lang['captcha_get_image']			= 'Nowy obrazek';
$lang['captcha_reload']				= 'Nowa CAPTCHA';
$lang['captcha_get_audio']			= 'Dzwi&#281k-CAPTCHA';

//registry_closed.tpl
$lang['agb_and_rules']				= 'Hier k&ouml;nnen sie die <a href="index.php?page=agb">AGB</a> und <a href="rules.php">Regeln</a> nachlesen';
$lang['reg_closed']					= 'Die Registrierung ist geschlossen';

//Rules
$lang['rules_overview']				= "Regelwerk";
$lang['rules']						= array(
	"Accounts"					=> "Der Besitzer eines Accounts ist immer der Inhaber der festen E-mail Adresse. Ein Account darf ausschlie&szlig;lich alleine gespielt werden. 
	Eine Ausnahme bildet nur das Sitten. Sollte es notwendig werden, dass der Account eines Anderen &uuml;berwacht oder in den Urlaubsmodus gesetzt werden muss, 
	so ist der zust&auml;ndige Operator vorher zu informieren und dessen Genehmigung einzuholen. F&uuml;r kurzfristiges Sitten unter 12 Stunden reicht eine Meldung an den Operator. 
	Beim Sitten sind s&auml;mtliche Flottenbewegungen verboten, lediglich das Saven der Flotte auf Koordinaten des Gesitteten und das Verbauen der Rohstoffe auf dem Planeten, auf dem sie liegen, ist erlaubt. 
	Ein Account darf f&uuml;r h&ouml;chstens 72h gesittet werden. Bei Ausnahmen muss die Erlaubniss eines Operators vorliegen.
	Die Weitergabe eines Accounts darf max. alle 3 Monate und ausschliesslich unentgeltlich erfolgen. 
	Ausnamhen beim Operator melden.",

	"Multiaccounts"				=> "Der Besitzer eines Accounts ist immer der Inhaber der festen E-mail Adresse. Ein Account darf ausschlie&szlig;lich alleine gespielt werden. 
	Eine Ausnahme bildet nur das Sitten. Sollte es notwendig werden, dass der Account eines Anderen &uuml;berwacht oder in den Urlaubsmodus gesetzt werden muss, 
	so ist der zust&auml;ndige Operator vorher zu informieren und dessen Genehmigung einzuholen. F&uuml;r kurzfristiges Sitten unter 12 Stunden reicht eine Meldung an den Operator. 
	Beim Sitten sind s&auml;mtliche Flottenbewegungen verboten, lediglich das Saven der Flotte auf Koordinaten des Gesitteten und das Verbauen der Rohstoffe auf dem Planeten, auf dem sie liegen, ist erlaubt. 
	Ein Account darf f&uuml;r h&ouml;chstens 72h gesittet werden. Bei Ausnahmen muss die Erlaubniss eines Operators vorliegen.
	Die Weitergabe eines Accounts darf max. alle 3 Monate und ausschliesslich unentgeltlich erfolgen. 
	Ausnamhen beim Operator melden.",

	"Pushen"					=> "Pushen ist grunds&auml;tzlich verboten. Als Pushing werden alle Ressourcen-Lieferungen ohne angemessene Gegenleistung von punktschw&auml;cheren Accounts an punktst&auml;rkere Accounts gesehen. 
	Ausnahmen m&uuml;ssen im Vorfeld vom Operator genehmigt werden. Eine fehlende Genehmigung kann eine Sperre wegen Pushens nach sich ziehen.
	Ein Handel muss innerhalb 24 Stunden abgeschlossen oder bei einem Operator angemeldet sein.",

	"Bashen"					=> "Mehr als 5 Angriffe innerhalb von 24 Stunden auf den gleichen Planeten z&auml;hlen als Bashen und sind verboten - der Mond z&auml;hlt als eigenst&auml;ndiger Planet. Angriffe mit Spiosonden oder Interplanetarraketen werden dabei nicht gez&auml;hlt.
	Die Bashregel gilt ausschlie&szlig;lich f&uuml;r aktive Spieler. Befinden sich die Parteien im Krieg, so sind weitere Angriffe erlaubt. Der Krieg muss mindestens 24 Stunden vor weiteren Angriffen im Forum erkl&auml;rt werden (im Thema der Ank&uuml;ndigung m&uuml;ssen beide Allianzen bzw. der Name des kriegserkl&auml;renden Einzelspielers in korrekter Schreibweise genannt werden). Eine Kriegserkl&auml;rung kann ausschlie&szlig;lich an Allianzen gerichtet werden, wobei die Kriegserkl&auml;rung durch eine Allianz oder eine Einzelperson erfolgen kann. 
	Eine Annahme des Krieges ist nicht erforderlich. Kriege, die offensichtlich nur der massiven Umgehung der Bashregel dienen, sind verboten. Dies zu beurteilen obliegt den zust&auml;ndigen Moderatoren und Operatoren.",

	"Bugusing"					=> "Bugs und/oder Fehler in der Programmierung auszunutzen ist verboten. Erkannte Bugs sollten so schnell wie m&ouml;glich per Post im Bugforum, IRC, Email oder ICQ gemeldet werden. Cheaten ist auch verboten.",

	"Sprache im Spiel"			=> "In allen entsprechenden Universen ist Deutsch/Englisch die offizielle Sprache im Spiel. Verst&ouml;&szlig;e k&ouml;nnen mit einer Sperrung des Accounts geahndet werden. Fremdsprachliche Ingame- Nachrichten/ Allypages k&ouml;nnen unter Vorbehalt zu einer Sperrung des Accounts f&uuml;hren.",

	"Bedrohungen/Beleidigungen"	=> "RL Erpressungen und -Bedrohungen f&uuml;hren zum Ausschlu&szlig; aus einem oder allen Titan Space Bereichen.
	Als Real-Life-Erpressungen und -bedrohungen werden Ingamenachrichten, Forenbeitr&auml;ge, IRC-Dialoge in &ouml;ffentlichen Channels und ICQ-Dialoge gewertet, die eindeutige Absichten signalisieren eine Person ausfindig zu machen und ihr oder einer nahestehenden dritten Person Schaden zuzuf&uuml;gen.",

	"Spam und Erotik"			=> "Spammen und Fremdwerbung ist verboten.Jeweilige Form von Erotik und Pornografischen Darstellungen ist verboten. Und wird mit einer Universums weiten und Lebenslangen Sperrung geandet!",

	"Die Regeln"	=> "Die Regeln k&ouml;nnen sich &auml;ndern und jeder User ist verpflichtet sich st&auml;ndig &uuml;ber den Stand zu Informieren !",

);

$lang['rules_info1']				= "Es wird aber im <a href=\"%s\" target=\"_blank\">Forum</a> und &uuml;ber die Startseite im Game dar&uuml;ber Informiert ...";
$lang['rules_info2']				= "Als Erg&auml;nzung hierzu sind die <a onclick=\"ajax('?page=agb&getajax=1');\" style=\"cursor:pointer;\">AGB</a> zu beachten und einzuhalten !</font>";


//AGB

$lang['agb_overview']				= "Allgemeine Gesch&auml;ftsbedingungen";
$lang['agb']						= array(
	"Leistungsinhalte"				=> array( 
		"Die Anerkennung der AGBS sind n&ouml;tige Voraussetzung, um am Spiel teilnehmen zu k&ouml;nnen.
		Sie gelten f&uuml;r alle Angebote seitens der Betreiber, einschlie&szlig;lich des Forums und anderer spielbezogener Inhalte.",
		
		"Das Angebot ist kostenlos.
		Somit bestehen keinerlei Anspr&uuml;che auf Verf&uuml;gbarkeit, Bereitstellung, Funktionalit&auml;t oder Schadensersatz.
		Weiterhin hat der Spieler keinerlei Anspr&uuml;che auf Wiederherstellung, sollte sein Account nachteilig behandelt worden sein.",
	),

	"Mitgliedschaft"				=> array(
		"Mit erfolgter Anmeldung im Spiel- und/oder im Forum beginnt die Mitgliedschaft im jeweiligen Spiel.",
		
		"Die mit der Anmeldung beginnende Mitgliedschaft kann jederzeit von Seiten des Mitglieds mit L&ouml;schung des Accounts oder durch Anschreiben eines Administrators beendet werden.
		Eine L&ouml;schung der Daten kann aus technischen Gr&uuml;nden nicht sofort erfolgen.",
		
		"Beendigung durch den Betreiber Kein Nutzer hat einen Anspruch auf die Teilnahme an Angeboten des Betreibers.
		Der Betreiber beh&auml;lt sich das Recht vor, Accounts zu l&ouml;schen.
		Die Entscheidung &uuml;ber die L&ouml;schung von Nutzeraccounts obliegt einzig und allein dem Betreiber sowie den Administratoren und Operator.
		Jedweder Rechtsanspruch auf eine Mitgliedschaft ist ausgeschlossen.",
		
		"S&auml;mtliche Rechte verbleiben beim Betreiber.",
	),

	"Inhalte/Verantwortlichkeit"	=> "F&uuml;r den Inhalt der verschiedenen spielbezogenen Kommunikationsm&ouml;glichkeiten sind die Nutzer selbst verantwortlich. Pornographische, rassistische, beleidigende oder auf sonstige Weise gegen geltendes Recht versto&szlig;ende Inhalte liegen nicht in der Verantwortung des Betreibers.
	Verst&ouml;&szlig;e k&ouml;nnen zur sofortigen L&ouml;schung oder Sperrung f&uuml;hren.
	Die L&ouml;schung solcher Inhalte erfolgt schnellstm&ouml;glich, kann jedoch aus technischen und/oder pers&ouml;nlichen Gr&uuml;nden verz&ouml;gert werden.",

	"Verbotene Eingriffe"			=> array(
		"Der Nutzer ist nicht berechtigt, Hardware/Software oder sonstige Materien oder Mechanismen in Verbindung mit der Website zu verwenden, die die Funktion und den Spielablauf st&ouml;ren k&ouml;nnen.
		Der Nutzer darf weiterhin keine Ma&szlig;nahmen ergreifen, die eine unzumutbare oder verst&auml;rkte Belastung der technischen Kapazit&auml;ten zur Folge haben k&ouml;nnen.
		Es ist dem Nutzer nicht gestattet, vom Betreiber generierte Inhalte zu manipulieren oder in sonstiger Weise st&ouml;rend in das Spiel einzugreifen.",
		
		"Jede Art von Bot, Script oder sonstige Automatisierungsfunktionen sind verboten.
		Das Spiel darf nur im Browser gespielt werden. Selbst seine Funktionen d&uuml;rfen nicht genutzt werden um sich einen Spielvorteil zu verschaffen.
		Somit darf auch keine Werbung geblockt werden. Die Entscheidung, wann eine Software f&uuml;r den Spieler vorteilhaft ist, liegt einzig beim Betreiber/ bei den Administratoren/Operatoren.",
		
		"Ein automatisiertes &ouml;ffnen des Accounts, unabh&auml;ngig davon, ob dabei die Startseite angezeigt wird oder nicht, ist nicht erlaubt.",
	),

	"Nutzungsbeschr&auml;nkung"		=> array(
		"Ein Spieler darf nur jeweils einen Account pro Universum nutzen, so genannte \"Multis\" sind nicht erlaubt und k&ouml;nnen ohne Warnung gel&ouml;scht/gesperrt werden.
		Die Entscheidung, wann ein \"Multi\" vorliegt, liegt einzig beim Betreiber/Administratoren/Operatoren.",
		
		"N&auml;heres bestimmt sich nach den Spielregeln.",
		
		"Sperrungen k&ouml;nnen nach Ermessen des Betreibers dauerhaft oder tempor&auml;r sein.
		Ebenso k&ouml;nnen sich Sperrungen auf einen oder alle Spielbereiche erstrecken.
		Die Entscheidung, wann und wie lange ein Spieler gesperrt wird, liegt einzig beim Betreiber/ bei den Administratoren/Operatoren.",
	),

	"Datenschutz"					=> array(
		"Der Betreiber beh&auml;lt sich das Recht vor, Daten der Spieler zu speichern, um die Einhaltung der Regeln, der AGB sowie geltenden Rechts zu &uuml;berwachen.
		Gespeichert werden alle ben&ouml;tigten und vom Spieler oder seinem Account abgegebenen Daten.
		Hierzu geh&ouml;ren (IPs in Verbindung mit Nutzungszeiten und Nutzungsart, die bei der Anmeldung angegebene Email Adresse und weitere Daten.
		Im Forum werden die dort im Profil gemachten Angaben gespeichert.",
		
		"Diese Daten werden unter Umst&auml;nden zur Wahrnehmung gesetzlicher Pflichten an Handlungsgehilfen und sonstige Berechtigte herausgegeben.
		Weiterhin k&ouml;nnen Daten (wenn notwendig) unter Umst&auml;nden an Dritte herausgegeben werden.",
		
		"Der Nutzer kann der Speicherung seiner personenbezogenen Daten jederzeit widersprechen. Ein Widerspruch kommt einer K&uuml;ndigung gleich.",
	),

	"Rechte des Betreibers an den Accounts"	=> array(
		"Alle Accounts und alle virtuellen Gegenst&auml;nde bleiben im Besitz und Eigentum des Betreibers.
		Der Spieler erwirbt kein Eigentum und auch sonst keinerlei Rechte am Account oder an Teilen.
		S&auml;mtliche Rechte verbleiben beim Betreiber.
		Eine &Uuml;bertragung von Verwertungs- oder sonstigen Rechten auf den Nutzer findet zu keinem Zeitpunkt statt.",
		
		"Unerlaubte Ver&auml;u&szlig;erung, Verwertung, Kopie, Verbreitung, Vervielf&auml;ltigung oder anderweitige Verletzung der Rechte (z.B. am Account) des Betreibers werden dem geltenden Recht entsprechend verfolgt.
		Ausdr&uuml;cklich gestattet ist die unentgeltliche, endg&uuml;ltige Weitergabe des Accounts sowie das Handeln von Ressourcen im eigenen Universum, sofern und soweit es die Regeln zulassen.",
	),

	"Haftung"	=> "Der Betreiber eines jeden Universums &uuml;bernimmt keine Haftung f&uuml;r etwaige Sch&auml;den.
	Eine Haftung ist ausgeschlossen mit Ausnahme von Sch&auml;den, die durch Vorsatz und grobe Fahrl&auml;ssigkeit entstehen sowie s&auml;mtlichen Sch&auml;den an Leben und Gesundheit.
	Diesbez&uuml;glich wird ausdr&uuml;cklich darauf hingewiesen, dass Computerspiele erhebliche Gesundheitsrisiken bergen k&ouml;nnen.
	Sch&auml;den sind nicht im Sinne des Betreibers.",

	"&Auml;nderung der Nutzungsbedingungen"	=> "Der Betreiber beh&auml;lt sich das Recht vor, diese Nutzungsbedingungen jederzeit zu &auml;ndern oder zu erweitern.
	Eine &auml;nderung oder Erg&auml;nzung wird mindestens eine Woche vor Inkrafttreten im Forum ver&ouml;ffentlicht.",
);

//NEWS

$lang['news_overview']			= "News";
$lang['news_from']				= "Am %s von %s";
$lang['news_does_not_exist']	= "Brak nowo&#347ci!";

//Impressum

$lang['disclamer']				= "Haftungsausschluss";
$lang['disclamer_name']			= "Name";
$lang['disclamer_adress']		= "Adresse";
$lang['disclamer_tel']			= "Telefon:";
$lang['disclamer_email']		= "E-Mail Adresse";
?>