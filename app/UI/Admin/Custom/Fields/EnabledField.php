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
 * Date: 12.11.19
 * Time: 10:49
 * Class EnabledField
 */
class EnabledField extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\BaseField
{
    protected $id = "enabledField";
    protected $name = "enabledField";
    protected $title = "field_enabled_";
    protected $enabled = false;
    protected $rawType = false;
    const TYPE_SUCCESS = "success";
    const TYPE_DEFAULT = "default";
    public function isEnabled()
    {
        return $this->enabled;
    }
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
    public function getType()
    {
        if ($this->getRawType()) {
            return $this->getRawType();
        }
        if ($this->isEnabled()) {
            $type = TYPE_SUCCESS;
        } else {
            $type = TYPE_DEFAULT;
        }
        return $type;
    }
    public function getTitle()
    {
        if ($this->titleRaw) {
            return $this->titleRaw;
        }
        if ($this->isEnabled()) {
            $title = $this->title . TYPE_SUCCESS;
        } else {
            $title = $this->title . TYPE_DEFAULT;
        }
        return $title;
    }
    public function getRawType()
    {
        return $this->rawType;
    }
    public function setRawType($rawType)
    {
        $this->rawType = $rawType;
    }
}

?>