<h3>Fiche de frais du Visiteur : <?php echo $id; ?> </h3>
<div class="encadre">
    <p>

    </p>

    <table class="listeLegere">
        <caption>Descriptif des frais par mois</caption>
        <tr>
            <th class="date">Visiteur</th>
            <th class="date">Mois</th>
            <th class="libelle">idFraisForfait</th>
            <th class='montant'>Montant</th>
        </tr>

        <?php foreach ($lesFraisVisiteur as $fraisvisiteur): ?>
            <tr>
                <td><?= $fraisvisiteur['idVisiteur'] ?></td>
                <td><?= $fraisvisiteur['mois'] ?></td>
                <td><?= $fraisvisiteur['idFraisForfait'] ?></td>
                <td><?= $fraisvisiteur['prix'] ?>€</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

