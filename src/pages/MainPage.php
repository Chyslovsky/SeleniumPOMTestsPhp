<?php
namespace pages;


use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use model\Repository;

class MainPage extends BasePage
{

    private function getUsername()
    {
        return  $this->webDriver->findElement(WebDriverBy::cssSelector('.js-select-button'))->getText();
    }

    private $url = 'https://github.com/dashboard';

    public function __construct(RemoteWebDriver $webDriver)
    {
        parent::__construct($webDriver);
        $this->url = $webDriver->getCurrentURL();
    }



    public function isRepositoryCreated($repositoryName)
    {
        $this->webDriver->get('https://github.com/dashboard');
       $rep= $this->webDriver->findElements(WebDriverBy::className('repo'));
        foreach ($rep as $repository )
        {
          $repname =  $repository->getText();
            if ($repname == $repositoryName) return true;
            echo $repname;
        }
        return false;
    }
}