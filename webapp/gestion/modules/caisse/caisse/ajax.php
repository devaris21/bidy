<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);


if ($action == "filtrer") {
	$params = PARAMS::findLastId();
	$operations = OPERATION::findBy(["DATE(created) >= "=> dateAjoute(intval($jour))]);
	foreach ($operations as $key => $operation) {
		$operation->actualise(); ?>
		<tr>
			<td width="15"><i class="fa fa-clock-o"></i></td>
			<td><?= datelong($operation->created) ?></td>
			<td width="15"><i class="fa fa-file-text"></i></td>
			<td><?= $operation->categorieoperation->name() ?> <span>*</span></td>
			<?php if ($operation->categorieoperation->typeoperationcaisse_id == TYPEOPERATIONCAISSE::ENTREE) { ?>
				<td class="text-center text-green"><?= money($operation->montant) ?> <?= $params->devise ?></td>
				<td class="text-center"> - </td>
			<?php }elseif ($operation->categorieoperation->typeoperationcaisse_id == TYPEOPERATIONCAISSE::SORTIE) { ?>
				<td class="text-center"> - </td>
				<td class="text-center text-red"><?= money($operation->montant) ?> <?= $params->devise ?></td>
			<?php } ?>
			<td class="text-center gras"><?= money($operation->montant) ?> <?= $params->devise ?></td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="4"><h4 class="text-uppercase mp0 text-right">Solde du compte au <?= datecourt(dateAjoute()) ?></h4></td>
		<td><h4 class="text-center"><?= money(OPERATION::entree(PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
		<td><h4 class="text-center"><?= money(OPERATION::sortie(PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
		<td><h4 class="text-center"><?= money(OPERATION::resultat(PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
	</tr>
	<?php 
}






?>