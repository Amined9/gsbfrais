<div id="contenu">
    <form action="index.php?uc=etatFrais&action=vueperiodevisiteur" method="post">
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

            </p>
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
            </p>
        </div>

    </form>