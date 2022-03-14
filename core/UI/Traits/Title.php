<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Title elements related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Title
{
    protected $title = NULL;
    protected $titleRaw = NULL;
    protected $showTitle = true;
    public function setTitle($title);
    public function setRawTitle($title);
    public function isRawTitle();
    public function getRawTitle();
    public function getTitle();
    public function setShowTitle();
    public function unsetShowTitle();
    public function isShowTitle();
}

?>