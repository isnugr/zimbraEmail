<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Logger;

/**
 * Description of AbstractLogger
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Entity
{
    /**
     * @var LoggerModel
     */
    protected $model = NULL;
    protected $id = NULL;
    protected $idRef = NULL;
    protected $idType = NULL;
    protected $type = NULL;
    protected $level = NULL;
    protected $date = NULL;
    protected $request = NULL;
    protected $response = NULL;
    protected $beforeVars = NULL;
    protected $vars = NULL;
    protected $reference = NULL;
    protected $message = NULL;
    protected static $fields = ["id" => "id", "id_ref" => "idRef", "id_type" => "idType", "type" => "type", "level" => "level", "date" => "date", "request" => "request", "response" => "response", "before_vars" => "beforeVars", "vars" => "vars"];
    protected static $types = ["debug" => "Debug", "error" => "Error", "info" => "Info", "success" => "Success", "critical" => "Critical"];
    protected static $levels = ["low" => "Low", "medium" => "Medium", "hight" => "Hight"];
    const TYPE_DEBUG = "debug";
    const TYPE_ERROR = "error";
    const TYPE_INFO = "info";
    const TYPE_SUCCESS = "success";
    const TYPE_CRITICAL = "critical";
    const LEVEL_LOW = "low";
    const LEVEL_MEDIUM = "medium";
    const LEVEL_HIGHT = "hight";
    public function __construct(\ModulesGarden\Servers\ZimbraEmail\Core\Models\Logger\Model $model)
    {
        $this->model = $model;
    }
    public function find($id)
    {
        $data = $this->getModel()->find($id);
        $this->loadData($data->toArray());
        $this->loadMessage();
        $this->model = $data;
        return $this;
    }
    public function getModel()
    {
        if ($this->model === NULL) {
            $this->model = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Logger\Model();
        }
        return $this->model;
    }
    public function all($type = NULL)
    {
        $model = clone $this->getModel();
        if ($type !== NULL) {
            $model = $model->where("type", "LIKE", $type);
        }
        $collection = [];
        foreach ($model->get()->toArray() as $record) {
            $item = clone $this;
            $collection[] = $item->loadData($record)->loadMessage();
        }
        return $collection;
    }
    public function getReferenceLogs($isAllType = false)
    {
        $model = clone $this->getModel();
        if ($this->type !== NULL && $isAllType === true) {
            $model = $model->where("type", "LIKE", $this->type);
        }
        $model = $model->where("id_ref", "LIKE", $this->idRef)->where("id_type", "LIKE", $this->idType);
        return $model->get();
    }
    public function getTypeLabel()
    {
        return self::$types[$this->type];
    }
    public function getType()
    {
        return $this->type;
    }
    public function getLevelLabel()
    {
        return self::$levels[$this->level];
    }
    public function getReference()
    {
        if ($this->reference === NULL && $this->idType && ($reference = $this->getModel()->find($this->id)->reference())) {
            $this->reference = $reference->toArray();
        }
        return $this->reference;
    }
    public function getRequest()
    {
        return $this->request;
    }
    public function getResponse()
    {
        return $this->response;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getBeforeVars()
    {
        return $this->beforeVars;
    }
    public function getVars()
    {
        return $this->vars;
    }
    public function getReferenceId()
    {
        return $this->idRef;
    }
    public function getReferenceNamespace()
    {
        return $this->idType;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setReference($id, $className)
    {
        if ($className !== NULL) {
            $this->idRef = $id;
            $this->idType = $className;
        }
        return $this;
    }
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }
    public function setMessage($message = "")
    {
        $this->message = $message;
        return $this;
    }
    public function setBeforeVars($vars)
    {
        $this->beforeVars = $vars;
        return $this;
    }
    public function setVars($vars)
    {
        $this->vars = $vars;
        return $this;
    }
    protected function loadMessage()
    {
        if (is_array($this->response)) {
            $this->message = $this->response["message_base"];
            unset($this->response["message_base"]);
        } else {
            if (is_string($this->response)) {
                $this->message = $this->response;
                $this->response = NULL;
            } else {
                if (is_object($this->response)) {
                    $this->message = $this->response->message;
                    unset($this->response->message);
                }
            }
        }
        return $this;
    }
    protected function loadData($data = [])
    {
        foreach ($data as $name => $row) {
            $name = $this->getPropertyName($name);
            if (in_array($name, ["vars", "beforeVars", "response", "request"], true)) {
                $newData = json_decode($row, true);
                if ($newData === false) {
                    $newData = unserialize($newData);
                }
                if ($newData !== false) {
                    $this->{$name} = $newData;
                } else {
                    $this->{$name} = $row;
                }
            } else {
                $this->{$name} = $row;
            }
        }
        return $this;
    }
    protected function getDataToSave()
    {
        $data = [];
        foreach (self::$fields as $key => $property) {
            if ($property === "response") {
                if (is_array($this->{$property})) {
                    $this->{$property}["message_base"] = $this->message;
                } else {
                    if (is_string($this->{$property}) || empty($this->{$property})) {
                        $this->{$property} = $this->message;
                    } else {
                        if (is_object($this->{$property})) {
                            $this->{$property}->message = $this->message;
                        }
                    }
                }
            }
            $item = $this->convertData($this->{$property});
            if ($item) {
                $data[$key] = $item;
            }
        }
        return $data;
    }
    private function getPropertyName($columnName)
    {
        return self::$fields[$columnName];
    }
    protected function convertData($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        } else {
            if (is_object($value)) {
                $value = serialize($value);
            }
        }
        return $value;
    }
    public function save()
    {
        $model = $this->getModel();
        if ($this->id) {
            $model->find($this->id)->update($this->getDataToSave());
        } else {
            $data = $this->getDataToSave();
            $data["date"] = \Carbon\Carbon::now();
            $model->create($data);
        }
        return $this;
    }
    public function toArray()
    {
        return ["id" => $this->id, "ref_id" => $this->getReferenceId(), "ref_type" => $this->getReferenceNamespace(), "message" => $this->getMessage(), "type" => $this->getType(), "typeLabel" => $this->getTypeLabel(), "level" => $this->getLevelLabel(), "request" => $this->getRequest(), "response" => $this->getResponse(), "before_vars" => $this->getBeforeVars(), "vars" => $this->getVars(), "date" => $this->getDate()];
    }
    public function toStdClass()
    {
        $data = new \stdClass();
        $data->id = $this->id;
        $data->ref_id = $this->getReferenceId();
        $data->ref_type = $this->getReferenceNamespace();
        $data->message = $this->getMessage();
        $data->type = $this->getType();
        $data->typeLabel = $this->getTypeLabel();
        $data->level = $this->getLevelLabel();
        $data->request = $this->getRequest();
        $data->response = $this->getResponse();
        $data->before_vars = $this->getBeforeVars();
        $data->vars = $this->getVars();
        $data->date = $this->getDate();
        return $data;
    }
    public static function convertToId($data)
    {
        if (is_array($data) && isset($data["id"])) {
            return $data["id"];
        }
        if (is_object($data) && method_exists($data, "getKeyName")) {
            return $data->{$data->getKeyName()};
        }
        if (is_object($data) && $data->id !== NULL) {
            return $data->id;
        }
    }
    public static function convertToClassName($data)
    {
        if (is_array($data) && isset($data["className"])) {
            return $data["className"];
        }
        if (is_object($data)) {
            $class = get_class($data);
            return $class;
        }
    }
}

?>