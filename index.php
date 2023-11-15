<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management project</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script defer src="./assets/js/main.js"></script>
</head>
<body>
    
    <h1>Let's time to play with SQL !</h1>

    <!-- 1 -->
    <h1>1.Trouver tous les employés qui gagnent plus de 2000 euros triés par ordre décroissant de salaire.</h1>
    <?php

use PhpParser\Node\Stmt\Echo_;

    require_once('./assets/php/middleware/connect.php');

    $employes = $db_connect->query("SELECT * FROM employe WHERE salaire >= 2000 ORDER BY salaire DESC");

    foreach($employes as $employe) {
        echo $employe['nom'] . ' ' . $employe['prenom'] . ' : ' . $employe['salaire'] . '€' . '<br />';
    }

    ?>

    <!-- 2 -->
    <h1>2.Quels sont les employés qui sont entrés en 2021 ?</h1>
    <?php


require_once('./assets/php/middleware/connect.php');

    $employes = $db_connect->query("SELECT * FROM `employe` WHERE YEAR(date_entree) = 2021");

    foreach($employes as $employe){
        echo $employe['nom'] . ' ' . $employe['prenom'] . ' // ' . $employe['date_entree'] . '<br />';
    }

    ?>

    <!-- 3-->
    <h1>3.Quels sont les employés qui ont, soit un salaire supérieur à 2500 euros, soit une commission supérieure à 3 ?</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');

    $employes = $db_connect->query("SELECT * FROM `employe` WHERE salaire >2500 or commission >3");

    foreach($employes as $employe){
        echo $employe['nom'] . ' ' . $employe['prenom'] . ' // ' . $employe['salaire'] . '//  commission : ' . $employe['commission'] . '<br />';
    }

    ?>

     <!-- 4-->
     <h1>4.Afficher les 3 personnes les mieux payés de l'entreprise.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');

    $employes = $db_connect->query("SELECT * FROM `employe` WHERE salaire ORDER BY salaire DESC LIMIT 3");

    foreach ($employes as $employe){
    echo $employe['nom'] . ' ' . $employe['prenom'] . ' ' . $employe['salaire'] . '<br />';
  }

    ?>

     <!--5 -->
     <h1>5.Afficher la date d'entrée de la personne la mieux payée.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');

    $employes = $db_connect->query("SELECT * FROM `employe` WHERE salaire AND date_entree ORDER BY salaire DESC LIMIT 1 ");

    echo  $employe['date_entree'] ;


    ?>

     <!-- 6-->
     <h1>6.Afficher l’identifiant, le nom, le prénom, le nom du service et la date d’entrée de tous les employés dont le service est basé à Dijon.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT employe.id_employe , employe.nom,employe.prenom, employe.fonction, employe.date_entree FROM `employe` JOIN service ON employe.service_id = service.id_service  WHERE service.ville = 'Dijon'");

foreach($employes as $employe){
    echo $employe['id_employe'] . ' ' . $employe['nom'] . ' ' . $employe['prenom']. ' ' . $employe['fonction'] . ' ' . $employe['date_entree'] . '<br /> ' ;
}
    ?>

    <!-- 7-->
    <h1>7.Afficher l’identifiant, le nom, le prénom, le nom du service, la date d’entrée et la ville des 5 employés les mieux payés.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT employe.id_employe, employe.nom, employe.prenom, service.nom AS nom_service, employe.date_entree, service.ville
     FROM employe 
     JOIN service ON employe.service_id = service.id_service
     ORDER BY employe.salaire DESC LIMIT 5
     ");

foreach($employes as $employe){
    echo $employe['id_employe'] . ' ' . $employe['nom'] . ' ' . $employe['prenom']. ' ' . $employe['nom_service'] . ' ' . $employe['date_entree'] . ' ' . $employe['ville'] . '<br /> ' ;
}
    ?>

    <!-- 8-->
    <h1>8.Qui sont les employés dont les services se trouvent à Lyon, Dijon et Paris et dont la date d’entrée est avant 2022 ? Afficher toutes les infos de l’employé y compris les noms de leurs services.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT employe.* , service.nom AS nom_service
     FROM employe 
     JOIN service  ON employe.service_id = service.id_service
     WHERE service.ville IN ('Lyon', 'Dijon', 'Paris') AND employe.date_entree < '2022-01-01'
     ");
foreach($employes as $employe){
    echo $employe['id_employe'] . ' ' . $employe['nom'] . ' ' . $employe['prenom']. ' ' . $employe['nom_service'] . ' ' . $employe['date_entree'] . ' ' . '<br /> ' ;
}

    ?>

    <!-- 9-->
    <h1>9.Afficher toutes les informations des employés dont le service se trouvent à Paris et qui gagnent entre 1500 euros et 2500 euros. Afficher aussi leurs services.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT employe.*, service.nom AS nom_service
     FROM employe 
      JOIN service  ON employe.service_id = service.id_service
      WHERE service.ville = 'Paris' AND employe.salaire BETWEEN 1500 AND 2500
");

