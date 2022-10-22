<?php
include_once 'Controller\Api\BaseController.php';
include_once 'Model\Game.php';
class GameController extends BaseController
{

    public function gameRoll () {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // $arrQueryStringParams = $this->getQueryStringParams();

        if(strtoupper($requestMethod) == 'GET') {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else {
            try {
                //Es lo que recibimos del front para empezar la partida.
                $user = $_POST["username"];
                $game= new Game($user);
                //Generar la tirada
                $puntos = $game-> resultado();
                // Database validation
                $connection = new Database(); 
                $userdata = $connection->insert("Insert INTO game (date,score,user_name) values (?,?,?)",Array($game->getDate(), $game-> puntuacion($puntos), $user));

                    $responseData = json_encode($puntos);
                
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
    public function scoresUser () {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // $arrQueryStringParams = $this->getQueryStringParams();

        if(strtoupper($requestMethod) == 'GET') {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else {
            try {
                //Es lo que recibimos del front para empezar la partida.
                $user = $_POST["username"];
                
                // Database validation
                $connection = new Database(); 
                $userdata = $connection->select("select * from game where user_name = ? ", Array($user));

                if(count ($userdata) == 0){
                    $strErrorDesc = 'Not found';
                    $strErrorHeader = 'HTTP/1.1 404 Not Found';
                } else {
                    $responseData = json_encode($userdata);
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

    
}
?>