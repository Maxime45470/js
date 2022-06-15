$(document).ready(function () {


    var myHeaders = new Headers();
    myHeaders.append("apikey", "yeHsjIePMWZfcPfKh6WOhuSPRVgJI0b5");

    var requestOptions = {
        method: 'GET',
        redirect: 'follow',
        headers: myHeaders
    };
    $("#submit").click(function () {
        let montant = document.getElementById("montant").value;
        let devise1 = document.getElementById("sel1").value;
        let devise2 = document.getElementById("sel2").value;





        fetch('https://api.apilayer.com/exchangerates_data/convert?to=' + devise1 + '&from=' + devise2 + '&amount=' + montant + "&format=json", requestOptions)
            .then(response => {
                console.log(response);
                if (response.ok) {
                    response.json()
                        .then(data => {
                            let result = document.querySelector(".resultat");
                            result.innerHTML = (data.result);
                        })
                } else {
                    console.log("error");
                }



                $.ajax({
                    
                    type: "GET",
                    url: "ajax.json",
                    data: { sel1: devise1, sel2: devise2, montant: montant, result2:  },
                    dataType: "json",

                })
                    .done(function () {
                        //alert( "success" );
                        //console.log(data.result);
                    })

            });


    });


});