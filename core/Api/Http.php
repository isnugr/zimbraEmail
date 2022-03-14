<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Api;

/**
 * Description of Http
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class Http
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsDebugOn;
    /**
     * @var \AltoRouter;
     */
    protected $router = NULL;
    public function __construct($basepath)
    {
        $this->loadRouter($basepath);
        $this->router->addMatchTypes(["d" => "[^/]+"]);
    }
    public function run()
    {
        try {
            $logger = $this->getLoggerObject();
            $match = $this->router->match();
            if ($match) {
                $auth = $this->getAuthObject();
                $auth->run($match["name"]);
                $validator = $this->getValidatorObject();
                $validator->run($match["name"]);
                $request = explode("#", $match["target"]);
                $action = [$this->getController($request[0]), $request[1]];
                $result = call_user_func_array($action, $match["params"]);
                $logger->logInfo($match["name"], array_merge($match["params"], $_REQUEST), $result);
                echo json_encode($result);
            } else {
                header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
                echo json_encode(["error" => "Action not found"]);
            }
            exit;
        } catch (\ModulesGarden\Servers\ZimbraEmail\App\Libs\Exceptions\ApiException $mgex) {
            $code = $mgex->getMgHttpCode();
            $exdata = $mgex->getAdditionalData();
            $message = (int) $mgex->getMgMessage(false) . ($this->isDebugOn() ? " | " . print_r($exdata, true) : "");
        } catch (\ModulesGarden\Servers\ZimbraEmail\App\Libs\Exceptions\WhmcsApiException $whmcsex) {
            $exdata = $whmcsex->getAdditionalData();
            $message = $exdata["data"]["result"]["message"] . ": " . $exdata["data"]["result"]["error"];
        } catch (\Exception $ex) {
            $exdata = $this->isDebugOn() ? print_r($ex, true) : NULL;
            $message = "Please contact administration (server side issue)" . ($exdata ? " | " . $exdata : "");
            $logger->logError($match["name"], array_merge($match["params"], $_REQUEST), $exdata);
            $response = $this->getResponseBuilderObject();
            $message = $response->build($match["name"], $message);
            http_response_code($code ?: 500);
            echo json_encode(["error" => $message]);
        }
    }
    protected function loadRouter($basePath)
    {
        $this->router = new \AltoRouter();
        $this->router->setBasePath($basePath);
        $routes = (require \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "api" . DS . "routes.php");
        $this->router->addRoutes($routes);
    }
    protected function getController($classname)
    {
        $classname = "\\ModulesGarden\\Servers\\ZimbraEmail\\App\\Http\\Api\\" . $classname;
        return new $classname();
    }
    protected function getAuthObject()
    {
        $config = $this->getConfigElement("auth");
        $auth = new $config["class"]();
        return $auth;
    }
    protected function getValidatorObject()
    {
        $config = $this->getConfigElement("validator");
        $validator = new $config["class"]();
        return $validator;
    }
    protected function getLoggerObject()
    {
        $config = $this->getConfigElement("logger");
        $auth = new $config["class"]();
        return $auth;
    }
    protected function getResponseBuilderObject()
    {
        $config = $this->getConfigElement("responseBuilder");
        $auth = new $config["class"]();
        return $auth;
    }
    protected function getConfigElement($type)
    {
        $config = (require \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "api" . DS . "config.php");
        foreach ($config as $element) {
            if ($element["type"] == $type) {
                return $element;
            }
        }
    }
}

?>