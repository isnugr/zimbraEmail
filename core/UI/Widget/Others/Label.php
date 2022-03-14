<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Others;

/**
 * ModuleDescription
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Label extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $name = "mgLabel";
    protected $id = "mgLabel";
    protected $title = "mgLabel";
    protected $class = ["lu-label"];
    protected $message = NULL;
    protected $color = "FFFFFF";
    protected $backgroundColor = "FFFFFF";
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }
}

?>