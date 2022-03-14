<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http;

/**
 * Description of Request
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Request extends \Symfony\Component\HttpFoundation\Request
{
    public static function build()
    {
        $return = Request::createFromGlobals();
        return $return;
    }
    public function getAll()
    {
        return ["attributes" => $this->attributes->all(), "query" => $this->query->all(), "request" => $this->request->all()];
    }
    public function getSession($key = NULL, $default = NULL)
    {
        if ($key === NULL) {
            return $_SESSION;
        }
        if (isset($_SESSION[$key]) === true) {
            return $_SESSION[$key];
        }
        return $default;
    }
    public function getSessionId()
    {
        return session_id();
    }
    public function closeSession()
    {
        session_write_close();
        return $this;
    }
    public function addSession($key = NULL, $value = NULL)
    {
        if (is_array($key)) {
            global $_SESSION;
            foreach ($key as $k) {
                if (is_null($k)) {
                    $temp =& $temp[];
                } else {
                    $temp =& $temp[$k];
                }
            }
            $temp = $value;
            unset($temp);
        } else {
            if ($key != NULL) {
                $_SESSION[$key] = $value;
            } else {
                $_SESSION[] = $value;
            }
        }
    }
    public function removeSession($key = NULL)
    {
        if (is_array($key)) {
            $firstElement = $key[0];
            $dot = dot(\WHMCS\Session::get($firstElement));
            unset($key[0]);
            $dot->delete([implode(".", $key)]);
            \WHMCS\Session::set($firstElement, $dot->all());
        } else {
            if ($key != NULL) {
                unset($_SESSION[$key]);
            } else {
                unset($_SESSION);
            }
        }
    }
}

?>