<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces;

/**
 * FormDataProviderInterface Interface
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
final class FormDataProviderInterface
{
    public abstract function create();
    public abstract function read();
    public abstract function update();
    public abstract function delete();
    public abstract function getValueById($id);
}

?>