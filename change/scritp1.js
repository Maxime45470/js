$(document).ready(function(){
    $('#submit').on({
        click : function(){
            var 
                endpoint = 'convert';
                access_key = 'yeHsjIePMWZfcPfKh6WOhuSPRVgJI0b5';
                from = $("#sel1").val();
                to = $("#sel2").val();
                amount = $('#montant').val();
                url = 'https://api.apilayer.com/exchangerates_data/' + endpoint + '?apikey=' + access_key +'&from=' + from + '&to=' + to + '&amount=' + amount,
               

            $.ajax({ 
                url: url,
                method: "GET",
                dataType : "json",
            })
            .done(function(data){
                $("#resultat").html(data.result);
                // console.log(data); 
                var resultat2 = data.result;
                // console.log(result2); 

                $.ajax({ 
                url : "ajax.php",
                method: "GET",
                data : {sel1: from, sel2: to, montant: amount, resultat2: data.result},
                dataType : "json",
                })

                .done(function() {
                    // alert( "success" );
                    // console.log(data.result);
                })

                .fail(function() {
                    alert( "error" );
                })
            })
            //Ce code sera exécuté en cas d'échec - L'erreur est passée à fail()
            .fail(function(error){
                alert("Une erreur c'est produite");
            });
            
        }
    });
});