<!DOCTYPE html>

<html lang="{$lang}">
<head>
<link rel="stylesheet" type="text/css" href="styles/css/jQuery.css">
<link rel="stylesheet" type="text/css" href="styles/css/login.css">
<link rel="icon" href="favicon.ico">
<title>{$servername}</title>
<meta name="generator" content="2Moons">
<!-- 
	This website is powered by 2Moons
	2Moons is a free Space Browsergame initially created by Slaver and licensed under GNU/GPL.
	2Moons is copyright 2009-2011 of Slaver. Extensions are copyright of their respective owners.
	Information and contribution at http://2moons.cc/
-->
<meta name="keywords" content="Browsergame, Clone, XNova, 2Moons">
<meta name="medium" content="mult">
<meta name="description" content="2Moons Browsergame powerd by Slaver"> <!-- Noob Check ;) -->
<!--[if lt IE 9]>
<script src="scripts/html5.js"></script>
<![endif]-->
</head>	
<body>
<div id="page">
	<header>
		<nav>
			<ul id="menu">
				<li><a href="#" onclick="return Dialog.close();">{$menu_index}</a></li>
				<li><a href="{$forum_url}" target="board">{$forum}</a></li>
				<li><a href="#" onclick="return Dialog.standart('{$menu_news}','news')">{$menu_news}</a></li>
				<li><a href="#" onclick="return Dialog.standart('{$menu_rules}','rules')">{$menu_rules}</a></li>
				<li><a href="#" onclick="return Dialog.standart('{$menu_agb}','agb')">{$menu_agb}</a></li>
				<li><a href="#" onclick="return Dialog.standart('{$menu_top100}','top100')">{$menu_top100}</a></li>
				<li><a href="#" onclick="return Dialog.standart('{$menu_pranger}','pranger')">{$menu_pranger}</a></li>
				<li><a href="#" onclick="return Dialog.standart('{$menu_disclamer}','disclamer')">{$menu_disclamer}</a></li>
			</ul>
		</nav>
		<nav>
			<ul id="lang">
				{foreach $langs as $lng}
				<li><a href="javascript:setLNG('{$lng}')"><span class="flags {$lng}"></span></a></li>
				{/foreach}
			</ul>
		</nav>
	</header>

	<div id="content">
		<section>
			<h1>{$welcome_to} {$servername}</h1>
			<p class="desc">{$server_description}</p>
			<p class="desc"><ul id="desc_list">{foreach item=InfoRow from=$server_infos}<li>{$InfoRow}</li>{/foreach}</ul>
		</section>
		<section>
			<div id="contentbox">
				<div class="no"><div class="ne"><div class="n"></div></div>
					<div class="o"><div class="e"><div class="c">
						<div id="loginbox"><h3>{$login}</h3>
							<form id="login" name="login" action="index.php" method="post" onsubmit="return Submit('login');">
								<label for="universe">{$universe}</label><select name="universe" id="universe">{html_options options=$AvailableUnis selected=$UNI}</select><br>
								<label for="username">{$user}</label><input name="username" id="username" type="text"><br>
								<label for="password">{$pass}</label><input name="password" id="password" type="password"><br>
								<input name="submit" value="{$login}" type="submit">
							</form>
							{if $fb_active}<br><a href="javascript:initFB();"><img src="http://b.static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif" alt=""></a><br>{/if}
							<br><span class="small">{$login_info}</span>
						</div>
						<div id="regbox"><h3>{$register}</h3>
							<form id="reg" name="reg" action="index.php?page=reg&amp;action=send" method="post" onsubmit="return SubmitReg();">
								<label for="reg_universe">{$universe}</label><select name="universe" id="reg_universe">{html_options options=$AvailableUnis selected=$UNI}</select><br>
								<label for="reg_username">{$user}</label><input name="username" id="reg_username" type="text"><br>
								<label for="reg_password">{$pass}</label><input name="password" id="reg_password" type="password"><br>
								<label for="reg_password_2">{$pass_2}</label><input name="password_2" id="reg_password_2" type="password"><br>
								<label for="reg_email">{$email}</label><input name="email" id="reg_email" type="text"><br>
								<label for="reg_email_2">{$email_2}</label><input name="email_2" id="reg_email_2" type="text"><br>
								<label for="reg_planet">{$planetname}</label><input name="planet" id="reg_planet" type="text"><br>
								<label for="reg_lang">{$language}</label><select name="lang" id="reg_lang">{html_options options=$AvailableLangs selected=$lang}</select><br>
								<input name="submit" value="{$register}" type="submit">
							</form>
							{if $fb_active}<br><a href="javascript:initFB();"><img src="http://b.static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif" alt=""></a><br>{/if}
						</div>
						<div id="lostbox"><h3>{$lostpassword}</h3>
							<form id="lost" name="lost" action="index.php" method="post" onsubmit="return SubmitLogin();">
								<label for="universe_lost">{$universe}</label><select name="universe" id="universe_lost">{html_options options=$AvailableUnis selected=$UNI}</select><br>
								<label for="username_lost">{$user}</label><input name="username" id="username_lost" type="text"><br>
								<label for="email_lost">{$email}</label><input name="password" id="email_lost" type="text"><br>
								<input name="submit" value="{$login}" type="submit">
							</form>
						</div>
					</div></div></div>
					<div>
					<div class="so"><div class="se"><div class="s"></div></div></div>
					</div>
				</div>
			</div>
		</section>
		<section>
			<table class="box">
				<tr><td>
					<table class="box-header"><tr><td class="box-header-left"></td><td class="box-header-center"></td><td class="box-header-right"></td></tr></table>
				</td></tr>
				<tr><td>
					<table class="box-content"><tr><td class="box-content-left"></td><td class="box-content-center">
						<a href="#" onclick="return Content('login');" class="multi">
							<table class="button-important"><tr><td class="button-left"></td><td class="button-center">
								{$login}
							</td><td class="button-right"></td></tr></table></a>
						<a href="#" onclick="return Content('register');" class="multi">
							<table class="button-important"><tr><td class="button-left"></td><td class="button-center">
								{$register_now}
							</td><td class="button-right"></td></tr></table></a>
						</td><td class="box-content-right"></td></tr>
					</table>
				</td></tr>
				<tr><td>
					<table class="box-footer"><tr><td class="box-footer-left"></td><td class="box-footer-center"></td><td class="box-footer-right"></td></tr></table>
				</td></tr>
			</table>
			<table class="box">
				<tr><td>
					<table class="box-header"><tr><td class="box-header-left"></td><td class="box-header-center"></td><td class="box-header-right"></td></tr></table>
				</td></tr>
				<tr><td>
					<table class="box-content"><tr><td class="box-content-left"></td><td class="box-content-center">
						<a href="#" onclick="return Content('lost');" class="multi"><table class="button button-multi"><tr>
							<td class="button-left"></td><td class="button-center">
								{$lostpassword}
						</td><td class="button-right"></td></tr></table></a>
						<a href="javascript:Menu.Reg();" class="multi"><table class="button button-multi"><tr>
							<td class="button-left"></td><td class="button-center">
								{$screenshots}
							</td><td class="button-right"></td></tr></table></a>
						</td><td class="box-content-right"></td></tr>
					</table>
				</td></tr>
				<tr><td>
					<table class="box-footer"><tr><td class="box-footer-left"></td><td class="box-footer-center"></td><td class="box-footer-right"></td></tr></table>
				</td></tr>
			</table>
		</section>
	</div>
	<footer>
		<a href="#" onclick="return Dialog.standart('{$menu_disclamer}','disclamer')">{$menu_disclamer}</a><br>{$servername} powered by <a href="http://2moons.cc" title="2Moons" target="copy">2Moons</a>
	</footer>
