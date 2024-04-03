<div id="contenu">
      <form action="index.php?uc=etatFrais&action=voiretatFraisMois" method="post">
      <div class="corpsForm">
      <h2>Periode</h2>
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