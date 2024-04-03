<div class="flex flex-col w-6/8 p-8 space-y-6">
    <div class="text-center text-2xl">Periode</div>
    <div class="text-center">
        <form action="index.php?uc=etatFrais&action=voirperiodefrais" method="post">
            <div>
                <p>
                <label for="lstMois" accesskey="n">Mois/Annee: </label>
                <select id="lstMois" name="lstMois">
                    <?php
                    foreach ($lesMois as $unMois)
                    {
                        $mois = $unMois['mois'];
                        $numAnnee =  $unMois['numAnnee'];
                        $numMois =  $unMois['numMois'];
                        if($mois == $moisASelectionner){
                            ?>
                            <option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                            <?php
                        }
                        else{ ?>
                            <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                            <?php
                        }
                    }?>
                    </select>
                </p>
            </div>
            <div>
                <p>
                    <!--<input id="ok" type="submit" value="Valider" size="20" leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200/>-->
                    <button
                    type="submit"
                    class="inline-block rounded bg-info px-6 pb-2 pt-2.5 ">
                    Valider
                    </button>
                </p>
            </div>
        </form>    
    </div>
    