<?php
$morpion = array();
$morpion[] = array('X','O','X');
$morpion[] = array('O','X','O');
$morpion[] = array('O','X','O');
// Multidimensionnel
$morpion2 =  array(
    0 => array('X','O','X'),
    1 => array('O','X','O'),
    2 => array('O','X','O')
);
// Boucle Foreach
echo '<table border="1">';
foreach($morpion2 as $case)
{
    echo '<tr>';
    foreach($case as $valeur)
    {
        echo '<td>'.$valeur.'</td>';
    }
    echo '</tr>';
}
echo '</table>';
// Fin boucle foreach
// Boucle For
echo '<table border="1">';
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