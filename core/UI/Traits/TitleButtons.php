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
interface TitleButtons
{
    protected $titleButtons = [];
    public function removeTitleButtons();
    public function addTitleButton($button);
    public function titleButtonIsExist();
    public function insertTitleButton($buttonId);
    public function getTitleButtons();
}

?>