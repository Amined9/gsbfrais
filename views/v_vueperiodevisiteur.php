<h3> Fiche de frais du Visiteur : <?php echo $id; ?> </h3>
<div class="encadre">
    <p>

    </p>

    <table class="listeLegere">
        <caption>Descriptif des frais par Visiteur</caption>
        <tr>
            <th class="date">Mois</th>
            <th class="date">ETP</th>
            <th class="libelle">KM</th>
            <th class='montant'>NUI</th>
            <th class='montant'>REP</th>
        </tr>

        <?php foreach ($lesFraisPeriodeVisiteur as $periodevisiteur): ?>
            <tr>
                <td><?= $periodevisiteur['mois'] ?></td>
                <td><?= $periodevisiteur['ETP'] ?></td>
                <td><?= $periodevisiteur['KM'] ?></td>
                <td><?= $periodevisiteur['NUI'] ?></td>
                <td><?= $periodevisiteur['REP'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>