<?php
namespace Bytepath\FlashBang;

use Illuminate\Session\SessionManager;

class Flasher
{
    /**
     * The SessionManager
     * @var Session
     */
    protected $session = null;

    /**
     * The Log manager
     */
    protected $log = null;

    /**
     * FlashBang constructor.
     */
    public function __construct($log, $session)
    {
        $this->log = $log;
        $this->session = $session;
    }

    /**
     * Get any session messages meant to be passed along to the end user
     */
    public function getMessage()
    {
        $message = $this->session->get("message");
        if($message)
        {
            $retVal = [];
            $retVal["message"] = $message;
            $retVal["messageClass"] = $this->session->get("messageClass");
            $retVal["route"] = $this->session->get("route");
            return json_encode($retVal);
        }
        else
        {
            return null;
        }
    }

    /**
     * Flash a success message to the user
     * @param string $message the message to display
     * @param null $logMessage will add a message and stack trace to log if supplied
     */
    public function success($message = "Success!", $logMessage = null)
    {
        $this->flash($message, "success", $logMessage, "success");
    }

    /**
     * Flash a failure message to the user
     * @param string $message the message to display
     * @param null $logMessage will add a message and stack trace to log if supplied
     */
    public function failure($message = "Failure!", $logMessage = null)
    {
        $this->flash($message, "danger", $logMessage, "error");
    }

    /**
     * Flash an informational message to the user
     * @param string $message the message to display
     * @param null $logMessage will add a message and stack trace to log if supplied
     */
    public function info($message, $logMessage = null)
    {
        $this->flash($message, "info", $logMessage);
    }

    /**
     * Flash a warning message to the user
     * @param string $message the message to display
     * @param null $logMessage will add a message and stack trace to log if supplied
     */
    public function warning($message, $logMessage = null)
    {
        $this->flash($message, "warning", $logMessage, "warning");
    }

    /**
     * Flash a message to the user
     * @param $message
     * @param $class
     * @param null $logMessage is supplied then a log entry will be added as well as a stack trace.
     */
    protected function flash($message, $class, $logMessage = null, $logMethod = "info")
    {
        if($logMessage) {
            $this->log->{$logMethod}($logMessage, []);
        }

        //Add a flash message to inform the user that there was an error
        $this->session->flash('message', $message);
        $this->session->flash('messageClass', "alert-" . $class);
    }
}