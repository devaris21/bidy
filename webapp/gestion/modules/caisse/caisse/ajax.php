<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);


if ($action == "filtrer") {
	$rooter = new ROOTER();
	$params = PARAMS::findLastId();
	$operations = OPERATION::findBy(["DATE(created) >= "=> dateAjoute(intval($jour))]);
	foreach ($operations as $key => $operation) {
		$operation->actualise(); ?>
		<tr>
			<td style="background-color: rgba(<?= hex2rgb($operation->categorieoperation->color) ?>, 0.6);" width="15"><a target="_blank" href="<?= $rooter->url("gestion", "fiches", "boncaisse", $operation->getId())  ?>"><i class="fa fa-file-text-o fa-2x"></i></a></td>
			<td>
				<h6 style="margin-bottom: 3px" class="mp0 text-uppercase gras <?= ($operation->categorieoperation->typeoperationcaisse_id == TYPEOPERATIONCAISSE::ENTREE)?"text-green":"text-red" ?>"><?= $operation->categorieoperation->name() ?> <span><?= ($operation->etat_id == ETAT::ENCOURS)?"*":"" ?></span> <span class="pull-right"><i class="fa fa-clock-o"></i> <?= datelong($operation->created) ?></span></h6>
				<i><?= $operation->comment ?></i>
			</td>
			<td width="110" class="text-center" style="padding: 0; border-right: 2px dashed grey">
				<?php if ($operation->etat_id == ETAT::ENCOURS) { ?>
					<button onclick="valider(<?= $operation->getId() ?>)" class="cursor simple_tag"><i class="fa fa-file-text-o"></i> Valider</button><span style="display: none">en attente</span>
				<?php } ?>
				<br><small style="display: inline-block; font-style: 8px; line-height: 12px;"><?= $operation->structure ?> - <?= $operation->numero ?></small>
			</td>
			<?php if ($operation->categorieoperation->typeoperationcaisse_id == TYPEOPERATIONCAISSE::ENTREE) { ?>
				<td class="text-center text-green gras" style="padding-top: 12px;">
					<?= money($operation->montant) ?> <?= $params->devise ?>
				</td>
				<td class="text-center"> - </td>
			<?php }elseif ($operation->categorieoperation->typeoperationcaisse_id == TYPEOPERATIONCAISSE::SORTIE) { ?>
				<td class="text-center"> - </td>
				<td class="text-center text-red gras" style="padding-top: 12px;">
					<?= money($operation->montant) ?> <?= $params->devise ?>
				</td>
			<?php } ?>
			<td class="text-center gras" style="padding-top: 12px; background-color: #fafafa"><?= money($operation->montant) ?> <?= $params->devise ?></td>
		</tr>
	<?php } ?>
	<tr>
		<td style="border-right: 2px dashed grey" colspan="3"><h4 class="text-uppercase mp0 text-right">Solde du compte au <?= datecourt(dateAjoute()) ?></h4></td>
		<td><h4 class="text-center"><?= money(OPERATION::entree(PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
		<td><h4 class="text-center"><?= money(OPERATION::sortie(PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h4></td>
		<td style="background-color: #fafafa"><h3 class="text-center text-blue gras"><?= money(OPERATION::resultat(PARAMS::DATE_DEFAULT , dateAjoute(1))) ?> <?= $params->devise ?></h3></td>
	</tr>
	<?php 
}



if ($action == "valider") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = OPERATION::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$operation = $datas[0];
				$data = $operation->valider();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
			}
		}else{
			$data->status = false;
			$data->message = "Votre mot de passe ne correspond pas !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas effectué cette opération !";
	}
	echo json_encode($data);
}



?>