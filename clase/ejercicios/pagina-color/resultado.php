<?php

    $color_pagina = $_POST["color"];
    
    if(isset($color_pagina)){
        $color_pagina = 'white';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        * {
            
            background-color: <?= $color_pagina ?>;
        }

        
    </style>

</head>
<body>
    
</body>
</html>
