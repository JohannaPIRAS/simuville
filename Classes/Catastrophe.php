<?php

namespace Classes;

use Classes\Database;

/**
 * class Catastrophe
 * 
 * Permet de créer une catastrophe 
 */
class Cata {
    /**
     * Stocke le type de catastrophe
     *
     * @var string
     */
    private $_typeCata;

    /**
     * id de la catastrophe
     *
     * @var int
     */
    private $_idCata;

    public function __construct(){

        $this->_typeCata = mt_rand(1,7);
        
    }

    

}
