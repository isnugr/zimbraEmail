<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Form Sections Elements related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Sections
{
    protected $sections = [];
    public function addSection($section);
    public function getSection($id);
    public function getSections();
    protected function initSectionsContainer();
    public function validateSections($request);
}

?>