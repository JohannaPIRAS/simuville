<?php

namespace Classes;

use Classes\Database;

/**
 * class Partie
 * 
 * Permet de créer une partie 
 */
class Partie {
    /**
     * Stocke la date qui est générée dans le constructeur
     *
     * @var string
     */
    private $_datePartie;

    /**
     * id de la partie en cours
     *
     * @var string
     */
    private $_idPartie;

    /**
     * id de la partie en cours
     *
     * @var string
     */
    private $_nbAnneeSimulation;

    

    public function __construct($annee_simulation)
    {
        $this->_datePartie = date('Y-m-d H:i:s');
        $this->_nbAnneeSimulation = $annee_simulation;
    }

    public function createPartie(){

        $pdo = new Database;

        $connect = $pdo->getPdo();

        $insert = $connect->prepare('INSERT INTO partie (date_partie, nb_annee_simulation) VALUES (?,?)');
        $insert->bindParam(1, $this->_datePartie);
        $insert->bindParam(2, $this->_nbAnneeSimulation);

        $insert->execute();
        
        $req = $connect->query('SELECT max(id_partie) FROM partie');
        $res = $req->fetch();
        $this->_idPartie = $res[0];
    }

    public function getCSV(){
        
        $pdo = new Database;

        $connect = $pdo->getPdo();

        $req = "COPY (SELECT population_initiale, tx_natalite, tx_mortalite, annee_simulation FROM ville INNER JOIN partie_ville ON ville.id_ville = partie_ville.id_ville WHERE id_partie = (SELECT max (id_partie) FROM partie)) TO '/var/www/html/simuville/dump.csv' DELIMITER ',' CSV HEADER";

        $getCsv = $connect->prepare($req);
        
        $getCsv->execute();

    }

}

