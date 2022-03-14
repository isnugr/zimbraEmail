<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 08.10.19
 * Time: 11:22
 * Class ProcesStepHandler
 */
interface ProcessStepHandler
{
    /**
     * array with process in progress
     * @var array
     */
    protected $inProgressProcess = [];
    /**
     * array with completed process
     * @var array
     */
    protected $completedProcess = [];
    /**
     * array with process finished with error status
     * @var array
     */
    protected $errorProcess = [];
    /**
     * @var array
     */
    protected $allProcess = [];
    public function getInProgress();
    public function getCompleted();
    public function getErrorProcess();
    public function getAllProcess();
    public function startProcess($code);
    public function stopProcess($code);
    public function stopProcessWithError($code, $error);
    public function info();
}

?>