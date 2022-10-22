<?php
include_once 'Controller\Api\BaseController.php';
class UserController extends BaseController
{

    public function login() {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // $arrQueryStringParams = $this->getQueryStringParams();

        if(strtoupper($requestMethod) == 'GET') {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else {
            try {
                $user = $_POST["username"];
                $password = $_POST["password"];

                // Database validation
                $connection = new Database(); 
                $userdata = $connection->select("SELECT * FROM login_ WHERE name = ? AND password = ?;", Array($user, $password));

                if(count ($userdata) == 0){
                    $strErrorDesc = 'Not found';
                    $strErrorHeader = 'HTTP/1.1 404 Not Found';
                } else {
                    $responseData = json_encode($userdata[0]);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    public function register() {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // $arrQueryStringParams = $this->getQueryStringParams();

        if(strtoupper($requestMethod) == 'GET') {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else {
            try {
                $user = $_POST["username"];
                $password = $_POST["password"];
                $name = $_POST["name"];
                $dni = $_POST["dni"];
                $last_name= $_POST["last_name"];
                $birthday= $_POST["birthday"];
                $email= $_POST["email"];
                $phone= $_POST["phone"];

                // Database validation
                $connection = new Database(); 
                $insertUser = $connection->insert("Insert INTO user (name,dni,last_name,birthday,email,phone) values (?,?,?,?,?,?)",Array($name, $dni, $last_name, $birthday, $email, $phone));
                if(!$insertUser){
                    $strErrorDesc = 'Not found';
                    $strErrorHeader = 'HTTP/1.1 404 Not Found';
                } else {
                    $insertLogin = $connection->insert("Insert INTO login_ (name,dni_user,password) values (?,?,?)",Array($user, $dni, $password));
               

                    if(!$insertUser || !$insertLogin){
                        $strErrorDesc = 'Not found';
                        $strErrorHeader = 'HTTP/1.1 404 Not Found';
                    } else {
                        $responseData = json_encode('http://localhost/Proyecto2022/index.php/user/'.$dni);
                    }                    
                }
              
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 201 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
?>