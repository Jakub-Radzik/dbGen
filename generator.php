<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    
        $db_name = $_POST['db-name'];
        $tab_name = $_POST['tab-name'];
        $arr_col_names = [];
        $arr_data_types = [];


        for ($i=1; $i <= (count($_POST)-2)/2 ; $i++) { 
            $arr_col_names[$i-1]=$_POST['col-name-'.strval($i)];
            $arr_data_types[$i-1]=$_POST['data-type-'.strval($i)];
        }

        echo var_dump($arr_col_names);
        echo var_dump($arr_data_types);
    
    
    
    
    
    ?>
</body>
</html>