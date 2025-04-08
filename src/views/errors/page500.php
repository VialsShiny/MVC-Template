<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Erreur 500 - Problème Serveur</title>
    <link rel="shortcut icon" href="/public/img/favicon.ico" type="image/x-icon">
    <style>
        @keyframes gradient-flow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #ffb300, rgb(0, 0, 0), rgb(31, 31, 31), rgb(255, 166, 49));
            background-size: 400% 400%;
            animation: gradient-flow 15s ease infinite;
        }
    </style>
</head>

<body class="animated-gradient min-h-screen flex items-center justify-center text-white">

    <div class="text-center">
        <div class="text-6xl font-extrabold text-orange-600">500</div>
        <p class="text-xl mt-4 font-light">Veuillez vous adresser au développeur pour résoudre ce problème. Ne pas
            actualiser la page et prenez une capture d'écran.</p>
        <a href="/"
            class="inline-block mt-6 px-6 py-2 text-lg bg-orange-600 text-white rounded hover:bg-orange-700 transition">Retour
            à l'accueil</a>
    </div>
</body>

</html>