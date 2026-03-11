<?php

function fibo($n){
    if ($n < 2) {  // Caso base: evita recursión infinita
        return $n;
    }
    return fibo($n-1) + fibo($n-2);
}

echo fibo(5);