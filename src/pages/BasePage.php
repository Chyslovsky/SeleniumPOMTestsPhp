<?php
namespace pages;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

/**
 * Parent class for all pages
 */
class BasePage
{
    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    private $url;

    /**
     * BasePage constructor.
     * @param RemoteWebDriver $webDriver
     */
    public function __construct(RemoteWebDriver $webDriver)
    {
        $this->webDriver = $webDriver;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function getTitle()
    {
        return $this->webDriver->getTitle();
    }


    public function logout()
    {
        $this->webDriver->get("https://github.com/logout");
        $this->webDriver->findElement(WebDriverBy::cssSelector('.btn'))->click();
        return $this;

    }
}