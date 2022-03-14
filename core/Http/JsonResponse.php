<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http;

/**
 * Description of Json
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class JsonResponse extends \Symfony\Component\HttpFoundation\JsonResponse
{
    protected $lang = NULL;
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }
    public function getLang()
    {
        return $this->lang;
    }
    public function setData($data = [])
    {
        try {
            return self::setData($data);
        } catch (\Exception $e) {
            return self::setData(\ModulesGarden\Servers\ZimbraEmail\Core\Helper\Converter\Json::encodeUTF8($data));
        }
    }
    public function getData()
    {
        $data = NULL;
        if (defined("HHVM_VERSION")) {
            $data = json_decode($this->data, true, 512, $this->encodingOptions);
        } else {
            try {
                $data = json_decode($this->data, true, 512, $this->encodingOptions);
            } catch (\Exception $e) {
                if ("Exception" === get_class($e) && 0 === strpos($e->getMessage(), "Failed calling ")) {
                    throw $e->getPrevious() ?: $e;
                }
                \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\JsonResponse", $e->getMessage(), $e->getTrace());
            }
        }
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }
        return $data;
    }
    public function withSuccess($message = "")
    {
        $data = $this->getData();
        $data["status"] = "success";
        $data["message"] = $message;
        $this->setData($data);
        return $this;
    }
    public function withError($message = "")
    {
        $data = $this->getData();
        $data["status"] = "success";
        $data["message"] = $message;
        $this->setData($data);
        return $this;
    }
}

?>