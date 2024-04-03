<div id="contenu">
    <form action="index.php?uc=etatFrais&action=vueinserervisiteur" method="post">
        <div class="corpsForm">
            <h2>Saisie Frais au forfait</h2>
                <h4>Visiteur</h4>
                <label for="Num" accesskey="n">Numero: </label>
                <select id="Num" name="Num">
                    <?php
                    foreach ($visiteurs as $unvisiteur)
                    {?>
                        <option value="<?php echo $unvisiteur['id'] ?>"><?= $unvisiteur['id'] ?></option>
                        <?php

                    }

                    ?>
                </select>

                <h4>Periode D'engagement</h4>

                <label for="mois" accesskey="n">Mois: </label>
                <select id="mois" name="mois">
                    <?php
                    foreach ($lemois as $mois)
                    {?>
                        <option value="<?php echo $mois['mois'] ?>"><?= $mois['mois'] ?></option>
                        <?php

                    }
                    ?>
                </select>

                <label for="annee" accesskey="n">Annee: </label>
                <select id="mois" name="annee">
                    <?php
                     foreach ($lannee as $annee)
                     {?>
                         <option value="<?php echo  $annee['annee'] ?>"><?=  $annee['annee'] ?></option>
                         <?php
 
                     }
                    ?>
                </select>
                <br>    
            <h2>Frais au forfait</h2>
            <br>        
            <label for="repas" accesskey="n">Repas midi: </label>
            <input type="text" name="repas" id="repas">
            <br>        
            <label for="nuit" accesskey="n">Nuites:      </label>
            <input type="text" name="nuit" id="nuit">
            <br>        
            <label for="etape" accesskey="n">Etape:      </label>
            <input type="text" name="etape" id="etape">
            <br>        
            <label for="km" accesskey="n">Km:       </label>
            <input type="text" name="km" id="km">


            
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
            </p>
        </div>

    </form>