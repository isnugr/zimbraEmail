<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Restrictions\Rules;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 07.11.19
 * Time: 09:58
 * Class ExtensionsValid
 */
class ExtensionsValid extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Restrictions\Interfaces\AbstractRule
{
    /**
     * @var string
     */
    protected $message = "extensionRequired";
    const EXTENSIONS = ["soap" => "SoapClient"];
    public function isValid()
    {
        foreach (EXTENSIONS as $extension => $class) {
            if (!class_exists($class)) {
                $this->addReplacement("extension", $extension);
                return false;
            }
        }
        return true;
    }
}

?>