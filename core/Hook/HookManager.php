<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Hook;

class HookManager
{
    protected $hookRegister = [];
    protected static $currentName = "";
    protected $files = NULL;
    /**
     * @var Config
     */
    protected $config = NULL;
    public function __construct($dir)
    {
        $this->config = new Config();
        $path = $dir . DS . "app" . DS . "Hooks";
        $files = scandir($path, 1);
        if (count($files) != 0) {
            if ($value === "." || $value === ".." || is_dir($path . DIRECTORY_SEPARATOR . $value)) {
                unset($files[$key]);
            }
        }
        $this->files = $files;
    }
    public static function create($dir)
    {
        $hookManager = new HookManager($dir);
        foreach ($hookManager->getFiles() as $file) {
            $path = $dir . DS . "app" . DS . "Hooks" . DS . $file;
            try {
                list(self::$currentName) = explode(".", $file);
                require $path;
            } catch (\Exception $e) {
                ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Hook\\HookManager", $e->getMessage() . " ||||HookPath: " . $path, $e->getTrace());
            }
        }
        $hookManager->start();
        return $hookManager;
    }
    public function getFiles()
    {
        return $this->files;
    }
    public function register($callback, $sort = 1)
    {
        $this->hookRegister[] = ["name" => self::$currentName, "function" => $callback, "sort" => $sort];
    }
    protected function start()
    {
        foreach ($this->hookRegister as $hook) {
            if ($this->config->checkHook($hook["name"])) {
                add_hook($hook["name"], $hook["sort"], $hook["function"]);
            }
        }
    }
}

?>