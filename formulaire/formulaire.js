$(document).ready(function () {
  /*  $('body').css('background-color','#F0F');
    $('body').animate({opacity:0.5},2000);
    $('input').on('mouseover',function(){
        $(this).addClass('testjquery');
    });
    $('input').on('mouseout',function(){
        $(this).removeClass('testjquery');
    });
    // Affichage du champ au click sur le label
    $('label,input').on('click',function() {
        // on recupere le label 
        let nom = $(this).attr('for');
        if(nom == undefined) {
            $(this).toggle();
        }
        else {
            $('#'+nom).toggle();
        }
        // ,on selectionne notre champs par son id 
        
    });*/

///   Obligation de remplir les champs ///
  $("form[name='contact']").validate({
    rules: {
      nom: "required",
      prenom: "required",
      tel: {
        required: true,
        number: true
      },
      email: {
        required: true,

        email: true
      },
      message: "required"
    },
    messages: {
      nom: "veuillez insérer votre nom",
      prenom: "veuillez insérer votre prénom",
      tel: 'veuillez insérer un numéro de téléphone',
      email: "veuillez insérer une adresse mail valide",

    },
    submitHandler: function (form) {
      form.submit();
    }
  });
/////  Fin de la validation du formulaire  /////



/////  Modification du bouton submit  /////
  $("select.input").change(function () {
    var sexe = $(this).children("option:selected").val();
    if ($(this).val() == "Homme") {
      $('#submit').html('Envoyer Monsieur');
    } else if ($(this).val() == "Femme") {
      $('#submit').html('Envoyer Madame');
    } else if ($(this).val() == "Autre") {
      $('#submit').html('Regarde dans ta culotte');
    }
    else {
      $('#submit').html('Selectionner sexe');
    }

  });

  $('textarea').on('click', function () {
    $("#mess").html(" ");
  });
/////  Fin de la modification du bouton submit  /////

///// compteur de caractères  ///// 
  var limitnum = 50;

  function limiting(obj, limit) {
    var cnt = $("#counter > span");
    var txt = $(obj).val();
    var len = txt.length;
    if (len > limit) {
      $(obj).val(txt.substr(0, limit));
      $(cnt).html(len - 1);
    }
    else {
      $(cnt).html(len);
    }

  }
  $('textarea').keyup(function () {
    limiting($(this), limitnum);
  });

/////  Fin de compteur de caractères  /////



/////  Creation tableau dans le DOM  /////
  $('#submit').on('click', function () {
    $("tbody").append("<tr><td>" + $('input[name="nom"]').val() + "</td><td>" + $('input[name="prenom"]').val() + "</td><td>" + $('input[name="email"]').val() + "</td><td>" + $('input[name="tel"]').val() + "</td><td>" + $('select[name="sexe"]').val() + "</td><td>" + $('input[name="sujet"]').val() + "</td><td>" + $('textarea[name="message"]').val() + "</td>></tr>");
  });
  $("form").submit(function() { return false; }); 
/////  Fin de la creation tableau dans le DOM  /////


/////  Suppression des entrées formulaire  /////
  $("#submit").on('click', function () {
    $('#reset').get(0).click();
    });

    console.log($("#contact"));
/////  Fin de la suppression des entrées formulaire  /////
});
