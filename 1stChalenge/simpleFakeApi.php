<?php
    $input = json_decode(file_get_contents('php://input'), true);
    if(isset($input['login']) && isset($input['password'])) {
        if ($input['login'] == 'test' && $input['password'] == 'pass')
            echo json_encode(['status' => 200, 'message' => 'connected successfully']);
        else
            echo json_encode(['status' => 403, 'message' => 'invalid login']);
        
    } elseif(isset($_GET['userId'])) {
        $input = $_GET['userId'];
            $users = [
                0 => [
                    'name' => 'eduardo moro',
                    'age' => '19',
                ]
            ];
            
            if($users[$input]){
                echo json_encode(array_merge(['status' => 200], $users[$input]));
            } else {
                echo json_encode(['status' => 404, 'message' => 'user not found']);
            }
    } else {
            echo json_encode(['status' => 400, 'message' => 'no data provided']);
    }
