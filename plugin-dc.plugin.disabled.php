<?php
/*
@name PluginDC
@author Clément GIRARD <clement.girard4@gmail.com>
@link https://sites.google.com/site/clementgirard4/
@licence CC by nc sa
@version 1.0.0
@description Gestion de la télé par VLC et flux m3u
*/
//Commande vocal

//Si vous utiliser la base de donnees a ajouter
//include('PluginDC.class.php');

//Cette fonction va generer un nouveau element dans le menu horizontal
function dc_plugin_menu(&$menuItems){
	global $_;
	$menuItems[] = array('sort'=>10,'content'=>'<a href="index.php?module=PluginDC"><i class="icon-th-large"></i> Plugin Détection</a>');
}

//Cette fonction va generer un nouveau element dans le menu de préférences
function dc_plugin_setting_menu(){
	global $_;
	echo '<li '.(isset($_['section']) && $_['section']=='PluginDC'?'class="active"':'').'><a href="setting.php?section=PluginDC"><i class="icon-chevron-right"></i> Plugin Détection</a></li>';
	
}

//Cette fonction décrit le contenu de l'élément du menu de préférence
function dc_plugin_setting_page(){
	global $myUser,$_,$conf;
	
	if(isset($_['section']) && $_['section']=='PluginDC' ){
		if($myUser!=false){
			?>

			<div class="span9 userBloc">


				<h1>Plugin Détection Control</h1>
				<p>Gestion des paramètres</p>  

				<form action="action.php?action=dc_add_dc" method="POST"> 
					<fieldset>
						<legend><? echo $description ?></legend>

						<div class="left">
							</div>

						<div class="clear"></div>
						<br/>
							<p style="float: left;"><button type="submit" class="btn"><? echo $button; ?></button>
							</p>
							<p style="float: right;"><a class="btn" href="setting.php?section=PluginDC&save=true"<i class="icon-check icon-black"></i> Activer la surveillance</a><a class="btn" href="setting.php?section=PluginDC"><i class="icon-remove icon-black"></i> Annuler</a>
							</p>
					</fieldset>
					<br/>
				</form>

				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Surveillance</th>
							<th>Status</th>
							<th>Alerte</th>
							<th></th> 
						</tr>
					</thead>
					</table>
<p style="float: right;"><a class="btn btn-danger" href="setting.php?section=PluginDC&reset=true">Reset</a>
</p>
</div>

				<?php 

					if (isset($_GET['save'])){ // On les données envoyées
					  if ($_GET['save']=="true
					  system('echo "PASS" | sudo -u root -S COMMAND');
					  exec('service motion start', $outputArray);
print_r($outputArray);
					 exec('sudo -u www-data /var/www/yana-server/plugins/Plugin-DetectionControl/start.sh'); exit; 
					  echo "trou";
					  $contents = file_get_contents('/var/www/yana-server/plugins/Plugin-DetectionControl/start.sh');
echo shell_exec($contents);

						
						
						system('/var/www/yana-server/plugins/Plugin-DetectionControl/start.sh');
						}
					}
					if (isset($_GET['reset'])){ // On les données envoyées
					  if ($_GET['reset']=="true"){
						dc_reset_constant();
						}
					}
					
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

Plugin::addHook("setting_menu", "dc_plugin_setting_menu"); //Ajoute un item à la liste du menu de préférence
Plugin::addHook("setting_bloc", "dc_plugin_setting_page"); //Ajoute le contenu du menu de préférences
Plugin::addHook("action_post_case", "dc_action_dc"); //Ajoute les actions menu de préférences

//Plugin::addHook("action_post_case", "dc_action");    
//Plugin::addHook("vocal_command", "dc_vocal_command");

//Plugin::addHook("menubar_pre_home", "ps_plugin_menu");  
//Plugin::addHook("home", "ps_plugin_page");  
?>
