<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Model;

/**
 * Description of AbstractModel
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
abstract class AbstractModel
{
    /**
     * @var string
     */
    protected $class = NULL;
    /**
     * @var string 
     */
    protected $message = NULL;
    /**
     * @var array
     */
    protected $trace = NULL;
    /**
     * @var string 
     */
    protected $date = NULL;
    /**
     * @var string
     */
    protected $time = NULL;
    public function __construct($class = "", $massage = "", $trace = [])
    {
        $this->date = date("Y-m-d");
        $this->time = date("H:i:s");
        $this->setClass($class)->setMessage($massage)->setTrace($trace);
    }
    public function getClass()
    {
        return $this->class;
    }
    public function setClass($class = "")
    {
        $this->class = $class;
        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message = "")
    {
        $this->message = $message;
        return $this;
    }
    public function getTrace()
    {
        return $this->trace;
    }
    public function setTrace($trace = [])
    {
        $this->trace = $trace;
        return $this;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date = "")
    {
        $this->date = $date;
        return $this;
    }
    public function getTime()
    {
        return $this->time;
    }
    public function setTime($time = "")
    {
        $this->time = $time;
        return $this;
    }
    public function getFullMessage()
    {
        return "[ " . $this->getClass() . " ]( " . $this->getDate() . " " . $this->getMessage() . " ) :\n" . $this->getMessage();
    }
}

?>