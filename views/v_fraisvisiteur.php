<div id="contenu">
    <form action="index.php?uc=etatFrais&action=VoirFraisVisiteur" method="post">
        <div class="corpsForm">
            <h2>Visiteur</h2>
            <p>
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

                <label for="tfrais" accesskey="n">Type de frais: </label>
                <select id="tfrais" name="tfrais">
                    <?php
                    foreach ($frais as $unfrai)
                    {?>
                        <option value="<?php echo $unfrai['id'] ?>"><?= $unfrai['id'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
            </p>
        </div>

    </form>