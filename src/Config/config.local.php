<?php
/*
  Fichier : src/config/config.local.php
*/

/**
 * le DSN de la base
 */
define('APP_DB_DSN', 'mysql:host=localhost;dbname=mdubois_api_reigns;charset=UTF8');

/**
 * le nom de l'utilisateur MYSQL
 */
define('APP_DB_USER', 'root');

/**
 * le mot de passe de l'utilisateur MYSQL
 */
define('APP_DB_PASSWORD', '');

/**
 * le préfixe des tables dans la base (utile pour les bases partagées)
 */
define('APP_TABLE_PREFIX', '');
