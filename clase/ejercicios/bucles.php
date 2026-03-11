<?php

echo "Numero del 1 al 10 con for<br>";

for($i = 1; $i <= 10; $i++){

    echo "$i <br>";
}

echo "Numero del 1 al 10 con while<br>";

$j = 1;

while($j <= 10){
    echo "$j <br>";
    $j++;
}

echo "Numero del 1 al 10 con do while<br>";

$j = 1;
do{
    echo "$j <br>";
    $j++;
}
while($j <= 10);