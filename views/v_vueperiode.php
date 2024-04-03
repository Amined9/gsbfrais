
    <div class="overflow-auto rounded-lg">
        <table class="w-full table-fixed">
            <caption class="caption-top"><h3> Fiche de frais du Mois : <?php echo $leMois; ?> </h3></caption>
            <thead class="bg-gray-50 border-b-2 border-gray-200 ">
            <tr class="border-b dark:border-neutral-500">
                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Visiteur</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">ETP</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">KM</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">NUI</th>
                <th class="p-3 text-sm font-semibold tracking-wide text-left">REP</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($lesFraisPeriode as $fraisperiode): ?>
                <tr class="bg-grey border-b">
                    <td class="p-3 text-sm text-gray-700"><?= $fraisperiode['idVisiteur'] ?></td>
                    <td class="p-3 text-sm text-gray-700"><?= $fraisperiode['ETP'] ?></td>
                    <td class="p-3 text-sm text-gray-700"><?= $fraisperiode['KM'] ?></td>
                    <td class="p-3 text-sm text-gray-700"><?= $fraisperiode['NUI'] ?></td>
                    <td class="p-3 text-sm text-gray-700"><?= $fraisperiode['REP'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>          
</div>
