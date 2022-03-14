<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Form DataProvider related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface FormDataProvider
{
    /**
     * Providing save and load data functionalities for Forms
     * @var \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\FormDataProviderInterface
     */
    protected $dataProvider = NULL;
    protected $providerClass = "";
    public function loadProvider();
    public function setProvider(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\FormDataProviderInterface $provider);
    public function getFormData();
}

?>