<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App;

class AppContext
{
    protected $debugMode = true;
    const DEPRECATED = ["ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\BaseMassActionButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonMassAction", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\AddIconModalButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonCreate", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\BaseSubmitButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonSubmitForm", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\BaseButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonBase", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\BaseDatatableModalButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonDatatableShowModal", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\BaseModalDataTableActionButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonDataTableModalAction", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\RedirectButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonRedirect", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\BaseModalButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonModal", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\RedirectWithOutTooltipButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonRedirect", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\OnOffAjaxSwitch" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonSwitchAjax", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\CustomActionButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonCustomAction", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\CustomAjaxActionButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonAjaxCustomAction", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DatatableModalButtonContextLang" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonDatatableModalContextLang", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdownButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonDropdown", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\MassActionButtonContextLang" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonMassActionContextLang", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\Submit" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonSubmitForm", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\WhmcsRegisterLoggin" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\WhmcsLogsHandler", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\ButtonDropdown" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdown", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\Dropdowntems\\DropdownItemButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdownItem", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\Dropdowntems\\DropdownItemCustonAjaxButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdownItem", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\Dropdowntems\\DropdownItemCustonButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdownItem", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\Dropdowntems\\DropdownItemDivider" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdownItem", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\Dropdowntems\\DropdownItemModalButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdownItem", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\Dropdowntems\\DropdownItemRedirectButton" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdownItem", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\ApiException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\ApiWhmcsException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\ControllerException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\DependencyInjectionException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\MGModuleException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\RegisterException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\ServiceLocatorException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\SmartyException" => "ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\Exceptions\\Exception"];
    public function __construct()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . "ErrorHandler.php";
        register_shutdown_function([$this, "handleShutdown"]);
        set_error_handler([$this, "handleError"], E_ALL);
        $this->loadDebugState();
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "Bootstrap.php";
        if ($this->debugMode) {
            spl_autoload_register(["\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\AppContext", "loadClassLoader"], true, false);
        }
    }
    public function runApp($callerName = NULL, $params = [])
    {
        try {
            $app = new Application();
            $result = $app->run($callerName, $params);
            restore_error_handler();
            return $result;
        } catch (\Exception $exc) {
            restore_error_handler();
            return ["status" => "error", "message" => $exc->getMessage()];
        }
    }
    public function handleError($errno, $errstr, $errfile, $errline, $errcontext = NULL)
    {
        if ($this->debugMode || !in_array($errno, ErrorHandler::WARNINGS) && !in_array($errno, ErrorHandler::NOTICES)) {
            $handler = new ErrorHandler();
            $errorToken = md5(time());
            $handler->logError($errorToken, $errno, $errstr, $errfile, $errline, $errcontext);
        }
        return true;
    }
    public function handleShutdown()
    {
        $errorInstance = NULL;
        $errManager = \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\WhmcsErrorManagerWrapper::getErrorManager();
        if (is_object($errManager) && method_exists($errManager, "getRunner")) {
            $runner = $errManager->getRunner();
            if (is_object($runner) && method_exists($runner, "getHandlers")) {
                $handlers = $runner->getHandlers();
                foreach ($handlers as $handler) {
                    $rfHandler = new \ReflectionClass($handler);
                    $method = $rfHandler->getMethod("getException");
                    $method->setAccessible(true);
                    $error = $method->invoke($handler);
                    if (is_object($error)) {
                        $errorInstance = $error;
                    }
                }
            }
        }
        if ($errorInstance === NULL) {
            $errorInstance = error_get_last();
            if ($errorInstance === NULL) {
                return NULL;
            }
            $this->handleError($errorInstance["type"], $errorInstance["message"], $errorInstance["file"], $errorInstance["line"], "");
        } else {
            $handler = new ErrorHandler();
            $errorToken = md5(time());
            $handler->logError($errorToken, $errorInstance->getCode(), $errorInstance->getMessage(), $errorInstance->getFile(), $errorInstance->getLine(), $errorInstance->getTrace());
            if ($errorToken) {
                echo "<input type=\"hidden\" id=\"mg-sh-h-492318-64534\" value=\"" . $errorToken . "\" mg-sh-h-492318-64534-end >";
            }
        }
    }
    public function loadDebugState()
    {
        $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . ".debug";
        if (file_exists($path)) {
            $this->debugMode = true;
        } else {
            $this->debugMode = false;
        }
    }
    public static function loadClassLoader($class)
    {
        $rawClass = trim($class, "\\");
        $pos = strpos($rawClass, "ModulesGarden\\Servers\\ZimbraEmail");
        if ($pos === 0 && !class_exists($class) && DEPRECATED[$rawClass]) {
            echo "This class no longer exists: " . $class . "<br>";
            echo "Use: " . DEPRECATED[$rawClass];
            exit;
        }
    }
}

?>