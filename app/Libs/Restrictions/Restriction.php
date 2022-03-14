<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Restrictions;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 07.11.19
 * Time: 09:58
 * Class Restriction
 */
class Restriction extends Interfaces\AbstractRestriction
{
    public function check()
    {
        if ($this->rule->isValid() !== false) {
            return true;
        }
        $this->setIsValid(STATUS_INVALID);
        $this->setErrorMessage($this->rule->getMessage());
        if ($this->isThrowErrorEnabled()) {
            throw new \Exception($this->getErrorMessage());
        }
        return $this->isValid();
    }
}

?>