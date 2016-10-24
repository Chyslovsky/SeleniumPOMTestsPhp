<?php
namespace tests;
use applicationLogic\ApplicationManager;
use applicationLogic\UserHelper;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use model\Repository;
use model\User;

use PHPUnit_Framework_TestCase;



/**
 * Class Test
 *
 * java -jar  -Dwebdriver.chrome.driver=F:\QA_things\openServer\OpenServer\domains\GithubTests\vendor\chromedriver.exe F:\QA_things\openServer\OpenServer\domains\GithubTests\vendor\selenium-server-standalone-3.0.1.jar
 *
 *
 */

class Test extends PHPUnit_Framework_TestCase
{

    /**
     * Write Github.com username and password to run tests
     */
    private $userName = 'chyslovsky@gmail.com';
    private $userPassword = 'ch214365';
    /**
     * @var ApplicationManager
     */
    private  $app;
    /**
     * @var UserHelper
     */
    private $userHelper;
    /**
     * @var RemoteWebDriver $driver
     */
    protected $driver;
    /**
     * @var User
     */
    private $user;



    public function setUp()
    {


        $this->driver = RemoteWebDriver::create(
            'http://localhost:4444/wd/hub',
            array(
                WebDriverCapabilityType::BROWSER_NAME

                => WebDriverBrowserType::CHROME,
            )
        );

        $this->app = ApplicationManager::getApplicationManager();
        $this->app->setWebDriver($this->driver);
        $this->userHelper = $this->app->getUserHelper();
        $this->userHelper->setWebDriver($this->driver);
        $this->driver->manage()->timeouts()->implicitlyWait(10);
        $this->driver->get('https://github.com');
        $this->user = new User($this->userName, $this->userPassword);



    }


    public function testLogin()
    {

        $this->userHelper->mayBeLogout();
        $user = new User($this->userName, $this->userPassword);
        $this->userHelper->loginAs($user);
        self::assertTrue($this->userHelper->isLoggedIn(),$this->driver->getTitle());


    }

    public function testLogout()
    {
        if ($this->userHelper->isNotLoggedIn())  $this->userHelper->loginAs($this->user);

        $this->userHelper->logout();
        self::assertTrue($this->userHelper->isNotLoggedIn(),$this->driver->getTitle());

    }

    public function testRepositoryCreate()
    {
        if ($this->userHelper->isNotLoggedIn())  $this->userHelper->loginAs($this->user);
        $repository = new Repository("testRepository");
        $this->userHelper->createRepository($repository);
        self::assertTrue($this->userHelper->isRepositoryCreated($repository));

    }

    public function tearDown()
    {
        $this->driver->quit();
    }


}

