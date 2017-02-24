<div id="box1">
	<div class="input-group input-group-filtre">
		<div class="input-group-addon input-group-addon-filtre"><img src="../ressources/images/website/icon-danse-transparent.png" alt="icon danse" style="width:16px;height:16px;"></div>
		<select name="communaute_rechercher_lieu" id="communaute_rechercher_lieu" class="form-control form-control-filtre" onchange="filtrerCommunaute(this)" required>
			<option value="" id="titreDanse" <?php if(isset($_SESSION['communaute_rechercher_lieu'])){if($_SESSION['communaute_rechercher_lieu']=="default" ){echo 'selected="selected"';}};?> disabled>- Type de danse -</option>
			<option value="Latino" <?php if(isset($_SESSION['communaute_rechercher_lieu'])){if($_SESSION['communaute_rechercher_lieu']=="Latino" ){echo 'selected="selected"';}};?>>Salsa-Bachata-Kizomba</option>
			<option value="Tango" <?php if(isset($_SESSION['communaute_rechercher_lieu'])){if($_SESSION['communaute_rechercher_lieu']=="Tango" ){echo 'selected="selected"';}};?>>Tango Argentin</option>
			<option value="Swing" <?php if(isset($_SESSION['communaute_rechercher_lieu'])){if($_SESSION['communaute_rechercher_lieu']=="Swing" ){echo 'selected="selected"';}};?>>Swing-WCS</option>
			<option value="Rock" <?php if(isset($_SESSION['communaute_rechercher_lieu'])){if($_SESSION['communaute_rechercher_lieu']=="Rock" ){echo 'selected="selected"';}};?>>Rock</option>
			<option value="Salon" <?php if(isset($_SESSION['communaute_rechercher_lieu'])){if($_SESSION['communaute_rechercher_lieu']=="Salon" ){echo 'selected="selected"';}};?>>Danses de Salon</option>
		</select>
	</div>
</div>