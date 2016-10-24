<?php
namespace pages;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use model\Repository;

class CreateRepositoryPage extends MainPage
{
        private $url="https://github.com/new";
    public function __construct(RemoteWebDriver $webDriver)
    {
        parent::__construct($webDriver);
        $this->url = $webDriver->getCurrentURL();
        $this->webDriver->get('https://github.com/new');
    }

    public function setRepositoryName(Repository $repository)
    {
        $repositoryName = $this->webDriver->findElement(WebDriverBy::cssSelector("#repository_name"));
        $repositoryName->sendKeys($repository->getRepositoryName());
        return $this;
    }
    public function setRepositoryDescription(Repository $repository)
    {
        $repositoryName = $this->webDriver->findElement(WebDriverBy::cssSelector("#repository_description"));
        $repositoryName->sendKeys($repository->getRepositoryDescription());
        return $this;
    }
    public function clickCreateRepositoryButton()
    {
        $this->webDriver->findElement(WebDriverBy::cssSelector('button.btn:nth-child(11)'))->click();
        return $this;
    }
}