<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html lang="de">
<head>
<link rel="stylesheet" type="text/css" href="./styles/skins/darkness/formate.css">
<link rel="stylesheet" type="text/css" href="./styles/css/admin.css">
<link rel="stylesheet" type="text/css" href="./styles/css/jQuery.ui.css">
<link rel="stylesheet" type="text/css" href="./styles/css/mbContainer.css">
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
<script type="text/javascript" src="./scripts/jquery.metadata.js"></script>
<script type="text/javascript" src="./scripts/mbContainer.js"></script>
<script type="text/javascript" src="./scripts/overlib.js"></script>
{foreach item=scriptname from=$scripts}
<script type="text/javascript" src="./scripts/{$scriptname}"></script>
{/foreach}
<script type="text/javascript">
var xsize 	= screen.width;
var ysize 	= screen.height;
var breite	= 720;
var hoehe	= 300;
var xpos	= (xsize-breite) / 2;
var ypos	= (ysize-hoehe) / 2;


function useropen(target_url) {
	var userlist = window.open("UserListPage.php?action=edit&id="+ target_url, "info", "scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width=850,height=600,screenX="+((xsize-600)/2)+",screenY="+((ysize-850)/2)+",top="+((ysize-600)/2)+",left="+((xsize-850)/2));
	userlist.focus();
}

function openEdit(id, type) {
	var editlist = window.open("?page=qeditor&edit="+type+"&id="+id, "edit", "scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width=850,height=600,screenX="+((xsize-600)/2)+",screenY="+((ysize-850)/2)+",top="+((ysize-600)/2)+",left="+((xsize-850)/2));
	editlist.focus();
}
</script> 
</head>
<body>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>