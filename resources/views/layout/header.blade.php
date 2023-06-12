<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

@include('layout.search')

<script>
    $(document).ready(function () {
        function getPanierCount() {
            $.ajax({
                url: "{{ route('panier.count') }}",
                type: "GET",
                success: function (data) {
                    $("#panier-count").text(data.count);
                }
            });
        }
        getPanierCount();
    });
</script>

<div id="page" class="page-home">
    <section id="header">
        <div class="branding"><a href="{{route('/')}}">Pharmative</a></div>
        <div>
            <ul id="navbar">
                <li><a href="{{route('/')}}">Accueil</a></li>
                <li><a href="{{route('medicament')}}">Médicaments</a></li>
                <li><a href="{{route('materiel')}}">Materiels</a></li>
                <li><a href="{{route('espacebebe')}}">Espace Bébé</a></li>
                <li>
                    <a href="#0" trigger-button data-target="search-float"><i class="ri-search-line"></i></a>
                </li>
                <li>
                    <a href="{{route('panier')}}">
                        <i class="ri-shopping-bag-line"></i>
                        <span id="panier-count"></span>
                    </a>
                </li>
                @guest
                <li><a href="{{route('patient.login')}}">Se connecter <i class="ri-user-line"></i></a></li>
                @else
                <li><a href="{{ route('patient.profile') }}">Profil</a>
                <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se
                        déconnecter <i class="ri-user-line"></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
            <div id="search-float" class="search-float">
                <div class="container wide">
                    <form action="" class="search-form">
                        <i class="ri-search-line"></i>
                        <input type="search" class="input" id="searchInput" placeholder="Rechercher.....">
                        <i class="ri-close-line" close-button></i>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <title>Pharmative</title>


    
@yield('content')



    <footer class="section-p1">
        <div class="col">
            <h4>Contact</h4>
            <p><strong>Address: </strong> 244 les Dahlias, Tlemcen 13000.</p>
            <p><strong>Téléphone:</strong> 0567847433 / 0743927132.</p>
            <p><strong>Email: </strong>Pharmative2023@gmail.com.</p>
            <p><strong>Horaires:</strong> 10:00 - 18:00, Tous Les Jours.</p>
        </div>

        <div class="col">
            <h4>Lien Rapides</h4>
            <a href="{{route('/')}}">Accueil</a>
            <a href="{{route('medicament')}}">Médicaments</a>
            <a href="{{route('materiel')}}">Materiels</a>
            <a href="{{route('espacebebe')}}">Espace Bébé</a>
            @guest
            @else
            <li><a href="{{ route('patient.profile') }}">Profil</a>
                @endguest
        </div>
        <div class="install">
            <p>Passerelle de paiement sécurisée</p>
            <img src="{{ asset('images/ccp.jpeg') }}" alt="">
        </div>
    </footer>
</div>
<div class="overlay" id="overlay" data-overlay></div>
<script type="text/javascript" src="{{url('js/home.js')}}"></script>
</body>

</html>