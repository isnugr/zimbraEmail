<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * View Breadcrumb related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface ViewBreadcrumb
{
    protected $breadcrumbs = NULL;
    public function initBreadcrumbs();
    public function getBreadcrumbs();
    public function addBreadcrumb($url, $title, $order, $rawTitle);
    public function replaceBreadcrumbTitle($key, $value);
    public function disableBreadcrumb($key);
}

?>