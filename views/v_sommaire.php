<!-- Division pour le sommaire -->
<div class="bg-blue-500 w-2/8 h-screen p-4">
          <!-- Navigation links -->
    <div><img src="./images/logo-preview.png" alt="GSB"></div>
    <nav class="text-white">
    <h2 class="text-2xl font-semibold mb-4">Navigation</h2>
    <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?>
    <ul class="p-2">
        <li class="mb-2">
        <a href="#" class="hover:underline">Acceuil</a>
        </li>
        <li class="mb-2">
        <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais" class="hover:underline">Fiches de frais</a>
        </li>
        <li class="mb-2">
        <a href="index.php?uc=etatFrais&action=voirFraisMois" title="Consultation de mes fiches de frais par mois" class="hover:underline">Frais par mois</a>
        </li>
        <li class="mb-2">
        <a href="index.php?uc=etatFrais&action=FraisVisiteur" title="Consultation des fiches de frais par visiteur" class="hover:underline">Frais par visiteur</a>
        </li>
        <li class="mb-2">
        <a href="index.php?uc=etatFrais&action=periodefrais" title="Consultation des fiches de frais par periode" class="hover:underline">Frais par periode</a>
        </li>
        <li class="mb-2">
        <a href="index.php?uc=etatFrais&action=periodevisiteur" title="Consultation des fiches par periode et visiteur" class="hover:underline">Periode visiteur</a>
        </li>
        <li class="mb-2">
        <a href="index.php?uc=etatFrais&action=inserervisiteur" title="Insertion des visiteur" class="hover:underline">Modifier visiteur</a>
        </li>
        <li class="mb-2">
        <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter" class="hover:underline">Déconnexion</a>
        </li>
    </ul>
    </nav>
</div>

<!-- Navigation links 
<nav class="bg-gradient-to-l hover:bg-gradient-to-r">>
    <ul class="menu-ul">
        <li class="menu-item"><a href="index.php">retour</a></li>

        <li class="menu-item">
            Visiteur :<br>
            <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">
                Mes fiches de frais
            </a>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=etatFrais&action=voirFraisMois" title="Consultation de mes fiches de frais par mois">
                Frais par mois
            </a>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=etatFrais&action=FraisVisiteur" title="Consultation des fiches de frais par visiteur">
                Frais par visiteur
            </a>
        </li>

        <li class="menu-item">
            <a href="index.php?uc=etatFrais&action=periodefrais" title="Consultation des fiches de frais par periode">
                Frais par periode
            </a>
        </li>

        <li class="menu-item">
            <a href="index.php?uc=etatFrais&action=periodevisiteur" title="Consultation des fiches par periode et visiteur">
                Periode visiteur
            </a>
        </li>

        <li class="menu-item">
            <a href="index.php?uc=etatFrais&action=inserervisiteur" title="Insertion des visiteur">
                Inserer visiteur
            </a>
        </li>

        <li class="menu-item">
            <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
        </li>
    </ul>
</nav>-->
<section class="content">



