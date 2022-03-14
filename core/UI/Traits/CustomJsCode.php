<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Custom Js Code(per page) related functions
 * View Trait
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface CustomJsCode
{
    protected $customJsPath = NULL;
    protected $customCssPath = NULL;
    protected function getCustomAssetPath($class, $function, $assetType, $fileType, $forceReturn);
    public function getCustomJsCode();
    public function getCustomCssCode();
    public function trimPath($path);
    public function initCustomAssetFiles();
    public function debugGetAssetsPlacement();
}

?>