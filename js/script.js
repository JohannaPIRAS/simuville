$("#parametre_ville, #affichage_stats, #affichage_ville1, #affichage_ville2, #affichage_ville3, #stats, #ville1, #ville2, #ville3").hide();

$("#parametrer").click(function () {
    nb = $("#nb_ville").val();
    $("#parametrer").hide();

    $("#parametre_ville").show();
    for (var n = 1; n <= nb; n++) {
        $("#ville" + n).show();
    };
})

$("#lancer_simu").click(function() {
    tableau_final = [];
    var nb_annee = parseInt($("#nb_annee_simu").val());
    var nb = $("#nb_ville").val();
   
    for (var i = 1; i<= nb; i++) {
        var final = {
        'population_initiale' : $("#pop_ini" + i).val(),
        'taux_natalite' : $("#tx_nat" + i).val(),
        'taux_mortalite' : $("#tx_mort" + i).val()
        }
        // console.log(final);
        tableau_final.push(final);
        
    }
    

    for (var n = 1; n <= nb; n++) {
        $("#affichage_ville" + n).show();
    };
    chrono(nb,tableau_final, nb_annee);
    $("#inputs, #parametre_ville").hide();
    $("#affichage_stats").show();
})

function chrono(nb,tableau_final, nb_annee) {

    $.ajax({
        type : 'POST',
        url : 'creation_ville.php',
        data : {
            case : 'ville',
            nombre_ville : nb,
            tableaufin : tableau_final,
            nb_annee_simu : nb_annee
        },
        success : function (data){
            var result_data = JSON.parse(data);

            remplirtab(result_data);

        },

    });

    var nb_annee = parseInt($("#nb_annee_simu").val());
    var affichage = parseInt($("#annee").html());

    for (var n = 1; n <= nb; n++) {
        var population_initiale = parseInt($("#pop_ini" + n).val());
        $("#popv" + n).html(population_initiale);
    }

    var chrono = setInterval(function () {
        $("#annee").html(affichage);
        // var evol_pop = $("#pop_ini").html(affichage_pop);

        for (var n = 1; n <= nb; n++) {
            var alea = Math.floor(Math.random()*(36-1+1))+1;
            var tx_nat = parseFloat($("#tx_nat" + n).val());
            var tx_mort = parseFloat($("#tx_mort" + n).val());
            population_actuelle = parseInt($("#popv" + n).html());
            $("#img" + n).html('<img src="img/'+alea+'.svg" alt="" width=30px height=30px >');
           
            population = (population_actuelle + (population_actuelle * tx_nat) - (population_actuelle * tx_mort));
            $("#popv" + n).html(population.toFixed());
           
        }
        affichage++;
        if (affichage >= nb_annee) {
            clearInterval(chrono);
        }

    }, 100);

    $("#reload").click(function () {
        location.reload();
    })
}

function remplirtab(result_data){

    setTimeout(function(){

            for (var i = 0; i < nb; i++) {
                $("#popini_" + (i+1)).html(result_data[i][0]);
                $("#txn_" + (i+1)).html(result_data[i][1]);
                $("#txm_" + (i+1)).html(result_data[i][2]);
                $("#stats").show();
                $("#affichage_stats").hide();
            }
    },3000)
}












function nb_cata() {
    var nb_annee_simu = $("#nb_annee_simu".val());

    if (nb_annee_simu <= 50) {
        nb_cata = Math.floor(Math.random() * 2);
    } else if (nb_annee_simu > 50 && nb_annee_simu <= 500) {
        nb_cata = Math.floor(Math.random() * 10) + 1;
    } else if (nb_annee_simu > 500 && nb_annee_simu <= 10000) {
        nb_cata = Math.floor(Math.random() * 31) + 2;
    } else(nb_annee_simu > 10000)
    nb_cata = Math.floor(Math.random() * 54) + 4;
}

function type_cata() {

    Array.prototype.shuffled = function () {
        return this.map(function (n) {
                return [Math.random(), n]
            })
            .sort().map(function (n) {
                return n[1]
            });
    }

    for (i = 0; i < nb_cata; i++) {
        type_cata[i].key.value;
    }

    var type_cata = {
        "eau": 5,
        "feu": 8,
        "terre": 10,
        "vent": 4,
        "épidémie": 36,
        "guerre": 47
    };
}