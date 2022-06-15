<?php
$morpion = array();
$morpion[] = array('X','O','X');
$morpion[] = array('O','O','X');
$morpion[] = array('X','X','O');


// multi
$morpion2 = array(
    0 => array('X','O','X'),
    1 => array('O','X','O'),
    2 => array('O','X','O')
);

$morpion3 = array(
    0 => array(
        0 => 'X',
        1 => 'O',
        2 => 'X'
    ),
    1 => array(
        0 => 'O',
        1 => 'X',
        2 => 'O'
    ),
    2 => array(
        0 => 'O',
        1 => 'X',
        2 => 'O'
    )
);

// boucle foreach
echo '<table border="1">';
foreach($morpion3 as $case)
{
    echo '<tr>';
    foreach($case as $valeur)
    {
        echo'<td>'.$valeur.'</td>';
    }
    echo '</tr>';
}
echo '</table>';
// fin boucle foreach
// boucle for

echo '<table border="1>';
for($i=0;$i<count($morpion);$i++)
{
    echo '<tr>';
    for($i2=0;$i2<count($morpion[$i]);$i2++)
    {
        echo '<td>'.$morpion[$i][$i2].'</td>';
    }
    echo '</tr>';
}
echo '</table>';


?>