<?php
ini_set('display_errors', false);
class Formulaire
{
    public function __construct($method = 'POST', $action = '', $name = 'formulaire', $enctype = 'multipart/form-data')
    {
        echo '<form name="' . $name . '" method="' . $method . '" action="' . $action . '" enctype="' . $enctype . '">';
    }
    public function input($type = 'text', $nom = 'input', $placeholder = '', $class = '')
    {
        switch ($type) {
            case 'text':
                $type = 'text';
                break;
            case 'email':
                $type = 'email';
                break;
            case 'password':
                $type = 'password';
                break;
            case 'tel':
                $type = 'tel';
                break;
            default:
                $type = 'text';
                break;
        }
        return '<input type="' . $type . '" name="' . $nom . '" placeholder="' . $placeholder . '" class="' . $class . '" />';
    }
    public function input2($args = array())
    {
        // On definit les valeurs par défaults dans un tableau
        $default = array(
            'type'          => 'text',
            'nom'           => 'input',
            'placeholder'   => '',
            'class'         => ''
        );
        // On fusionne les 2 tableaux
        $args = array_merge($default, $args);
        switch ($args['type']) {
            case 'text':
                $type = 'text';
                break;
            case 'email':
                $type = 'email';
                break;
            case 'password':
                $type = 'password';
                break;
            case 'tel':
                $type = 'tel';
                break;
            default:
                $type = 'text';
                break;
        }
        return '<input type="' . $type . '" name="' . $args['nom'] . '" placeholder="' . $args['placeholder'] . '" class="' . $args['class'] . '" />';
    }
    public function textarea($args = array())
    {
        $defaut = array(
            'nom'       => 'textarea',
            'class'     => '',
            'valeur'    => '',
            'id'        => 'textarea',
            'required'  => false
        );
        if ($args['required']) {
            $required = 'required="required"';
        } else {
            $required = '';
        }
        $args = array_merge($defaut, $args);
        return '<textarea name="' . $args['nom'] . '" class="' . $args['class'] . '" id="' . $args['id'] . '" ' . $required . '>' . $args['valeur'] . '</textarea>';
    }
    public function select($args = array())
    {
        $defaut = array(
            'nom'       => 'select',
            'class'     => '',
            'required'  => false,
            'id'        => 'select',
            'values'    => array()
        );
        $args = array_merge($args, $defaut);
        if ($args['required']) {
            $required = 'required="required"';
        } else {
            $required  = null;
        }
        $str = '<select name="' . $args['nom'] . '" class="' . $args['class'] . '" id="' . $args['id'] . '" ' . $required . '>';
        foreach ($args['values'] as $key => $valeur) {
            $str .= '<option value="' . $key . '">' . $valeur . '</option>';
        }
        $str .= '</select>';
        return $str;
    }
    public function radio($args = array())
    {
        $defaut = array(
            'nom'       => 'radio',
            'class'     => '',
            'id'        => 'radio',
            'values'    => array(),

        );
        $args = array_merge($defaut, $args);
        $str = '';
        foreach ($args['values'] as $val => $label) {
            if ($label['required']) {
                $required = 'required="required"';
            } else {
                $required = '';
            }
            if ($label['checked']) {
                $checked = 'checked="checked"';
            } else {
                $checked = '';
            }
            $str .= '<input type="radio" name="' . $args['nom'] . '" id="' . $args['id'] . '" class="' . $args['class'] . '" value="' . $val . '" ' . $required . ' ' . $checked . '><label>' . $label['label'] . '</label>';
        }
        return $str;
    }
    public function checkbox1($args = array())
    {
        $defaut = array(
            'nom'       => 'checkbox',
            'valeur'    => '',
            'class'     => '',
            'label'     => '',
            'id'        => 'checkbox',
            'required'  => false,
            'checked'   => false
        );
        $args = array_merge($defaut, $args);
        if ($args['required']) {
            $required = 'required="required"';
        } else {
            $required = '';
        }
        if ($args['checked']) {
            $checked = 'checked="checked"';
        } else {
            $checked = false;
        }
        return '<input type="checkbox" name="' . $args['nom'] . '" id="' . $args['id'] . '" value="' . $args['valeur'] . '" class="' . $args['class'] . '" ' . $required . ' ' . $checked . '><label>' . $args['label'] . '</label>';
    }
    public function checkboxMultiple($args = array())
    {
        $defaut = array(
            'class'  => '',
            'values' => array()
        );
        $args = array_merge($defaut, $args);
        $str = '';
        foreach ($args['values'] as $valeur => $label) {
            if ($label['required']) {
                $required = 'required="required"';
            } else {
                $required = '';
            }
            if ($label['checked']) {
                $checked = 'checked="checked"';
            } else {
                $checked = '';
            }
            $str .= '<input type="checkbox" name="' . $label['nom'] . '" id="' . $label['id'] . '" value="' . $valeur . '" class="' . $args['class'] . '" ' . $required . ' ' . $checked . '><label>' . $label['label'] . '</label>';
        }
        return $str;
    }
    public function file($args = array())
    {
        $defaut = array(
            'nom'       => 'fichier',
            'id'        => 'fichier',
            'class'     => '',
            'required'  => false
        );
        $args = array_merge($defaut, $args);
        if ($args['required']) {
            $required = 'required="required"';
        } else {
            $required = '';
        }
        return '<input type="file" name="' . $args['nom'] . '" id="' . $args['id'] . '" class="' . $args['class'] . '" ' . $required . ' />';
    }
    public function button($args = array())
    {
        $defaut = array(
            'type'      => 'button',
            'nom'       =>  'bouton',
            'id'        => 'bouton',
            'class'     => '',
            'valeur'    => 'Soumettre'
        );
        $args = array_merge($defaut, $args);
        switch ($args['type']) {
            case 'button':
                $type = 'button';
                break;
            case 'reset':
                $type = 'reset';
                break;
            case 'submit':
                $type = 'submit';
                break;
            default:
                $type = 'button';
                break;
        }
        return '<button type="' . $type . '" name="' . $args['nom'] . '" id="' . $args['id'] . '" class="' . $args['class'] . '">' . $args['valeur'] . '</button>';
    }
    private function fin()
    {
        return '</form>';
    }

