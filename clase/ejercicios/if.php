<?php
    $var = 5;
    if($var < 0) echo "$var es un numero negativo";
    if($var > 0) echo "$var es un numero positivo";
?>
    <hr>
<?php
    if($var >= 0) {
        echo "$var es un numero positivo o cero";
    } else {
        echo "$var es un numero negativo";
    }
?>
    <hr>
<?php
    if($var == 0) echo "$var es cero";
    elseif($var == 1) echo "$var es uno";
    elseif($var == 3) echo "$var es tres";
    else echo "$var es un numero diferente de cero, uno o tres";