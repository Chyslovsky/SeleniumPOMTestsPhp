<?php
namespace applicationLogic;


use Facebook\WebDriver\Remote\RemoteWebDriver;

use model\Repository;
use model\User;
use pages\CreateRepositoryPage;
use pages\LoginPage;
use pages\MainPage;


class UserHelper
{
    /**
     * @var RemoteWebDriver $driver
     */
    private $webDriver;

    /**
     * @param mixed $webDriver
     */
    public function setWebDriver($webDriver)
    {
        $this->webDriver = $webDriver;
    }

    public function isLoggedIn()
    {
        // $page = new MainPage($this->webDriver);
        $tmp= $this->webDriver->getTitle();
        return ($this->webDriver->getTitle() == "GitHub");

    }

    public function isNotLoggedIn()
    {
        //  $page = new MainPage($this->webDriver);
        $tmp= $this->webDriver->getTitle();
        return ($this->webDriver->getTitle() == "How people build software · GitHub");
    }

    public function loginAs(User $user)
    {
        $page = new LoginPage($this->webDriver);
        $page->setUsernameField($user)
            ->setPasswordField($user)
            ->clickSubmitButton();
    }




    public function createRepository(Repository $repository)
    {
        $page = new CreateRepositoryPage($this->webDriver);
        $page->setRepositoryName($repository)
            ->setRepositoryDescription($repository)
            ->clickCreateRepositoryButton();
    }

    public function isRepositoryCreated(Repository $repository)
    {
        $page = new MainPage($this->webDriver);
        return $page->isRepositoryCreated($repository->getRepositoryName());
    }



    public function logout()
    {
        $page = new MainPage($this->webDriver);
        $page->logout();
    }


    public function mayBeLogout()
    {
        if ($this->isLoggedIn()) {
            $this->logout();
        }
    }


    private static $userManager = null;

    public static function getUserHelper($webdriver)
    {
        if (null === self::$userManager) {
            self::$userManager = new self($webdriver);
        }
        return self::$userManager;
    }


    public function __construct($webdriver)
    {
        $this->webDriver = $webdriver;
    }

    protected function __clone()
    {

    }
}