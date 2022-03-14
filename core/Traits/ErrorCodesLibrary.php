<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Traits;

interface ErrorCodesLibrary
{
    /** 
     * @var ErrorCodesLib
     */
    protected $errorCodesCoreHandler = NULL;
    /** 
     * @var ErrorCodesLib
     */
    protected $errorCodesAppHandler = NULL;
    public function loadErrorCodes();
    public function genErrorCode($code);
}

?>