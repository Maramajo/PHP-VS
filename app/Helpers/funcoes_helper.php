<?php 
function teste(){
    echo 'HELLLLLLLP';
}
function verDados($array)
{
    echo '<pre>';
    foreach ($array as $key => $value) {
        echo "<p> $key => $value</p>";
    }
    echo '</pre>';

}
function verRow($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

}

function verSessao()
{
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';

}

?>
