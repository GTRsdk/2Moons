<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html lang="de">
<head>
<link rel="stylesheet" type="text/css" href="../styles/skins/gow/formate.css">
<link rel="stylesheet" type="text/css" href="../styles/css/admin.css">
<link rel="icon" href="./favicon.ico">
<title>{$title}</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-script-type" content="text/javascript">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=100">
{if $goto}
<meta http-equiv="refresh" content="{$gotoinsec};URL={$goto}">
{/if}
<!--[if lt IE 9]>
<script type="text/javascript" src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.metadata.js"></script>
<script type="text/javascript" src="../scripts/mbContainer.js"></script>
<script type="text/javascript" src="../scripts/overlib.js"></script>
{foreach item=scriptname from=$scripts}
<script type="text/javascript" src="../scripts/{$scriptname}"></script>
{/foreach}
</head>
<body>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<table width="700">
<tr>
	<th colspan="3">{$intro_instal}</th>
</tr>
<tr>
	<td colspan="3">[<a href="index.php?mode=intro&amp;{$lang}">{$menu_intro}</a> &bull; <a href="index.php?mode=req&amp;{$lang}">{$menu_install}</a> &bull; <a href="index.php?mode=license&amp;{$lang}">{$menu_license}</a> &bull; <a href="index.php?mode=convert&amp;{$lang}">{$menu_convert}</a>]</td>
</tr>