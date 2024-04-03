<?php
/**
 * Classe d'accès aux données.

 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe

 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbfrais';
      	private static $user='root' ;
      	private static $mdp='' ;
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     * @return null L'unique objet de la classe PdoGsb
     */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;
	}

    /**
     * Retourne les informations d'un visiteur
     * @param $login
     * @param $mdp
     * @return mixed L'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosVisiteur($login, $mdp){
        $req = "select id, nom, prenom from visiteur where login='$login' and mdp='$mdp'";
        $rs = PdoGsb::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }

    /**
     * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
     
    * @param $madate au format  jj/mm/aaaa
    * @return la date au format anglais aaaa-mm-jj
    */
    public function dateAnglaisVersFrancais($maDate){
        @list($annee,$mois,$jour)=explode('-',$maDate);
        $date="$jour"."/".$mois."/".$annee;
        return $date;
    }

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
     * concernées par les deux arguments
     * La boucle foreach ne peut être utilisée ici, car on procède
     * à une modification de la structure itérée - transformation du champ date-
     * @param $idVisiteur
     * @param $mois 'sous la forme aaaamm
     * @return array 'Tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
     */

    /* Mission 1.a */
    public function getFraisForfait(){
        $req = "select id from fraisforfait";
        $res = PdoGsb::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }


    /**
     * Retourne les mois pour lesquels, un visiteur a une fiche de frais
     * @param $idVisiteur
     * @return array 'Un tableau associatif de clé un mois - aaaamm - et de valeurs l'année et le mois correspondant
     */
    public function getLesMoisDisponibles($idVisiteur){
        $req = "select mois from  fichefrais where idvisiteur ='$idVisiteur' order by mois desc ";
        $res = PdoGsb::$monPdo->query($req);
        $lesMois =array();
        $laLigne = $res->fetch();
        while($laLigne != null)	{
            $mois = $laLigne['mois'];
            $numAnnee =substr( $mois,0,4);
            $numMois =substr( $mois,4,2);
            $lesMois["$mois"]=array(
                "mois"=>"$mois",
                "numAnnee"  => "$numAnnee",
                "numMois"  => "$numMois"
            );
            $laLigne = $res->fetch();
        }
        return $lesMois;
    }


    public function getLesFraisHorsForfait($idVisiteur,$mois){
        $req = "select * 
                from lignefraishorsforfait 
                where idvisiteur ='$idVisiteur' and mois = '$mois' ";
        $res = PdoGsb::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        $nbLignes = count($lesLignes);
        for ($i=0; $i<$nbLignes; $i++){
            $date = $lesLignes[$i]['date'];
            //Gestion des dates
            @list($annee,$mois,$jour) = explode('-',$date);
            $dateStr = "$jour"."/".$mois."/".$annee;
            $lesLignes[$i]['date'] = $dateStr;
        }
        return $lesLignes;
    }
    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donn�
     * @param $idVisiteur
     * @param $mois 'sous la forme aaaamm
     * @return mixed 'Un tableau avec des champs de jointure entre une fiche de frais et la ligne d'�tat
     */
    public function getLesInfosFicheFrais($idVisiteur,$mois){
        $req = "SELECT libelle, lignefraishorsforfait.mois as mois ,
                montantValide, fichefrais.idVisiteur as idVisiteur ,
                fichefrais.dateModif as dateModif , 
                fichefrais.nbJustificatifs as nbJustificatifs ,
                fichefrais.idEtat as idEtat 
                FROM lignefraishorsforfait 
                INNER JOIN fichefrais 
                ON lignefraishorsforfait.idVisiteur = fichefrais.idVisiteur
			    where fichefrais.idVisiteur ='$idVisiteur' and lignefraishorsforfait.mois = '$mois'";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetch();
        return $laLigne;
    }

    public function getLesMoisDisponiblesFraisHorsForfait($idVisiteur){
        $req = "select mois from lignefraishorsforfait where idvisiteur ='$idVisiteur' order by mois desc ";
        $res = PdoGsb::$monPdo->query($req);
        $lesMois =array();
        $laLigne = $res->fetch();
        while($laLigne != null)	{
            $mois = $laLigne['mois'];
            $numAnnee =substr( $mois,0,4);
            $numMois =substr( $mois,4,2);
            $lesMois["$mois"]=array(
                "mois"=>"$mois",
                "numAnnee"  => "$numAnnee",
                "numMois"  => "$numMois"
            );
            $laLigne = $res->fetch();
        }
        return $lesMois;
    }
    /* Mission 1.a */
    public function getInfosFraisMois($idVisiteur,$mois,$t){
        $req = "SELECT idVisiteur, mois, idFraisForfait, (quantite*montant) as prix 
                FROM `lignefraisforfait` 
                INNER JOIN fraisforfait 
                ON lignefraisforfait.idFraisForfait = fraisforfait.id 
                WHERE idVisiteur='$idVisiteur' and mois='$mois' and idFraisForfait='$t' ";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }


    /* Mission 1.b */

    public function getVisiteur(){
        $req = "select id from visiteur";
        $res = PdoGsb::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    public function getFraisVisiteur($idVisiteur,$t){
        $req = "SELECT idVisiteur, mois, idFraisForfait, (quantite*montant) as prix 
                FROM `lignefraisforfait` 
                INNER JOIN fraisforfait 
                ON lignefraisforfait.idFraisForfait = fraisforfait.id 
                WHERE idVisiteur='$idVisiteur'and idFraisForfait='$t' ";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    /* Mission 1.c */

    public function getFraisPeriode($mois){
        $req = "SELECT idVisiteur,
        SUM((CASE WHEN idFraisForfait = 'ETP' then (lff.quantite*ff.montant) END )) as 'ETP',
        SUM((CASE WHEN idFraisForfait = 'KM'  then (lff.quantite*ff.montant) END )) as 'KM',
        SUM((CASE WHEN idFraisForfait = 'NUI' then (lff.quantite*ff.montant) END )) as 'NUI',
        SUM((CASE WHEN idFraisForfait = 'REP' then (lff.quantite*ff.montant) END )) as 'REP' 
        FROM lignefraisforfait lff
        INNER JOIN fraisforfait ff ON ff.id = lff.idFraisForfait 
        WHERE mois='$mois'
        GROUP BY idVisiteur ";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return $laLigne;

        /*
        SELECT fraisforfait.montant*SUM(lignefraisforfait.quantite) AS ETP  FROM `fraisforfait` 
        INNER JOIN lignefraisforfait 
        ON fraisforfait.id = lignefraisforfait.idFraisForfait
        */
    }

    /* Mission 1.d */

    public function getFraisVisiteurPeriode($id){
        $req = "SELECT mois ,
        SUM((CASE WHEN idFraisForfait = 'ETP' then (lff.quantite*ff.montant) END )) as 'ETP',
        SUM((CASE WHEN idFraisForfait = 'KM'  then (lff.quantite*ff.montant) END )) as 'KM',
        SUM((CASE WHEN idFraisForfait = 'NUI' then (lff.quantite*ff.montant) END )) as 'NUI',
        SUM((CASE WHEN idFraisForfait = 'REP' then (lff.quantite*ff.montant) END )) as 'REP' 
        FROM lignefraisforfait lff
        INNER JOIN fraisforfait ff ON ff.id = lff.idFraisForfait 
        WHERE idVisiteur='$id'
        GROUP BY mois "; 
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    /* Mission 1.e */


    public function insertFraisForfait($num, $anneemois, $idforfait, $quantite){
        
        $req = "UPDATE `lignefraisforfait` SET quantite= ? WHERE idVisiteur= ? AND idFraisForfait= ? AND mois= ?";
        $stmt= PdoGsb::$monPdo->prepare($req);
        $count = $stmt->execute([$quantite, $num, $idforfait ,$anneemois]);
        return $count;
    }

    public function getannee(){
        $req = "select DISTINCT(left(mois, 4)) as annee from fichefrais";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return  $laLigne ;
    }

    public function getmois(){
        $req = "select DISTINCT(RIGHT(mois, 2)) as mois from fichefrais ORDER BY mois ASC";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return  $laLigne ;
    }
}

