<?php
 $host = 'localhost';
 $user = 'root';
 $password = '';
 $dbname = 'intro_web';
  
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
 // En cas d'erreur, on ne fait pas echo ici pour ne pas polluer les autres scripts
 // On laisse les scripts inclure ce fichier et gérer les erreurs eux-mêmes
 }