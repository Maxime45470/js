

function win() {
    clearInterval(iGameLoopId);
    with (win) {
        document.getElementById("divmusic2").innerHTML = '<object type="audio/mpeg" width="1" height="4" data="sound/win.mp3">' + '<param name="filename" value="monmp3.mp3" />' + '<param name="autostart" value="true" />' + '<param name="loop" value="false" />' + '</object>';
    }
    document.getElementById("score").innerHTML = "Bravo vous avez tué Poutine" + "<br>" + "Soldat tué :" + " " + iScore;
    document.getElementById("rejouer").innerHTML = '<input id="submit" onclick="window.location.reload()" type="button" value="REJOUER"></input>';
    context.drawImage(bkgImageWin, 0, 0);
    // alert("Tu as detruit la russie !\nScore : " + iScore);
}

function loose() {
    clearInterval(iGameLoopId);
    with (loose) {
        document.getElementById("divmusic").innerHTML = '<object type="audio/mpeg" width="1" height="4" data="sound/loose.mp3">' + '<param name="filename" value="monmp3.mp3" />' + '<param name="autostart" value="true" />' + '<param name="loop" value="false" />' + '</object>';
    }
    document.getElementById("score").innerHTML = "Poutine à fait sauter le monde" + "<br>" + "Soldat tué :" + " " + iScore;
    document.getElementById("rejouer").innerHTML = '<input id="submit" onclick="window.location.reload()" type="button" value="REJOUER"></input>';

    context.drawImage(bkgImage, 0, 0);
    //alert("Poutine à gagner !\nScore : " + iScore);

}


$('#submit2').on({
    click: function () {

        var pseudo = $('#pseudo').val();
        var score = iScore;


        $.ajax({

            url: "ajax.php",
            method: "GET",
            data: { pseudo: pseudo, score: score },
            dataType: "json",

        })
            .done(function () {
                // alert( "success" );
                // console.log(data.result);
            })

            .fail(function () {
                alert("error");
            })

            //Ce code sera exécuté en cas d'échec - L'erreur est passée à fail()
            .fail(function (error) {
                alert("Une erreur c'est produite");
            });

    }
});