foreach($employes as $employe){
    echo $employe['id_employe'] . ' ' . $employe['nom'] . ' ' . $employe['prenom']. ' ' . $employe['nom_service'] . ' ' . $employe['date_entree'] . '<br /> ' ;
}
    ?>

    <!-- 10-->
    <h1>10.Compter le nombre d’enregistrement dans la table employé.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT COUNT(*) AS nombre_enregistrements
     FROM employe
     ");

    $resultat = $employes->fetch(PDO::FETCH_ASSOC);

    echo "Le nombre d'enregistrements dans la table employe est : " . $resultat['nombre_enregistrements'];
?>

    <!-- 11-->
    <h1>11.Afficher le total du salaire de l’entreprise</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT SUM(salaire) AS total_salaire_entreprise
     FROM employe
     ");

    $resultat = $employes->fetch(PDO::FETCH_ASSOC);

    echo "Le total du salaire de l'entreprise est : " . $resultat['total_salaire_entreprise'] . ' euros';
?>

 <!-- 12-->
    <h1>12.Afficher la liste des employés qui gagnent plus que la moyenne du salaire des employés.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT * FROM employe WHERE salaire > (SELECT AVG(salaire) FROM employe)");

     foreach($employes as $employe){
        echo  $employe['nom'] . ' ' . $employe['prenom']. ' : ' . $employe['salaire'] . '<br /> ' ;
    }

    ?>

 <!-- 13-->
    <h1>13.Lister les employés du service ‘Accounting’ en utilisant une sous-requête.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT *FROM employe WHERE service_id = (SELECT id_service FROM service WHERE nom = 'Accounting')");

     foreach($employes as $employe){
        echo   ' id:' . $employe['id_employe'] . ' ' . $employe['nom']. '  ' . $employe['prenom'] . '<br /> ' ;
    }

    ?>

    <!-- 14-->
    <h1>14.Lister les employés du service basé à Lyon en utilisant une sous-requête.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT *
     FROM employe
     WHERE service_id IN (SELECT id_service FROM service WHERE ville = 'Lyon')");

foreach($employes as $employe){
    echo   ' id:' . $employe['id_employe'] . ' ' . $employe['nom']. '  ' . $employe['prenom'] . '<br /> ' ;
}

    ?>

    <!-- 15-->
    <h1>15.Qui sont les personnes les mieux payés de la société, c’est-à-dire ceux qui gagnent le montant maximum ?</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT *
     FROM employe
     WHERE salaire = (SELECT MAX(salaire) FROM employe)");

foreach($employes as $employe){
    echo   $employe['nom']. '  ' . $employe['prenom'] . ' ' . $employe['salaire'] . '<br /> ' ;
}

    ?>

    <!-- 16-->
    <h1>
        Lister les employés dont la fonction commence par la lettre ‘A’.
    </h1>

<?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT *
     FROM employe
     WHERE fonction LIKE 'A%'
     ");

foreach($employes as $employe){
    echo  $employe['fonction']. '  // ' .  $employe['nom']. '  ' . $employe['prenom'] . '<br /> ' ;
}

    ?>

<!-- 16-->

 <h1>16.Lister les employés dont la fonction commence par la lettre ‘A’.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT *
     FROM employe
     WHERE fonction LIKE 'A%'
     ");

foreach($employes as $employe){
    echo  $employe['fonction']. '  // ' .  $employe['nom']. '  ' . $employe['prenom'] . '<br /> ' ;
}

    ?>

    <!-- 17-->
    <h1>17.Lister les salaires moyens par service.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT service.nom AS nom_service, AVG(employe.salaire) AS salaire_moyen
     FROM employe 
     JOIN service  ON employe.service_id = service.id_service
     GROUP BY service.nom
     ");

foreach ($employes as $employe) {

    echo 'Salaire moyen pour le service ' . $employe['nom_service'] . ': ' . $employe['salaire_moyen'] . '€ <br />';
}

    ?>

    <!-- 18-->
    <h1>18.Lister les services ayant un nombre d’employés supérieur ou égal à 5.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT service.nom AS nom_service, COUNT(*) AS nombre_employes
     FROM employe 
     JOIN service  ON employe.service_id = service.id_service
     GROUP BY service.nom
     HAVING COUNT(*) >= 5
     ");

foreach ($employes as $employe) {
    echo 'Service: ' . $employe['nom_service'] . ', Nombre d\'employés: ' . $employe['nombre_employes'] . '<br />';
}

    ?>

    <!-- 19-->
    <h1>19.Lister tous les employés avec les noms de leurs services en utilisant une jointure.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT employe.*, service.nom AS nom_service
     FROM employe 
     JOIN service  ON employe.service_id = service.id_service
     ");
foreach ($employes as $employe) {
    echo  $employe['id_employe']. '  ' .  $employe['nom']. '  ' . $employe['prenom'] . ' ' . $employe['nom_service'] . '<br /> '  ;
}

    ?>

      <!-- 20-->
      <h1>20.Lister les employés dont le service se trouve à Lyon en utilisant une jointure.</h1>
    <?php

    require_once('./assets/php/middleware/connect.php');
     $employes = $db_connect->query("SELECT employe.*, service.nom AS nom_service
     FROM employe 
     JOIN service ON employe.service_id = service.id_service
     WHERE service.ville = 'Lyon'
     ");

foreach ($employes as $employe) {
    echo $employe['id_employe'] . ' ' . $employe['nom'] . ' ' . $employe['prenom'] . ' ' . $employe['nom_service'] . '<br />';
}

    ?>


</body>
</html>