</div>
<script type="text/javascript" src="scripts/jQuery.js"></script>
<script type="text/javascript" src="scripts/login.js"></script>
<script type="text/javascript">
var CONG			= {
	IsCaptchaActive : {$game_captcha},
	cappublic		: "{$cappublic}",
};
var LANG			= {
	register		: "{$register_now}",
	login			: "{$login}",
	fb_perm			: "{$fb_perm}",
};
$.cookie('lang', "{$lang}");
{if $code}
$(document).ready(function(){
	alert("{$code}");
});
{/if}
</script>
{if $game_captcha}
<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
<script type="text/javascript">
//showRecaptcha();
</script>
{/if}
{if $ga_active}
<script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("{$ga_key}");
pageTracker._trackPageview();
} catch(err) {}</script>
{/if}
{if $fb_active}
<script type="text/javascript">
var APIKey	= "{$fb_key}";
</script>
{/if}
{if $bgm_active}
<script type="text/javascript" src="scripts/soundmanager2.js"></script>	
<script type="text/javascript">	
soundManager.url = 'scripts';
soundManager.flashVersion = 8;
soundManager.onready(function() {
	if (soundManager.supported()) {
		var loginbgm = soundManager.createSound({
			id: 'aSound',
			url: '{$bgm_file}',
			volume: 50
		});
		if($.cookie('music') == null || $.cookie('music') == "on"){
			loginbgm.play();
			$('#music').text("{$music_on}");
		}
	} else {
		alert('SoundManager failed to load');
	}
});

function music() {
	var loginbgm = soundManager.getSoundById('aSound');
	var idmusic = $('#music');
	if(idmusic.text() != "{$music_on}")
	{
		loginbgm.play();
		idmusic.text("{$music_on}");
		$.cookie('music', 'on');
	}
	else
	{
		loginbgm.stop();
		idmusic.text("{$music_off}");
		$.cookie('music', 'off');
	}
}
</script>
{/if}
</body>
</html>