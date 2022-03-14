<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Helper;

/**
 * Helper for caching data in database
 * stores json in the $modelClass
 *
 * @author inbs
 */
class DatabaseCache
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    /**
     * @var string
     */
    protected $modelClass = "\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\ModuleSettings\\Model";
    /**
     * @var misc
     * whatever you need to store
     */
    protected $data = NULL;
    /**
     * @var int
     * timestamp of the last update
     */
    protected $lastDataUpdate = NULL;
    /**
     * @var int
     * valid period for stored data, after this it will be autoupdated by callback
     * in secounds like a timestamp
     */
    protected $validPeriod = 300;
    /**
     * @var string
     * key for data store
     */
    protected $dataKey = NULL;
    /**
     * @var \ModulesGarden\Servers\ZimbraEmail\Core\Models\ModuleSettings\Model
     */
    protected $model = NULL;
    /**
     * @var callable
     * function returning data for the key
     */
    protected $callback = NULL;
    protected $assocJsonDecode = false;
    public function __construct($key, $callback, $timeout = 300, $assoc = false, $forceReload = false)
    {
        $this->model = sl($this->modelClass);
        $this->dataKey = $key;
        $this->validPeriod = (int) $timeout;
        $this->callback = $callback;
        $this->assocJsonDecode = $assoc;
        $this->initLoadProcess($forceReload);
    }
    protected function initLoadProcess($forceReload = false)
    {
        if ($forceReload) {
            $this->updateRemoteData();
        } else {
            $this->loadDataFromDb();
            if (!$this->isDataValid()) {
                $this->updateRemoteData();
            }
        }
    }
    protected function updateRemoteData()
    {
        $data = $this->loadRemoteData();
        $time = time();
        $this->updateDbCache($data, $time);
        $this->data = $data;
        $this->lastDataUpdate = $time;
    }
    protected function updateDbCache($data, $time)
    {
        $dbData = $this->model->where("setting", $this->dataKey)->first();
        if ($dbData) {
            $dbData->update(["value" => json_encode($data)]);
        } else {
            $this->model->create(["setting" => $this->dataKey, "value" => json_encode($data)]);
        }
        $dbDataTime = $this->model->where("setting", $this->dataKey . "_lastDataUpdate")->first();
        if ($dbDataTime) {
            $dbDataTime->update(["value" => $time]);
        } else {
            $this->model->create(["setting" => $this->dataKey . "_lastDataUpdate", "value" => $time]);
        }
    }
    protected function loadRemoteData()
    {
        if (!is_callable($this->callback)) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_CDB_000001, ["callback" => $this->callback]);
        }
        $data = call_user_func_array($this->callback, []);
        return $data;
    }
    public function getData()
    {
        return $this->data;
    }
    public static function loadData($key, $callback, $timeout = 300, $assoc = false, $forceReload = false)
    {
        $loader = new DatabaseCache($key, $callback, $timeout, $assoc, $forceReload);
        return $loader->getData();
    }
    protected function loadDataFromDb()
    {
        $dbData = $this->model->where("setting", $this->dataKey)->first();
        if (!$dbData) {
            return false;
        }
        $this->data = json_decode($dbData->value, $this->assocJsonDecode);
        $lastUpdate = $this->model->where("setting", $this->dataKey . "_lastDataUpdate")->first();
        if ($lastUpdate) {
            $this->lastDataUpdate = (int) $lastUpdate->value;
        }
    }
    protected function isDataValid()
    {
        if (!$this->data || !$this->lastDataUpdate) {
            return false;
        }
        if ($this->lastDataUpdate + $this->validPeriod < time()) {
            return false;
        }
        return true;
    }
}

?>