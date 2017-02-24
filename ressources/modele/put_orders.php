<?php
   function put_orders($user_email,$type_produit,$nb_jeton_produit,$prix_produit_unitaire,$quantity,$prix_total,$nb_jetons_total,$data)
    {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO `orders`(`adresse_email_orders`,`type_produit_orders`,`nb_jeton_produit_orders`,`prix_produit_unitaire_orders`,`quantity_orders`,`prix_total_orders`,`nb_jetons_total_orders`,`date_orders`,`datas_orders`) VALUES (:adresse_email_orders, :type_produit_orders, :nb_jeton_produit_orders, :prix_produit_unitaire_orders, :quantity_orders, :prix_total_orders,:nb_jetons_total_orders,NOW(),:datas_orders)');
        $req->execute(array(
			'adresse_email_orders' => $user_email,
			'type_produit_orders' => $type_produit,
			'nb_jeton_produit_orders' => $nb_jeton_produit,
			'prix_produit_unitaire_orders' => $prix_produit_unitaire,
			'quantity_orders' => $quantity,
			'prix_total_orders' => $prix_total,
			'nb_jetons_total_orders' => $nb_jetons_total,
			'datas_orders' => $data
            ));
        $req->closeCursor();
   }
?>
