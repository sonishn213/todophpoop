<?php
function validateBatch($data)
{

    $errorfound = false;
    $resData = [];
    foreach ($data as $key => $element) {
        //validate current element
        $validData =  validateSingle($element['data'], $element['type']);
        //check if current element is valid
        if ($validData['isValid'] === false) {
            $errorfound = true;
        }
        //set type of current element
        $validData['type'] = $element['type'];
        $resData[$key] = $validData;
    }
    return ['data' => $resData, 'errorfound' => $errorfound];
}
//check single elements
function validateSingle($element, $type)
{

    switch ($type) {
        case 'email':
            return validateEmail($element);
        case 'name':
            return validateString($element);
    }
}

//validate email
function validateEmail($email): iterable
{
    //create response array
    $res = [];
    if (strlen($email) <= 0) {
        $res = ["data" => $email, "isValid" => false, "message" => "Please enter email"];
        return $res;
    }

    //sanitize email
    $newEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    //set new email to response
    $res["data"] = $newEmail;
    //validate email
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL) === false) {
        $res["isValid"] = true;
    } else {
        $res["isValid"] = false;
        $res["message"] = "Invalid email";
    }

    return $res;
}
//validate Strings return new array with new string
function validateString($string): iterable
{
    //sanitize string
    $newString = htmlspecialchars($string);
    //create response array
    $res = array("data" => $newString);
    //validate name

    $res["isValid"] = true;

    return $res;
}
