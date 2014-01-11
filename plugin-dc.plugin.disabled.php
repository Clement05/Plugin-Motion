<?php
/*
@name PluginMotion
@author Clément GIRARD <clement.girard4@gmail.com>
@link https://sites.google.com/site/clementgirard4/
@licence CC by nc sa
@version 1.0.0
@description Gestion de la télé par VLC et flux m3u
*/
//Commande vocal

//Si vous utiliser la base de donnees a ajouter
//include('PluginMotion.class.php');

//Cette fonction va generer un nouveau element dans le menu horizontal

//Récupération des variables
if (isset($_GET['action'])){
  if ($_GET['action']=="On"){

	passthru("sudo -u root /var/www/yana-server/plugins/Plugin-DetectionControl/start.sh", $err);
	if ($err != 0) echo 'erreur '.$err;
	$status = $err;
	}
}
if (isset($_GET['action'])){ // On les données envoyées
  if ($_GET['action']=="Off"){
	passthru("sudo -u root /var/www/yana-server/plugins/Plugin-DetectionControl/stop.sh", $err);
	if ($err != 0) echo 'erreur '.$err;
	$status = $err;
	}
}
					
function motion_plugin_menu(&$menuItems){
	global $_;
	$menuItems[] = array('sort'=>10,'content'=>'<a href="index.php?module=PluginMotion"><i class="icon-th-large"></i> Plugin Détection</a>');
}

//Cette fonction va generer un nouveau element dans le menu de préférences
function motion_plugin_setting_menu(){
	global $_;
	echo '<li '.(isset($_['section']) && $_['section']=='PluginMotion'?'class="active"':'').'><a href="setting.php?section=PluginMotion"><i class="icon-chevron-right"></i> Plugin Détection</a></li>';
	
}

//Cette fonction décrit le contenu de l'élément du menu de préférence
function motion_plugin_setting_page(){
	global $myUser,$_,$conf;
	$status = "";
	
	if(isset($_['section']) && $_['section']=='PluginMotion' ){
		if($myUser!=false){
			?>

			<div class="span9 userBloc">


				<h1>Plugin Activation Motion</h1>
				<p>Gestion des paramètres</p>  

				<p style="float: right;"><a class="btn btn-action" href="setting.php?section=PluginDC&action=On"<i class="icon-check icon-black"></i> Activer la surveillance</a><a class="btn btn-danger" href="setting.php?section=PluginDC&action=Off">Désactiver la surveillance</a>
				</p>

				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Status</th>
							<th>Alerte</th>
						</tr>
					</thead>
					<tr>
						<td><?php echo $err; ?></td>
						<td></td>
					</tr>
					</table>
<p style="float: right;">
</p>
</div>

				<?php 
					
				}else{ ?>

				<div id="main" class="wrapper clearfix">
					<article>
						<h3>Vous devez être connecté</h3>
					</article>
				</div>
				<?php
			}
		}
	}
			
			
Plugin::addCss("/css/style.css"); 
//Plugin::addJs("/js/main.js"); 

Plugin::addHook("setting_menu", "motion_plugin_setting_menu"); //Ajoute un item à la liste du menu de préférence
Plugin::addHook("setting_bloc", "motion_plugin_setting_page"); //Ajoute le contenu du menu de préférences
Plugin::addHook("action_post_case", "motion_action_motion"); //Ajoute les actions menu de préférences

//Plugin::addHook("action_post_case", "dc_action");    
//Plugin::addHook("vocal_command", "dc_vocal_command");

//Plugin::addHook("menubar_pre_home", "ps_plugin_menu");  
//Plugin::addHook("home", "ps_plugin_page");  
?>
