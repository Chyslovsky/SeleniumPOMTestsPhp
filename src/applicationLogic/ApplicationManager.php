<?php
namespace applicationLogic;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;

class ApplicationManager
{
    /**
     * @var RemoteWebDriver $driver
     */
    private $webDriver;


    public function setWebDriver($webDriver)
    {
        $this->webDriver = $webDriver;
    }

    /**
     * @return mixed
     */
    public function getWebDriver()
    {
        return $this->webDriver;
    }

    private static $ApplicationManager = null;

    public function getUserHelper()
    {
        return UserHelper::getUserHelper($this->webDriver);
    }

    /**
     * @return self
     */
    public static function getApplicationManager()
    {
        if (null === self::$ApplicationManager) {
            self::$ApplicationManager = new self();
        }
        return self::$ApplicationManager;
    }


    private function __construct()
    {

    }

    protected function __clone()
    {

    }
}