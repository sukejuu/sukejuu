<?php /* Smarty version Smarty-3.1.13, created on 2013-05-01 00:22:22
         compiled from "./templates/top.html" */ ?>
<?php /*%%SmartyHeaderCode:1765511191517698d41541d4-05888401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d1f85a2129596fb4e535b3dd8e458f2762730fd' => 
    array (
      0 => './templates/top.html',
      1 => 1367331604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1765511191517698d41541d4-05888401',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_517698d4188e05_29965325',
  'variables' => 
  array (
    'script_client_main' => 0,
    'system_name' => 0,
    'html_id_container_main' => 0,
    'copyright_year' => 0,
    'copyright_author' => 0,
    'license' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517698d4188e05_29965325')) {function content_517698d4188e05_29965325($_smarty_tpl) {?><!DOCTYPE html>
<meta charset="utf-8">
<link rel=stylesheet type="text/css" href="css/global.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://raw.github.com/browserstate/history.js/master/scripts/bundled/html5/native.history.js"></script>
<?php echo $_smarty_tpl->tpl_vars['script_client_main']->value;?>

<script src="https://raw.github.com/deviantART/jquery.deviantartmuro/master/jquery.deviantartmuro.js"></script>

<title class="title"><?php echo $_smarty_tpl->tpl_vars['system_name']->value;?>
</title>

<header>
  <h1 class="title"><?php echo $_smarty_tpl->tpl_vars['system_name']->value;?>
</h1>
</header>

<hr>

<div id="<?php echo $_smarty_tpl->tpl_vars['html_id_container_main']->value;?>
"></div>

<footer>
<hr>
<span id="copyright">(C)<?php echo $_smarty_tpl->tpl_vars['copyright_year']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['copyright_author']->value;?>
.</span>
<br>
<span id="license"><?php echo $_smarty_tpl->tpl_vars['license']->value;?>
</span>
</footer>

<div id="voices" class="hidden"></div>

<script>
  var system_name = '<?php echo $_smarty_tpl->tpl_vars['system_name']->value;?>
'
</script>
<script src="/script/top.js"></script>
<?php }} ?>