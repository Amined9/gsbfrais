    <h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : </h3>
    <div class="encadre">
        <p>

        </p>
  	
        <table class="listeLegere">
           <caption>Descriptif des frais par mois</caption>
                 <tr>
                    <th class="date">Visiteur</th>
                    <th class="libelle">idFraisForfait</th>
                    <th class='montant'>Montant</th>
                 </tr>

                <?php foreach ($lesInfosFraisMois as $fraisMois): ?>
                    <tr>
                        <td><?= $fraisMois['idVisiteur'] ?></td>
                        <td><?= $fraisMois['idFraisForfait'] ?></td>
                        <td><?= $fraisMois['prix'] ?>€</td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>

 













