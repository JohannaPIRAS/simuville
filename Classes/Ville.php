<?php

namespace Classes;

use Classes\Database;

/**
 * class Ville
 * 
 * Permet de créer une nouvelle ville
 */
class Ville {

    /**
     * Fixe la taille de depart de la ville
     *
     * @var int (2-5000)
     */
    protected $_populationInitiale;
    
    /**
     * taux de natalité
     *
     * @var float (0-1)
     */
    protected $_txNatalite;
    
    /**
     * taux de mortalité
     *
     * @var float (0-1)
     */
    protected $_txMortalite;

    /**
     * Stocke l'id de la ville
     *
     * @var int
     */
    protected $_idVille;

    public function __construct($popini, $txn, $txm)
    {
        $this->_populationInitiale = $popini;
        $this->_txNatalite = $txn;
        $this->_txMortalite = $txm;
    }

    /**
     * Get (2-5000)
     *
     * @return  int
     */ 
    public function get_PopulationInitiale()
    {
        return $this->_populationInitiale;
    }

    /**
     * Set (2-5000)
     *
     * @param  int  $_PopulationInitiale  (2-5000)
     *
     * @return  self
     */ 
    public function set_PopulationInitiale(int $_populationInitiale)
    {
        $this->_populationInitiale = $_populationInitiale;

        return $this;
    }

    /**
     * Get (0-1)
     *
     * @return  float
     */ 
    public function get_TxNatalite()
    {
        return $this->_txNatalite;
    }

    /**
     * Set (0-1)
     *
     * @param  float  $_TxNatalite  (0-1)
     *
     * @return  self
     */ 
    public function set_TxNatalite(float $_txNatalite)
    {
        $this->_txNatalite = $_txNatalite;

        return $this;
    }

    /**
     * Get (0-1)
     *
     * @return  float
     */ 
    public function get_TxMortalite()
    {
        return $this->_txMortalite;
    }

    /**
     * Set (0-1)
     *
     * @param  float  $_TxMortalite  (0-1)
     *
     * @return  self
     */ 
    public function set_TxMortalite(float $_TxMortalite)
    {
        $this->_TxMortalite = $_TxMortalite;

        return $this;
    }

    /**
     * Permet de vérifier si la ville générée existe déjà dans la bdd et, si elle n'existe pas, de l'y enregistrer
     *
     * @return void
     */
    public function registerVille(){
        
        // Connexion à la base de données
        $pdo = new Database;

        $connect = $pdo->getPdo();

        // Vérification
        $req = $connect->prepare('SELECT * FROM ville WHERE population_initiale = ? AND tx_natalite = ? AND tx_mortalite = ?');
        
        $req->bindParam(1, $this->_populationInitiale);
        $req->bindParam(2, $this->_txNatalite);
        $req->bindParam(3, $this->_txMortalite);
        
        $req->execute();
        $res = $req->fetch();

        if($res){
            $this->_idVille = $res[0];
        } else {

            // Si la ville n'existe pas, on l'enregistre
            $insert = $connect->prepare('INSERT INTO ville (population_initiale, tx_natalite, tx_mortalite) VALUES(?, ?, ?)');

            $insert->bindParam(1, $this->_populationInitiale);
            $insert->bindParam(2, $this->_txNatalite);
            $insert->bindParam(3, $this->_txMortalite);

            $insert->execute();


            // Puis on récupère son id
            $getId = $connect->prepare('SELECT id_ville FROM ville WHERE population_initiale = ? AND tx_natalite = ? AND tx_mortalite = ?');

            $getId->bindParam(1, $this->_populationInitiale);
            $getId->bindParam(2, $this->_txNatalite);
            $getId->bindParam(3, $this->_txMortalite);

            $getId->execute();
            $id = $getId->fetch();

            $this->_idVille = $id[0];

        }

    }

    public function registerPartieVille(){

        $pdo = new Database;

        $connect = $pdo->getPdo();

        $reqPartie = $connect->query('SELECT max(id_partie) FROM partie');

        $resPartie = $reqPartie->fetch();

        $id_partie = $resPartie[0];

        $id_cata = 7;

        $insert = $connect->prepare('INSERT INTO partie_ville VALUES(?, ?, ?, 0)');

        $insert->bindParam(1, $id_partie);
        $insert->bindParam(2, $this->_idVille);
        $insert->bindParam(3, $id_cata);


        $insert->execute();

    }


}