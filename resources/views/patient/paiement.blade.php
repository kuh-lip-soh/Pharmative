<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<div id="page" class="page-home">
    <section id="header">
        <div class="branding"><a href="index.html">Pharmative</a></div>
        <div>
            <ul id="navbar">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="Médicament.html">Médicaments</a></li>
                <li><a href="Materiel.html">Materiels</a></li>
                <li><a href="Espace Bébé.html">Espace_Bébé</a></li>
                <li><a href="Contact.html">Conseils</a></li>
                <li><a href="#0" trigger-button data-target="search-float"><i class="ri-search-line"></i></a></li>
                <li><a href="panier.html"><i class="ri-shopping-bag-line"></i></a></li>
                <li><a href="profil.html"><i class="ri-user-line"></i></a></li>
            </ul>
            <div id="search-float" class="search-float">
                <div class="container wide">
                    <form action="" class="search">
                        <i class="ri-search-line"></i>
                        <input type="search" class="input" id="" placeholder="Rechercher.....">
                        <i class="ri-close-line" close-button></i>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="page-header3">
        <h3 class="title">Entrez votre carte </h3>

    </section>

    <div id="ccp" class="section-p1">
        <div class="form-group">
            <label for="card-number">Numéro de carte de crédit:</label>
            <input type="text" id="card-number" name="card-number" required>
        </div>
        <div class="form-group">
            <label for="card-expiry">Date d'expiration:</label>
            <input type="text" id="card-expiry" name="card-expiry" placeholder="MM/AA" required>
        </div>

        <div class="form-group">
            <label for="card-cvc">Code de sécurité:</label>
            <input type="text" id="card-cvc" name="card-cvc" required>
        </div>

        <input type="submit" value="Valider le paiement">
    </div>


    <footer class="section-p1">
        <div class="col">
            <h4>Contact</h4>
            <p><strong>Address: </strong> 244 les Dahlias, Tlemcen 13000.</p>
            <p><strong>Téléphone:</strong> 0567847433 / 0743927132.</p>
            <p><strong>Email: </strong>Pharmative2023@gmail.com.</p>
            <p><strong>Heures</strong> 10:00 - 18:00, Tous Les Jours.</p>
        </div>

        <div class="col">
            <h4>Lien Rapides</h4>
            <a href="index.html">Accueil</a>
            <a href="Médicament.html">Médicaments</a>
            <a href="Materiel.html">Materiels</a>
            <a href="Espace Bébé.html">Espace_Bébé</a>
            <a href="Contact.html">Nos conseils santé</a>
            <a href="profil.html">Votre profil</a>
        </div>

        <div class="install">
            <p>Passerelle de paiement sécurisée</p>
            <img src="photos/algerie-poste9001.logowik.com.jpeg" alt="">
        </div>
    </footer>
    <div class="overlay" data-overlay></div>
    <script src="home.js"></script>
    </body>

</html>