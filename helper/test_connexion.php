<?php
 // On inclut le fichier config_local.php qui contient la connexion à la base
 include '../config/config_local.php';
 // Si l'inclusion s'est bien passée, la variable $conn est déjà disponible
 if ($conn) {
 echo "Connexion réussie à la base de données locale !";
 } else {
 echo "Erreur de connexion : " . mysqli_connect_error();
 }