
<?php //include($this->rootPath("webapp/gestion/elements/templates/aside.php")); ?> 


<div id="small-chat">
	<span class="badge badge-warning float-right">5</span>
	<a class="open-small-chat" href="">
		<i class="fa fa-comments"></i>
	</a>
</div>

<?php //include($this->rootPath("webapp/gestion/elements/templates/chat.php")); ?> 

<div class="footer">
	<div class="float-right">
		Copyright &copy; 2019-2020 | <strong>DEVARIS 21</strong>.
	</div>
	<div>
		<strong class="text-uppercase"><?= $params->societe  ?></strong>
	</div>
</div>

<!-- Le loader est placé dans le fichier head.php -->


<?php include($this->rootPath("composants/assets/modals/modal-productionjour.php") );  ?>