    public function submit($args = array())
    {
        $defaut = array(
            'name'       => 'submit',
            'valeur'    => 'envoyer',
            'id'        => 'submit',
            'class'     => ''
        );
        $args = array_merge($defaut, $args);
        $str = '<button type="submit" name="' . $args['name'] . '" class="' . $args['class'] . '" id="' . $args['id'] . '">' . $args['valeur'] . '</button>';
        echo $str;
        echo $this->fin();
    }
    // méthode pour traiter les fichiers
    private function traitementFichier()
    {
        global $_FILES;
        $bool = array();
        $i=0;
        foreach ($_FILES as $file) 
        {
            if (is_uploaded_file($file['tmp_name'])) 
            {
                if (move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name'])) 
                {
                    $bool[$i] ['etat']= true;  // le fichier a bien été uploadé
                    $bool[$i] ['nom']= $file['name'];  // le nom du fichier
                }
                else
                {
                    $bool[$i] ['etat'] = false;
                    $bool[$i] ['nom'] = $file['name'];  // le nom du fichier qui n'a pas été uploadé
                }
            }
            else
            {
                $bool[$i] ['etat'] = false;
            }
            $i++;
        }
        return $bool;
    }
    
    // Méthode permettant de traiter le formulaire
    public function traitement($table)
    {
        $global $db;
        $sql = 'INSERT INTO ' . $table. ' SET' ;
        // On récupère les superglobales $_POST, $_GET, $_FILES
        global $_POST;
        global $_GET;
        global $_FILES;
        // On parcourt l'ensemble des champs POST
        foreach ($_POST as $name => $valeur) 
        {
            $sql .=  $name . ' = ' . $valeur ;
            if($i < count($_POST))
            {
                $sql .= ',';
            }
            $i++;
        }
        // On parcourt l'ensemble des champs GET
        foreach ($_GET as $get) 
        {
            // On affiche le tableau multidimensionnel get
            $sql .=  $name . ' = ' . $valeur ;
            if($i < count($_GET))
            {
                $sql .= ',';
            }
            $i++;
        }
        echo $sql;
        // On parcourt l'ensemble des fichiers
       
        $fichier = $this->traitementFichier();
        $i=1;
        foreach ($fichier as $fi) 
        {
            if($fi['etat'])
            {
                echo 'Le fichier'.$i.' '.$fi['nom'].' a bien été uploadé' . '<br>';
            }
            else
            {
                echo 'fichier : ' . $i .  ' n\'a pas été uploadé' . '<br>';
            }
            $i++;
        }


    }
}
/*$contact = new Formulaire();
$contact->input('text','prenom','Votre prénom','input-prenom');
$contact->input2(array('nom' => 'prenom','placeholder' => 'Votre prénom', 'class' => 'input-prenom'));
$contact->textarea();

$liste = array(
    'Mr'    => 'Monsieur',
    'Mme'   => 'Madame',
);
// Comparaison entre if,elseif,else et switch
$age = 18;
if($age == 12){
    echo 'tu as 12 ans';
}
else if($age == 14)
{
    echo 'tu as 14 ans';
}
else if($age == 18)
{
    echo 'bravo tu es majeur(e) en france';
}
else if($age == 21)
{
    echo 'bravo tu es majeur(e) dans le monde entier';
}
else
{
    echo 'Tu as pas le bon age !!!';
}
switch($age)
{
    case 12:
        echo 'tu as 12 ans';
    break;
    case 14:
        echo 'tu as 14 ans';
    break;
    case 18:
        echo 'bravo tu es majeur(e) en france';
    break;
    case 21:
        echo 'bravo tu es majeur(e)  dans le monde entier';
    break;
    default:
        echo 'tu as pas le bon age !!!!';
        if($age >= 30)
        {
            echo 'tu peux aller au V&B';
        }
    break;
}*/
$contact = new Formulaire();
/*function FormulaireContact()
{
    global $contact;
    echo $contact->input('text','nom','Votre nom');
    echo $contact->input('text','prenom','Votre prénom');
    echo $contact->input('email','email','Votre Email');
    echo $contact->input('text','sujet','Sujet');
    echo $contact->textarea('message');
    echo $contact->submit();
    echo $contact->fin();
}

echo $contact->input('text','nom','Votre nom');
echo $contact->input('text','prenom','Votre prénom');
echo $contact->input('email','email','Votre Email');
echo $contact->input('text','sujet','Sujet');
echo $contact->textarea('message');
echo $contact->submit();
$valeur_radio = array(
  'oui' => array('label' => 'oui','required' => true,'checked' => true),
  'non' => array('label' => 'non','required' => false,'checked' => false)
);*/
echo $contact->input2(array('nom' => 'nom', 'placeholder' => 'Votre Nom'));
echo $contact->input2(array('type' => 'email', 'nom' => 'email', 'placeholder' => 'Votre Email'));
echo $contact->input2(array('nom' => 'Sujet', 'placeholder' => 'Sujet'));
echo $contact->radio(
    array(
        'nom' => 'rgpd',
        'values' => array(
            'oui' => array(
                'checked' => true,
                'label' => "j'accepte les RGPD"
            ),
            'non' => array(
                'label' => "Je n'accepte pas les RGPD"
            )
        )
    )
);
echo $contact->checkboxMultiple(array(
    'values' => array(
        'newsletter' => array(
            'label' => "j'accepte la newsletter"
        ),
        'partenaires' => array(
            'label' => "j'accepte les partenaires"
        )
    )
));
echo $contact->textarea();
echo $contact->file(array('nom' => 'fichier1'));
echo $contact->file(array('nom' => 'fichier2'));
echo $contact->submit(array('nom' => 'submit', 'valeur' => 'Nous contacter'));

if (isset($_POST['submit'])) {
    $contact->traitement('Table_contact');
    // Si sur une autre page
    Formulaire::traitement();
}