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
        $quantity = $_POST['quantity'];
        
        $arr_col_names = [];
        $arr_data_types = [];


        for ($i=1; $i <= (count($_POST)-2)/2 ; $i++) { 
            $arr_col_names[$i-1]=$_POST['col-name-'.strval($i)];
            $arr_data_types[$i-1]=$_POST['data-type-'.strval($i)];
        }
    
    

        //GENERATE QUERIES
        echo 'CREATE DATABASE '.$db_name.';';
        echo '<br>';
        echo '<br>';
        echo 'CREATE TABLE '.$tab_name.'(';
        echo '<br>';
        for ($i=0; $i < count($arr_col_names) ; $i++) { 
            echo $arr_col_names[$i];

            if($i!=count($arr_col_names)-1){
                echo ',';
            }
            echo '<br>';
        }
        echo ')';
        echo '<br><br>';
        
        
        $str_insert = implode(',',$arr_col_names);
        

        for ($i=0; $i < $quantity ; $i++) { 
            echo 'INSERT INTO '.$tab_name.'('.$str_insert.')'.'VALUES();';
            echo '<br>';
        }


    
    ?>
</body>
</html>