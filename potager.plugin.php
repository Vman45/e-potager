<?php
/*
@name Potager
@author Valou Tweak <dhomobox@gmail.com>
@link http://valou-tweak.fr
@licence CC by nc sa
@version 1.1.0
@description Intégration des données émises par un Flower Power de Parrot
*/

//On appelle les entités de base de données
require_once(__DIR__.'/Potager.class.php');

//Cette fonction va generer un nouveau element dans le menu
function flower_plugin_menu(&$menuItems){
	global $_;
	$menuItems[] = array('sort'=>10,'content'=>'<a href="index.php?module=flower&bloc=sensors"><i class="fa fa-pagelines"></i> Potager</a>');
}

//Cette fonction ajoute une commande vocale
function flower_plugin_vocal_command(&$response,$actionUrl){
	//global $conf;
	//Création de la commande vocale "Yana, commande de test" avec une sensibilité de 0.90 et un appel
	// vers l'url /action.php?action=test_plugin_vocal_test après compréhension de la commande
	/*$response['commands'][] = array(
		'command'=>$conf->get('VOCAL_ENTITY_NAME').' commande vocale de test',
		'url'=>$actionUrl.'?action=test_plugin_vocal_test','confidence'=>('0.90'+$conf->get('VOCAL_SENSITIVITY'))
		);*/
}

//cette fonction comprends toutes les actions du plugin qui ne nécessitent pas de vue html
function flower_plugin_action(){
	//global $_,$conf;

	//Action de réponse à la commande vocale "Yana, commande de test"
	/*switch($_['action']){
		case 'test_plugin_vocal_test':
			$response = array('responses'=>array(
										array('type'=>'talk','sentence'=>'Ma réponse à la commande de test est inutile.')
											)
								);
			$json = json_encode($response);
			echo ($json=='[]'?'{}':$json);
		break;
	}*/
}


