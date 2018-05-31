<?php
require_once('config.php');
require ('Validator.php');

function render($file, $scope_data){
    ob_start();
    extract($scope_data);
    require($file);
    return ob_get_clean();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sd['form_data'] = json_decode(file_get_contents('php://input'), true);
    $sd['form_data'] = array_intersect_key($sd['form_data'], $fields);

    $validator = new Validator($fields);
    $res = $validator->validate($sd['form_data']);

    header('Content-Type: application/json');
    if($res) {      // if validation errors
        echo json_encode(['error' => $res]);
    } else {
        $sended = mail($to, strip_tags($sd['form_data']['subject']), render('email.template.php', $sd), $headers);

        if($sended) {   // if successful sent
            echo json_encode(['success' => 'We have accepted your request and will reply you as soon as possible']);
        } else {
            echo json_encode(['error' => 'mail error']);
        }
    }

} else {
    echo json_encode(['error' => 'Unacceptable request method!']);
}


