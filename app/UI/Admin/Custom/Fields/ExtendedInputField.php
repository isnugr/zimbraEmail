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
 * Date: 08.11.19
 * Time: 10:32
 * Class ExtendedInputField
 */
class ExtendedInputField extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "extendedInputField";
    protected $name = "extendedInputField";
    protected $fieldType = self::TYPE_DEFAULT;
    protected $rawDescription = NULL;
    const TYPE_PASSWORD = "password";
    const TYPE_EMAIL = "email";
    const TYPE_TEXT = "text";
    const TYPE_NUMBER = "number";
    const TYPE_DEFAULT = "text";
    public function getFieldType()
    {
        return $this->fieldType;
    }
    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;
        return $this;
    }
    public function getRawDescription()
    {
        return $this->rawDescription;
    }
    public function setRawDescription($rawDescription)
    {
        $this->rawDescription = $rawDescription;
        return $this;
    }
    public function isRawDescription()
    {
        return $this->rawDescription !== NULL;
    }
}

?>