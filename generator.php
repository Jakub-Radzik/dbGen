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
    
        // for ($i=0; $i < count($arr_col_names) ; $i++) { 
        //     echo $arr_col_names[$i].' '.$arr_data_types[$i];
        //     echo '<br>';
        // }

        $conn_dict = array(
            0 => "ID",
            1 => "first_names",
            2 => "last_names",
            3 => "cities",
            4 => "countries",
            5 => "streets",
            6 => "email_domains",
        );
        
        

        //BASE CONNECT

        $servername = "localhost";
        $username = "root";
        $password = "";

        // Create connection
        $conn = new mysqli($servername, $username, $password, 'generator');

        $array_data= [];
        for ($i=0; $i < count($arr_data_types) ; $i++) { 
            
            
            if($arr_data_types[$i]==0){
                $array_data[$i][0] = 'ID';
                continue;
            }
            $array_data[$i]=[];
            $sql = "SELECT * FROM ".$conn_dict[$arr_data_types[$i]].';';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                array_push($array_data[$i], $row['col']);
            }
            }
    }



        //GENERATE QUERIES RESULT
        echo 'CREATE DATABASE '.$db_name.';'; // Create DB query
        echo '<br>';
        echo '<br>';
        echo 'CREATE TABLE '.$tab_name.'('; // Create Table query
        echo '<br>';
        for ($i=0; $i < count($arr_col_names) ; $i++) { // Col names in create table
            echo $arr_col_names[$i];

            if($i!=count($arr_col_names)-1){//We don't need comma after last column name
                echo ',';
            }
            echo '<br>';
        }
        echo ')';// Create Table end of query
        echo '<br><br>';
        
        //INSERTS INTO query
        
        $str_insert = implode(',',$arr_col_names); //String with col names and commas
        
         //String with values for inserts
       
        function generator_column_values($index, $arr_type, $data){
                $position = array_search($index, $arr_type);
                $random = rand(0, count($data[$position])-1);
                $value = $data[$position][$random];
                return $value;            
        }

        

        $str_values = '';
        for ($i=0; $i < $quantity ; $i++) { 



            //MAIL GENERATOR
            if(in_array(6, $arr_data_types)){
                $mail_position = array_search(6, $arr_data_types);
                $random_mail = rand(0, count($array_data[$mail_position])-1);
                if(in_array(1, $arr_data_types) && in_array(2, $arr_data_types)){
                    $mail=$array_data[array_search(1, $arr_data_types)][$i].'.'.$array_data[array_search(2, $arr_data_types)][$i].'@'.$array_data[$mail_position][$random_mail];
                }elseif(in_array(1, $arr_data_types)){
                    $mail=$array_data[array_search(1, $arr_data_types)][$i].'123@'.$array_data[$mail_position][$random_mail];
                }elseif(in_array(1, $arr_data_types)){
                    $mail=$array_data[array_search(2, $arr_data_types)][$i].'4xyz@'.$array_data[$mail_position][$random_mail];
                }else{
                    $mail = 'auto-mail'.strval(rand(0,9999999)).'@'.$array_data[$mail_position][$random_mail];
                }
            }else{
                $mail='';
            }

            for ($k=0; $k < count($arr_data_types) ; $k++) { 
                if($arr_data_types[$k]=='6'){
                    $str_values.= "'".$mail."'";
                }elseif($arr_data_types[$k]=='0'){
                    $str_values.=strval($i);
                }
                else{
                    $str_values.= "'".generator_column_values($arr_data_types[$k],$arr_data_types,$array_data)."'";
                    //WATCH OUT- IF NUMERIC VALUE WE DON"T NEED APOSTROFS 
                }

                if($k!=count($arr_data_types)-1){
                    $str_values.=',';
                }


            }





            echo 'INSERT INTO '.$tab_name.'('.$str_insert.')'.'VALUES('.$str_values.');';
            $mail='';
            $str_values = '';
            echo '<br>';
        }


    
    ?>
</body>
</html>