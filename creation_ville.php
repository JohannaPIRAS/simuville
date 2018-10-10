<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    use Classes\Autoloader;
    use Classes\Ville;
    use Classes\Partie;
    use Classes\Database;
    use Classes\Catastrophe;
    

    require 'Classes/Autoloader.php';
    Autoloader::register();

    
    $tableaufin = $_POST['tableaufin'];
    // if (isset($_POST['tableaufin'])) { $tableaufin = $_POST['tableaufin']; }

    $nbVille = intval($_POST['nombre_ville']);
    $nb_annee_simu = intval($_POST['nb_annee_simu']);
    $ville = [];

    switch($_POST['case']){ 
        
        case 'ville':
        $partie = new Partie($nb_annee_simu);
        // var_dump($nbVille);

            $partie->createPartie();
            
            for($i = 0; $i < $nbVille; $i++ ){

                $population_initiale = $tableaufin[$i]['population_initiale'];
                $tx_natalite = $tableaufin[$i]['taux_natalite'];
                $tx_mortalite = $tableaufin[$i]['taux_mortalite'];

                // var_dump($population_initiale,$taux_natalite,$taux_mortalite);


                $villes = new Ville($population_initiale, $tx_natalite, $tx_mortalite);
        
                $villes->registerVille();
                
                $villes->registerPartieVille();
        
                $tabVille = [];
        
                $tabVille[] = $villes->get_PopulationInitiale();
                $tabVille[] = $villes->get_TxNatalite();
                $tabVille[] = $villes->get_TxMortalite();
                // var_dump($tabVille);
                $ville[] = $tabVille;
        
            }
            
            $data = json_encode($ville);
            
            echo $data;

            break;

        case 'stats':

            $partie->setStats();

            $stats = $partie->getStatGlobal();

            echo $stats;

            break;

        case 'csv':

            $partie->getCSV();

            break;
    }