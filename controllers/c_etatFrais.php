<?php
/** @var PdoGsb $pdo */
include 'views/v_sommaire.php';
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
	case 'selectionnerMois':{
		$lesMois=$pdo->getLesMoisDisponiblesFraisHorsForfait($idVisiteur);
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste,
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("views/v_listeMois.php");
		break;
	}
	case 'voirEtatFrais':{
		$leMois = $_REQUEST['lstMois'];
		$lesMois=$pdo->getLesMoisDisponiblesFraisHorsForfait($idVisiteur);
		$moisASelectionner = $leMois;
		include("views/v_listeMois.php");
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);

		$libEtat = $lesInfosFicheFrais['libelle'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];

		//Gestion des dates
		@list($annee,$mois,$jour) = explode('-',$dateModif);
		$dateModif = "$jour"."/".$mois."/".$annee;

		//$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("views/v_etatFrais.php");
        break;
	}
	/*mission 1.a */
	case 'voirFraisMois':{
		$leMois = $_REQUEST['lstMois'];
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$moisASelectionner = $leMois;
		$frais = $pdo->getFraisForfait();
		include("views/v_fraislisteMois.php");
        break;
		
	}
	case 'voiretatFraisMois':{
		$leMois = $_REQUEST['lstMois'];
        $t = $_REQUEST['tfrais'];
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$moisASelectionner = $leMois;
		$frais = $pdo->getFraisForfait();
		include("views/v_fraislisteMois.php");
        $numAnnee =substr( $leMois,0,4);
        $numMois =substr( $leMois,4,2);
		$lesInfosFraisMois = $pdo->getInfosFraisMois($idVisiteur,$leMois,$t);
        include("views/v_fraismois.php");
        break;
		
	}

	/*mission 1.b */

    case 'FraisVisiteur':{
        $frais = $pdo->getFraisForfait();
        $visiteurs = $pdo->getVisiteur();
        include("views/v_fraisvisiteur.php");
        break;

    }
    case 'VoirFraisVisiteur':{
        $t = $_REQUEST['tfrais'];
        $id = $_REQUEST['Num'];
        $frais = $pdo->getFraisForfait();
        $visiteurs = $pdo->getVisiteur();
        include("views/v_fraisvisiteur.php");
        $lesFraisVisiteur = $pdo->getFraisVisiteur($id,$t);
        include("views/v_vuefraisvisiteur.php");
        break;

    }
		
	/*mission 1.c */

    case 'periodefrais':{
        $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
        $lesCles = array_keys( $lesMois );
        $moisASelectionner = $lesCles[0];
        include("views/v_periode.php");
        break;

    }
    case 'voirperiodefrais':{
		
        $leMois = $_REQUEST['lstMois'];
        $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
        $moisASelectionner = $leMois;
        $frais = $pdo->getFraisForfait();
        include("views/v_periode.php");
        $lesFraisPeriode = $pdo->getFraisPeriode($leMois);
        include("views/v_vueperiode.php");
        break;

    }

	/* mission 1.d */ 

	case 'periodevisiteur':{
        $visiteurs = $pdo->getVisiteur();
        include("views/v_periodevisiteur.php");
        break;

    }

	case 'vueperiodevisiteur':{
        $visiteurs = $pdo->getVisiteur();
        include("views/v_periodevisiteur.php");
		$id = $_REQUEST['Num'];
		$lesFraisPeriodeVisiteur = $pdo->getFraisVisiteurPeriode($id);
        include("views/v_vueperiodevisiteur.php");
        break;

    }


	/* mission 1.e */ 

	case 'inserervisiteur':{
		$visiteurs = $pdo->getVisiteur();
		$lemois=$pdo->getmois();
        $lannee=$pdo->getannee();
        include("views/v_inserervisiteur.php");
        break;

    }

	case 'vueinserervisiteur':{
		$visiteurs = $pdo->getVisiteur();
		$lemois=$pdo->getmois();
        $lannee=$pdo->getannee();

        include("views/v_inserervisiteur.php");

        $num=$_REQUEST['Num'];

        $mois=$_REQUEST['mois'];
        $annee=$_REQUEST['annee'];
        $datemois=$annee.$mois;
        
        $typeetape="ETP";
        $etape=$_REQUEST['etape'];
        $typekm="KM";
        $km=$_REQUEST['km'];
        $typenuit="NUI";
        $nuit=$_REQUEST['nuit'];
        $typerepas="REP";
        $repas=$_REQUEST['repas'];

        $insertetape = $pdo->insertFraisForfait($num, $datemois, $typeetape, $etape);
        $insertkm = $pdo->insertFraisForfait($num, $datemois, $typekm, $km);
        $insertnuit = $pdo->insertFraisForfait($num, $datemois, $typenuit, $nuit);
        $insertrepas = $pdo->insertFraisForfait($num, $datemois, $typerepas, $repas);
 
        $total = $insertetape + $insertkm + $insertnuit + $insertrepas;
        include("views/v_vueinserervisiteur.php");

        break;

    }



}