//Cette fonction va generer une page quand on clique sur Flower dans menu
function flower_plugin_page($_){
	global $conf;
	global $_;

	if(isset($_['module']) && $_['module']=='flower' && isset($_['bloc']) && $_['bloc']=='sensors'){
	?>
	<div class="span3 bs-docs-sidebar"><br />
	  <ul class="nav nav-tabs nav-stacked">
	    <li class="active"><a if="ref1" href="./index.php?module=flower&bloc=sensors"><i class="fa fa-angle-right"></i> 1. Capteurs</a></li>
	    <li><a href="./index.php?module=flower&bloc=histo"><i class="fa fa-angle-right"></i> 2. Historiques </a></li>
	    <li><a href="./index.php?module=flower&bloc=actions"><i class="fa fa-angle-right"></i> 3. Actions </a></li>
	    <li><a href="./index.php?module=flower&bloc=infos"><i class="fa fa-angle-right"></i> 4. Informations </a></li>
	    <li><a href="./index.php?module=flower&bloc=help"><i class="fa fa-angle-right"></i> 5. Aide installation </a></li>
	  </ul>
	</div>

	<div class="span9">
	<h1>Potager</h1>
	<p>Gardez un oeil sur vos plantes et fleurs!</p>

	<legend>Capteurs</legend>

	<!-- Temperature -->
	    <h2><i class="fa fa-fire" aria-hidden="true"></i> Température: 21°C</h2>
	    <div class="progress progress-striped active">
	    <div class="bar" style="width: 20%; background-color: #B40404;"></div>
	    </div>
	<br />

	<!-- Humidite -->
	    <h2><i class="fa fa-tint" aria-hidden="true"></i> Humidité: 80%</h2>
	    <div class="progress progress-striped active">
	    <div class="bar" style="width: 80%; background-color: #2E64FE;"></div>
	    </div>
	<br />

	<!-- Luminosite -->
	    <h2><i class="fa fa-sun-o" aria-hidden="true"></i> Luminosité: 25 lux</h2>
	    <div class="progress progress-striped active">
	    <div class="bar" style="width: 60%; background-color: #FF8000;"></div>
	    </div>
	<br />

	<!-- Engrais -->
	    <h2><i class="fa fa-globe" aria-hidden="true"></i> Engrais: 40%</h2>
	    <div class="progress progress-striped active">
	    <div class="bar" style="width: 40%; background-color: #ACC26D"></div>
	    </div>
	<br />
	</div>

<?php	}

	else if(isset($_['module']) && $_['module']=='flower' && isset($_['bloc']) && $_['bloc']=='histo'){
	?>
	<div class="span3 bs-docs-sidebar"><br />
	  <ul class="nav nav-tabs nav-stacked">
	    <li><a href="./index.php?module=flower&bloc=sensors"><i class="fa fa-angle-right"></i> 1. Capteurs</a></li>
	    <li class="active"><a href="./index.php?module=flower&bloc=histo"><i class="fa fa-angle-right"></i> 2. Historiques </a></li>
	    <li><a href="./index.php?module=flower&bloc=actions"><i class="fa fa-angle-right"></i> 3. Actions </a></li>
	    <li><a href="./index.php?module=flower&bloc=infos"><i class="fa fa-angle-right"></i> 4. Informations </a></li>
	    <li><a href="./index.php?module=flower&bloc=help"><i class="fa fa-angle-right"></i> 5. Aide installation </a></li>
	  </ul>
	</div>

	<div class="span9">
	<h1>Potager</h1>
	<p>Gardez un oeil sur vos plantes et fleurs!</p>

	<legend>Temperature</legend>

	<!-- Graph Temperature -->
	<small>Relev&eacute;s pris à midi</small><br />
	<canvas id="temperature" width="800" height="250"></canvas>
	<?php
		$data = file_get_contents(__DIR__.'/data/history_t.txt');
		$data = explode("\n", $data);
	?>

	<script type="text/javascript">
		$(document).ready(function(){
		Chart.defaults.global.responsive = true;
		 var tempData = {
			labels : [<?php for($i=11; $i>=0; $i--) { echo "\"" . date('d/m', strtotime('-'.$i.' day')) . "\", "; }?>],
			datasets : [
					{
					fillColor : "rgba(223,58,1,0.4)",
					strokeColor : "#B40404",
					pointColor : "#fff",
					pointStrokeColor : "#9DB86D",
					data : [<?php for($i=0; $i<12; $i++) { echo round($data[$i]*2)/2 . ", "; } ?>]
				}
			]
		}

		var temperature = document.getElementById('temperature').getContext('2d');
		new Chart(temperature).Line(tempData);
		});
	</script>

	<legend> Humidité </legend>

	<!-- Graph Humidite -->
	<small>Relev&eacute;s pris à midi</small><br />
	<canvas id="humidity" width="800" height="250"></canvas>
	<?php
		$data = file_get_contents(__DIR__.'/data/history_h.txt');
		$data = explode("\n", $data);
	?>

        <script type="text/javascript">
                $(document).ready(function(){
		var humData = {
			labels : [<?php for($i=11; $i>=0; $i--) { echo "\"" . date('d/m', strtotime('-'.$i.' day')) . "\", "; }?>],
			datasets : [
					{
					fillColor : "rgba(46,154,254,0.4)",
					strokeColor : "#2E64FE",
					pointColor : "#fff",
					pointStrokeColor : "#9DB86D",
					data : [<?php for($i=0; $i<12; $i++) { echo round($data[$i]*2)/2 . ", "; } ?>]
				}
			]
		}

		var humidity = document.getElementById('humidity').getContext('2d');
		new Chart(humidity).Line(humData);
		});
	</script>

	<legend> Luminosité </legend>

	<!-- Graph Luminosite -->
	<small>Relev&eacute;s pris à midi</small><br />
	<canvas id="light" width="800" height="250"></canvas>
	<?php
		$data = file_get_contents(__DIR__.'/data/history_l.txt');
		$data = explode("\n", $data);
	?>

        <script type="text/javascript">
                $(document).ready(function(){
		var lightData = {
			labels : [<?php for($i=11; $i>=0; $i--) { echo "\"" . date('d/m', strtotime('-'.$i.' day')) . "\", "; }?>],
			datasets : [
					{
					fillColor : "rgba(219,169,1,0.4)",
					strokeColor : "#FF8000",
					pointColor : "#fff",
					pointStrokeColor : "#9DB86D",
					data : [<?php for($i=0; $i<12; $i++) { echo round($data[$i]*2)/2 . ", "; } ?>]
				}
			]
		}

		var light = document.getElementById('light').getContext('2d');
		new Chart(light).Line(lightData);
		});
	</script>

	<legend> Engrais </legend>

	<!-- Graph Engrais -->
	<small>Relev&eacute;s pris à midi</small><br />
	<canvas id="engrais" width="800" height="250"></canvas>
	<?php
                $data = file_get_contents(__DIR__.'/data/history_e.txt');
                $data = explode("\n", $data);
	?>

        <script type="text/javascript">
                $(document).ready(function(){
		var engraisData = {
			labels : [<?php for($i=11; $i>=0; $i--) { echo "\"" . date('d/m', strtotime('-'.$i.' day')) . "\", "; }?>],
			datasets : [
					{
					fillColor : "rgba(172,194,132,0.4)",
					strokeColor : "#ACC26D",
					pointColor : "#fff",
					pointStrokeColor : "#9DB86D",
					data : [<?php for($i=0; $i<12; $i++) { echo round($data[$i]*2)/2 . ", "; } ?>]
				}
			]
		}

		var engrais = document.getElementById('engrais').getContext('2d');
		new Chart(engrais).Line(engraisData);
		});
	</script>

	</div>

<?php	}

	else if(isset($_['module']) && $_['module']=='flower' && isset($_['bloc']) && $_['bloc']=='actions'){
	?>
	<div class="span3 bs-docs-sidebar"><br />
	  <ul class="nav nav-tabs nav-stacked">
	    <li><a href="./index.php?module=flower&bloc=sensors"><i class="fa fa-angle-right"></i> 1. Capteurs</a></li>
	    <li><a href="./index.php?module=flower&bloc=histo"><i class="fa fa-angle-right"></i> 2. Historiques </a></li>
	    <li class="active"><a href="./index.php?module=flower&bloc=actions"><i class="fa fa-angle-right"></i> 3. Actions </a></li>
	    <li><a href="./index.php?module=flower&bloc=infos"><i class="fa fa-angle-right"></i> 4. Informations </a></li>
	    <li><a href="./index.php?module=flower&bloc=help"><i class="fa fa-angle-right"></i> 5. Aide installation </a></li>
	  </ul>
	</div>

	<div class="span9">
	<h1>Potager</h1>
	<p>Gardez un oeil sur vos plantes et fleurs!</p>

	<legend>Actions disponibles</legend>
            <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
            <th>Titre</th>
            <th>Commande</th>
            <th>Action</th>
            </tr>
            </thead>
	    <tr><td>Arrosage automatique</td></td><td><?php $potager = new Potager(); $id['id']='1'; $potager->getById($id); echo $potager->getCmdArrosage(); ?></td><td><button type="button" class="btn">Arroser</button></td></tr>
	    <tr><td>Dose d'engrais</td></td><td><?php ?></td><td><button type="button" class="btn">Ajouter</button></td></tr>
	    <tr><td>LED du Flower Power</td></td><td><?php ?></td><td><button type="button" class="btn">Basculer</button></td></tr>
	    </table>
	    <br />

	<legend>Attribution des actions</legend>
    	    <form name="cmd_form" method="POST" action="./index.php?module=flower&bloc=actions&todo=update">
	    <label for="arrosage">Commande d'arrosage</label>
	    <input type="text" name="arrosage">
	    <label for="engrais">Commande pour l'engrais</label>
	    <input type="text" name="engrais"><br />
	    <input class="btn" type="submit" value="Enregistrer"><br />
	    <small>Laissez vide si inchangé</small>
	    </form>

	<?php
	// Interpretatio des mise a jour commandes
	if(isset($_['module']) && $_['module']=='flower' && isset($_['bloc']) && $_['bloc']=='actions' && isset($_['todo']) && $_['todo']=='update'){
		$potager = new Potager();
		$id['id'] = '1';
		$potager->getById($id);

		if(isset($_POST['arrosage']) && !empty($_POST['arrosage'])) {
			//$cmd_arrosage = htmlentities($_POST['arrosage']);
			//$dataToDel['id'] = '1';
			//$flower->delete($dataToDel);
	  	        $potager->setCmdArrosage("arrosage"); //$cmd_arrosage;
			echo "<script>alert('Commande arrosage mise à jour');</script>";
		}

		if(isset($_POST['engrais']) && !empty($_POST['engrais'])) {
			//$cmd_engrais = htmlentities($_POST['engrais']);
			//$dataToDel['id'] = '2';
			//$flower->delete($dataToDel);
		        $potager->setCmdEngrais("engrais"); //$cmd_engrais;
			echo "<script>alert('Commande engrais mise à jour');</script>";
		}
		$potager->save();
	}
	?>

	</div>

<?php }

	else if(isset($_['module']) && $_['module']=='flower' && isset($_['bloc']) && $_['bloc']=='infos'){
	?>
	<div class="span3 bs-docs-sidebar"><br />
	  <ul class="nav nav-tabs nav-stacked">
	    <li><a href="./index.php?module=flower&bloc=sensors"><i class="fa fa-angle-right"></i> 1. Capteurs</a></li>
	    <li><a href="./index.php?module=flower&bloc=histo"><i class="fa fa-angle-right"></i> 2. Historiques </a></li>
	    <li><a href="./index.php?module=flower&bloc=actions"><i class="fa fa-angle-right"></i> 3. Actions </a></li>
	    <li><a class="active" href="./index.php?module=flower&bloc=infos"><i class="fa fa-angle-right"></i> 4. Informations </a></li>
	    <li><a href="./index.php?module=flower&bloc=help"><i class="fa fa-angle-right"></i> 5. Aide installation </a></li>
	  </ul>
	</div>

	<div class="span9">

	<h1>Potager</h1>
	<p>Gardez un oeil sur vos plantes et fleurs!</p>

	<legend>Informations</legend>
	    <table class="table table-striped table-bordered table-hover">
	    <thead>
	    <tr>
	    <th>Titre</th>
	    <th>Description</th>
	    </tr>
	    </thead>
	    <tr><td>Nom</td><td>Flower Power</td></tr>
	    <tr><td>Batterie</td><td>85%</td></tr>
	    <tr><td>Couleur</td><td>Marron</td></tr>
	    <tr><td>ID</td><td>HJDB-6281820</td></tr>
	    <tr><td>Numéro de série</td><td>92779372</td></tr>
	    <tr><td>Firmware ver.</td><td>3.4.8.2</td></tr>
	    <tr><td>Harware ver.</td><td>2.0.1</td></tr>
	    <tr><td>Fabricant</td><td>Parrot</td></tr>
	    </table>
	</div>
<?php }

	else if(isset($_['module']) && $_['module']=='flower' && isset($_['bloc']) && $_['bloc']=='help'){
	?>
	<div class="span3 bs-docs-sidebar"><br />
	  <ul class="nav nav-tabs nav-stacked">
	    <li><a href="./index.php?module=flower&bloc=sensors"><i class="fa fa-angle-right"></i> 1. Capteurs</a></li>
	    <li><a href="./index.php?module=flower&bloc=histo"><i class="fa fa-angle-right"></i> 2. Historiques </a></li>
	    <li><a href="./index.php?module=flower&bloc=actions"><i class="fa fa-angle-right"></i> 3. Actions </a></li>
	    <li><a href="./index.php?module=flower&bloc=infos"><i class="fa fa-angle-right"></i> 4. Informations </a></li>
	    <li class="active"><a href="./index.php?module=flower&bloc=help"><i class="fa fa-angle-right"></i> 5. Aide installation </a></li>
	  </ul>
	</div>

	<div class="span9">

	<h1>Potager</h1>
	<p>Gardez un oeil sur vos plantes et fleurs!</p>

	<legend>Aide installation</legend>
<?php }
}

Plugin::addCss("/css/style.css");
//Plugin::addJs("/js/main.js");

Plugin::addHook("menubar_pre_home", "flower_plugin_menu");
Plugin::addHook("home", "flower_plugin_page");
//Plugin::addHook("action_post_case", "flower_plugin_action");
//Plugin::addHook("vocal_command", "flower_plugin_vocal_command");
?>
