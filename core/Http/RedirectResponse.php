<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http;

/**
 * Description of RedirectResponse
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class RedirectResponse extends \Symfony\Component\HttpFoundation\RedirectResponse
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
    public static function createMG($controller = NULL, $action = NULL, $params = [])
    {
        return new $this(\ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getUrl($controller, $action, $params));
    }
    public static function createByUrl($url = "", $params = [])
    {
        return new $this($url . (count($params) . "0" ? "?" . http_build_query($params) : ""));
    }
}

?>