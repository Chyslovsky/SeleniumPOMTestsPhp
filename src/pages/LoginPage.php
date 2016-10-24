<?php

namespace pages;


use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use model\User;

class LoginPage extends BasePage
{
    private $url='https://github.com/login';
    /**
     * LoginPage constructor.
     * @param RemoteWebDriver $webDriver
     */
    public function __construct(RemoteWebDriver $webDriver)
    {
        parent::__construct($webDriver);
        $this->webDriver->get('https://github.com/login');
    }


    public function setUsernameField(User $user)
    {
        $username = $this->webDriver->findElement(WebDriverBy::cssSelector("#login_field"));
        $username->sendKeys($user->getLogin());
        return $this;
    }

    public function setPasswordField(User $user)
    {

        $password = $this->webDriver->findElement(WebDriverBy::cssSelector('#password'));
        $password->sendKeys($user->getPassword());
        return $this;
    }

    public function clickSubmitButton()
    {
        $this->webDriver->findElement(WebDriverBy::cssSelector('.btn'))->click();
        return $this;
    }

}