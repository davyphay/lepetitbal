<?php
	function put_cours_hebdoBdd($id_lieu_value,$tableForm_cours_hebdo_value,$tableDisplay_cours_hebdo_value)
	{
        global $bdd;

		$req = $bdd -> prepare('REPLACE INTO cours_hebdomadaire (id_lieu_cours_hebdomadaire,tableForm_cours_hebdomadaire,tableDisplay_cours_hebdomadaire) VALUES (:id_lieu_value,:tableForm_cours_hebdo_value,:tableDisplay_cours_hebdo_value)');
        $req->execute(array(
			'id_lieu_value' => $id_lieu_value,
			'tableForm_cours_hebdo_value' => $tableForm_cours_hebdo_value,
			'tableDisplay_cours_hebdo_value' => $tableDisplay_cours_hebdo_value
            ));
        $req->closeCursor();
	}
   
	function put_soiree_hebdoBdd($id_lieu_value,$tableForm_soiree_hebdo_value,$tableDisplay_soiree_hebdo_value)
    {
        global $bdd;

		$req = $bdd -> prepare('REPLACE INTO soiree_hebdomadaire (id_lieu_soiree_hebdomadaire,tableForm_soiree_hebdomadaire,tableDisplay_soiree_hebdomadaire) VALUES (:id_lieu_value,:tableForm_soiree_hebdo_value,:tableDisplay_soiree_hebdo_value)');
        $req->execute(array(
			'id_lieu_value' => $id_lieu_value,
			'tableForm_soiree_hebdo_value' => $tableForm_soiree_hebdo_value,
			'tableDisplay_soiree_hebdo_value' => $tableDisplay_soiree_hebdo_value
            ));
        $req->closeCursor();
   }

?>
