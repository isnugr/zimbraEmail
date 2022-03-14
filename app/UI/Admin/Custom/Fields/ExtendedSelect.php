<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 02.10.19
 * Time: 10:08
 * Class ExtendedSelect
 */
class ExtendedSelect extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "extendedSelect";
    protected $name = "extendedSelect";
    protected $hidden = false;
    public function isHidden()
    {
        return $this->hidden;
    }
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
        return $this;
    }
    public function enableHidden()
    {
        return $this->setHidden(true);
    }
    public function disableHidden()
    {
        return $this->setHidden(false);
    }
}

?>