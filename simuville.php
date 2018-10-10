<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="simuville.css">
  <title>simuville</title>
</head>

<body>
  <div class="titre">
    <br>
    <p>Bienvenue sur SimuVille, le site de simulation de villes</p>
  </div>
  <br>
  <div id="inputs">
    <label for="nb_ville">Déterminer le nombre de villes:</label> <br>
    <input class="form-control form-control-sm" id="nb_ville" type="number" value="1" min="1" max="3">
    <br>
    <label for="nb_annee_simu"> Déterminer le nombre d'années de la simulation</label> <br>
    <input class="form-control form-control-sm" id="nb_annee_simu" name="nb_annee_simu" type="number" value="500" min="1"
      max="20000">
    <br>
    <button  type="button" id="parametrer" class="btn btn-secondary">Paramétrer les villes</button>
  </div>
  <br>
  <div id="parametre_ville">
    <div class="row">
      <div class="col-10">
        <div class="row">
          <div id="ville1" class="col-3">
            <h3>Ville 1</h3>
            <div class="form-group">
              <label for="pop_ini">population initiale:</label>
              <br>
              <input type="number" class="form-control" id="pop_ini1" value="2" min="2" max="5000" name="population_initiale">
              <br>
              <label for="tx_nat"> Taux de natalité:</label>
              <br>
              <input type="number" class="form-control" id="tx_nat1" value="0.024" min="0" max="1" name="tx_natalité">
              <br>
              <label for="tx_mort"> Taux de mortalité:</label>
              <br>
              <input type="number" class="form-control" id="tx_mort1" value="0.005" min="0" max="1" name="tx_mortalité">
              <br>
            </div>
          </div>
          <div id="ville2" class="col-3">
            <h3>Ville 2</h3>
            <div class="form-group">
              <label for="pop_ini">population initiale:</label>
              <br>
              <input type="number" class="form-control" id="pop_ini2" value="2" min="2" max="5000" name="population_initiale">
              <br>
              <label for="tx_nat"> Taux de natalité:</label>
              <br>
              <input type="number" class="form-control" id="tx_nat2" value="0.024" min="0" max="1" name="tx_natalité">
              <br>
              <label for="tx_mort"> Taux de mortalité:</label>
              <br>
              <input type="number" class="form-control" id="tx_mort2" value="0.005" min="0" max="1" name="tx_mortalité">
              <br>
            </div>
          </div>
          <div id="ville3" class="col-3">
            <h3>Ville 3</h3>
            <div class="form-group">
              <label for="pop_ini">population initiale:</label>
              <br>
              <input type="number" class="form-control" id="pop_ini3" value="2" min="2" max="5000" name="population_initiale">
              <br>
              <label for="tx_nat"> Taux de natalité:</label>
              <br>
              <input type="number" class="form-control" id="tx_nat3" value="0.024" min="0" max="1" name="tx_natalité">
              <br>
              <label for="tx_mort"> Taux de mortalité:</label>
              <br>
              <input type="number" class="form-control" id="tx_mort3" value="0.005" min="0" max="1" name="tx_mortalité">
              <br>
            </div>
          </div>
        </div>
      </div>
    <div class="col-2">
      <button type="button" class="btn btn-danger" id="lancer_simu"> Lancer la simulation</button>
    </div>
  </div>
  </div>
  <br>
  <div id="affichage_stats">
    <h2 class="text-center">Année : <span id="annee">0</span></h2>
    <div class="row">
      <div id="affichage_ville1" class="col-md-4">
        <h3>Ville 1</h3>
        <label for="popv1"> Population: <span id="popv1">0</span></label>
      <div id="img1">
      </div>  
      </div>
      <div id="affichage_ville2" class="col-md-4">
        <h3>Ville 2</h3>
        <label for="popv2"> Population: <span id="popv2">0</span></label>
      <div id="img2">  
      </div>
      </div>
      <div id="affichage_ville3" class="col-md-4">
        <h3>Ville 3</h3>
        <label for="popv3"> Population: <span id="popv3">0</span></label>
      <div id="img3">
      </div>
      </div>
</div>
</div>
      <div id="stats">
        <p>Voici le résumé de votre simulation:</p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Paramètres</th>
              <th>Ville 1</th>
              <th>Ville 2</th>
              <th>Ville 3</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Population initiale</td>
              <td id="popini_1"></td>
              <td id="popini_2"></td>
              <td id="popini_3"></td>
            </tr>
              <td>Taux de natalité</td>
              <td id="txn_1"></td>
              <td id="txn_2"></td>
              <td id="txn_3"></td>
            </tr>
            <tr>
              <td>Taux de mortalité</td>
              <td id="txm_1"></td>
              <td id="txm_2"></td>
              <td id="txm_3"></td>
            </tr>
          </tbody>
        </table>
        <button type="button" id="reload" class="btn btn-success">Recommencer</button>
        <button type="button" onclick="csv()" class="btn btn-primary">Exporter en csv</button>
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
      <script src="js/script.js"></script>
      
</body>

</html>