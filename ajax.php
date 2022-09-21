<?php
    include 'src/Models/Calculation.php';

    if(isset($_POST['text']) && !empty(($_POST['text']))) {
        $str = $_POST['text'];
        $parse = new ParseText($str);
        $className = $parse->findOperation();
        $numbers = $parse->findNumbers();

        if ($className[1]=='' && $numbers[1]==''){
            $calculator = new CalculateItems(new $className[0], $numbers[0]);
            $data = array(
                'operation' => $className[0],
                'numbers' => $numbers[0],
                'total' => $calculator->calculate(),
                'error' => ''
            );

        } else {
            $data = array(
                'operation' => $className[1],
                'numbers' => $numbers[1],
                'total' => $className[1],
                'error' =>  'You Entered incorrect data'
            );
        }
        echo json_encode($data);

    } else{
        print('You send empty field');
    }