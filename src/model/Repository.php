<?php
namespace model;


class Repository
{
    private $repositoryName;
    private $repositoryDescription;

    /**
     * @return mixed
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @return string
     */
    public function getRepositoryDescription()
    {
        return $this->repositoryDescription;
    }

    /**
     * Repository constructor.
     * @param $repositoryName
     * @param string $repositoryDescription
     */
    public function __construct($repositoryName, $repositoryDescription= "Test Repository created by test")
    {
        $this->repositoryName = $repositoryName;
        $this->repositoryDescription = $repositoryDescription;
    }
}