<?php

function ajoute($nom, $prenom, $age) {
    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'exercice_eleve';

    try {
        $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

        $nouveau = $maConnexion->prepare("
            INSERT INTO eleves (nom, prenom, age)
            VALUES (:nom, :prenom, :age)
        ");

        $nouveau->bindParam(':nom', $nom);
        $nouveau->bindParam(':prenom', $prenom);
        $nouveau->bindParam(':age', $age);

        $nouveau->execute();

        echo "<p>un élève a été ajouté</p>";
    }
    catch (PDOException $exception) {
        echo "Erreur de connexion: " . $exception->getMessage();
    }
}

ajoute('Mome', 'Albert', '45');
ajoute('Canne', 'Vivien', '32');

function enregistre() {
    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'exercice_eleve';

    try {
        $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

        $eleve = $maConnexion->prepare("SELECT nom, prenom, age from eleves");

        $state = $eleve->execute();

        if($state) {
            foreach ($eleve->fetchAll() as $user) {
                echo "<div>eleve: " . $user['nom'] . " " . $user['prenom'] . " " . $user['age'] . " ans</div>";
            }
        }
    }
    catch (PDOException $exception) {
        echo "Erreur de connexion: " . $exception->getMessage();
    }
}

enregistre();

function modifie($idEleves, $nom, $prenom, $age) {
    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'exercice_eleve';

    try {
        $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

        $eleve = $maConnexion->prepare("
             UPDATE eleves SET nom = :nom, prenom = :prenom, age = :age WHERE id = :id
        ");

        $eleve->bindParam(':id', $idEleves);
        $eleve->bindParam(':nom', $nom);
        $eleve->bindParam(':prenom', $prenom);
        $eleve->bindParam(':age', $age);

        $eleve->execute();

        echo "<p>un élève a été modifié !</p>";
    }
    catch (PDOException $exception) {
        echo "Erreur de connexion: " . $exception->getMessage();
    }
}

modifie('2', 'Piano', 'Fanny', '22');
modifie('5', 'Vif', 'Guillaume', '56');

function supprime($idEleves) {
    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'exercice_eleve';

    try {
        $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

        $eleve = "DELETE FROM eleves WHERE id = $idEleves";

        if($maConnexion->exec($eleve) !== false){
            echo "<p>Un élève a été supprimé !</p>";
        }
    }
    catch (PDOException $exception) {
        echo "Erreur de connexion: " . $exception->getMessage();
    }
}

supprime('13');
supprime('14');