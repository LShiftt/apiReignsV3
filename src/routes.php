<?php

declare(strict_types=1);
/*
-------------------------------------------------------------------------------
les routes
-------------------------------------------------------------------------------
*/


return [
    // admin
    ['GET', '/v3/reigns/administrateur', 'administrateur@getAll'], // tous les admins
    ['POST', '/v3/reigns/administrateur/mail', 'administrateur@getByMail'], // un par son mail
    ['POST', '/v3/reigns/administrateur', 'administrateur@add'], // ajoute un admin
    ['POST', '/v3/reigns/administrateur/check', 'administrateur@check'], // Vérifie si le mot de passe fonctionne sur l'admin renseigné

    // créateur
    ['GET', '/v3/reigns/createur', 'createur@getAll'], // tous les créateurs
    ['POST', '/v3/reigns/createur/mail', 'createur@getByMail'], // un par son mail
    ['POST', '/v3/reigns/createur/id', 'createur@getById'], // un par son id_createur
    ['POST', '/v3/reigns/createur/check', 'createur@check'], // Vérifie si le mot de passe fonctionne sur l'utilisateur renseigné
    ['POST', '/v3/reigns/createur/ban', 'createur@isBan'], // Vérifie si l'utilisateur renseigné est banni
    ['POST', '/v3/reigns/createur/names', 'createur@getNamesFromDeck'], // récupérer les noms et id des créateur par leur participation dans un deck renseigné
    ['POST', '/v3/reigns/createur', 'createur@add'], // ajoute un créateur
    ['PATCH', '/v3/reigns/createur', 'createur@edit'], // modifie un créateur
    ['PATCH', '/v3/reigns/createur/like', 'createur@addLike'], // ajoute un like  à tous les créateurs renseignées (voir bruno pour le json !)
    ['PATCH', '/v3/reigns/createur/ban', 'createur@ban'], // Banni un créateur
    ['DELETE', '/v3/reigns/createur', 'createur@delete'], // supprimer un créateur

    // deck
    ['GET', '/v3/reigns/deck', 'deck@getAll'], // tous les decks
    ['POST', '/v3/reigns/deck/id', 'deck@getById'], // un par son id_deck
    ['GET', '/v3/reigns/deck/valid', 'deck@getAllValid'], // tous les decks valides
    ['GET', '/v3/reigns/deck/novalid', 'deck@getAllNoValid'], // tous les decks valides
    ['GET', '/v3/reigns/deck/lastadd', 'deck@findDeckID'], // uniquement l'id du dernier ajouté
    ['POST', '/v3/reigns/deck/valid/id', 'deck@getAllValidByAdmin'], // tous les decks valides par son id_administrateur
    ['POST', '/v3/reigns/deck/valid/minmax', 'deck@searchByMinMax'], // tous les decks valides dont le nb_carte est compris entre x et y
    ['POST', '/v3/reigns/deck/noparticipation', 'deck@noParticipation'], // tous les decks dont le créateur n'a pas créer de carte
    ['POST', '/v3/reigns/deck/participation', 'deck@participation'], // tous les decks dont le créateur a créer de carte
    ['POST', '/v3/reigns/deck/participation/admin', 'deck@participationAdmin'], // tous les decks dont l'admin a créer de carte
    ['POST', '/v3/reigns/deck', 'deck@add'], // ajoute un deck
    ['PATCH', '/v3/reigns/deck', 'deck@edit'], // modifier un deck
    ['PATCH', '/v3/reigns/deck/valid', 'deck@editValid'], // modifier un deck
    ['PATCH', '/v3/reigns/deck/like', 'deck@addLike'], // ajouter un like 
    ['DELETE', '/v3/reigns/deck', 'deck@delete'], // supprimer un deck

    // carte
    ['GET', '/v3/reigns/carte', 'carte@getAll'], // toutes les cartes
    ['POST', '/v3/reigns/carte/id', 'carte@getById'], // une par son id_carte
    ['POST', '/v3/reigns/carte/deck/order', 'carte@getByDeckAndOrder'], // une par son deck et son ordre
    ['POST', '/v3/reigns/carte/valid/deck/id', 'carte@getAllValidByIdDeck'],
    ['POST', '/v3/reigns/carte/deck/id', 'carte@getAllByIdDeck'],
    ['POST', '/v3/reigns/carte/idcarteiddeck', 'carte@getByIdDeckAndIdDeck'],
    ['POST', '/v3/reigns/carte/deck/count', 'carte@count'],
    ['POST', '/v3/reigns/carte/deck/ordermax', 'carte@order'],
    ['POST', '/v3/reigns/carte', 'carte@add'], // ajoute un carte
    ['PATCH', '/v3/reigns/carte', 'carte@edit'], // modifier un carte
    ['DELETE', '/v3/reigns/carte', 'carte@delete'], // supprimer un carte

    // gestion des cartes aléatoire
    ['POST', '/v3/reigns/carte/alea/search', 'carte@getCarteRng'], // existe?
    ['POST', '/v3/reigns/carte/alea/create', 'carte@createCarteRng'], //ajoute une carte aléatoire

];