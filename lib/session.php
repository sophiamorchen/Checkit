<?php
// Définit les paramètres du cookie de session avant d'appeler session_start()
// IMPORTANT : les clés sont sensibles à la forme — pas de '/' dans le domain, le point en tête est pour les sous-domaines.
session_set_cookie_params([
    // Durée de vie du cookie en secondes.
    // Ici : 3600 = 1 heure. Après 1h le cookie expirera côté navigateur.
    'lifetime' => 3600,

    // Chemin sur le serveur où le cookie sera disponible.
    // '/' signifie "toute l'application" — le cookie est envoyé pour toutes les URLs du domaine.
    'path' => '/',

    // Domaine pour lequel le cookie est valide.
    // '.checkit.local' signifie : checkit.local ET tous ses sous-domaines (admin.checkit.local, api.checkit.local, etc.).
    // CORRECTION : on **NE** met **pas** de slash à la fin. Pas d'espace non plus.
    'domain' => '.checkit.local',

    // httpOnly empêche l'accès au cookie depuis JavaScript (document.cookie).
    // C'est une protection contre le vol de cookie par XSS.
    'httpOnly' => true,

    // secure indique que le cookie ne doit être envoyé QUE sur des connexions HTTPS.
    // En local sans HTTPS, mettre secure => false (ou l'omettre). En production, mettre true.
    // Ici on ne l'ajoute pas pour rester compatible avec un environnement local non-HTTPS.
    // 'secure' => true,

    // Option recommandée : SameSite contrôle l'envoi du cookie lors des requêtes cross-site.
    // - 'Lax' : cookie envoyé pour navigations de niveau "safe" (GET navigations top-level) — bon compromis.
    // - 'Strict' : cookie **jamais** envoyé pour les requêtes cross-site — le plus strict.
    // - 'None' : autorise cross-site **mais** nécessite secure => true (sinon rejeté).
    // On peut ajouter : 'samesite' => 'Lax'
    // 'samesite' => 'Lax'
]);

// Démarre la session PHP (en envoiant éventuellement l'entête Set-Cookie si la session n'existe pas encore).
session_start();
