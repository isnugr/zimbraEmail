<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Description related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Description
{
    protected $description = "description";
    protected $raw = false;
    protected $allowHtmlTags = false;
    public function setDescription($description);
    public function getDescription();
    public function isRaw();
    public function setRaw($raw);
    public function allowHtmlTags();
    public function disallowHtmlTags();
    public function isHtmlTagsAllowed();
}

?>