<?php namespace Consys\Advisor\Integration;

use Consys\Advisor\Integration\Model\CatalogCourse;
use Consys\Advisor\Integration\Model\Equivalency;
use Consys\Advisor\Integration\Model\Prerequisite\Prerequisite;
use Consys\Advisor\Integration\Model\ScheduleCourse;
use Consys\Advisor\Integration\Model\User;
use Consys\Advisor\Integration\Writer\Writer;

/**
 * Class Driver
 * @package Consys\Advisor\Integration
 */
abstract class Driver
{
    private $writer = null;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    protected final function addCatalogCourse(array $data)
    {
        return new CatalogCourse($data, $this->writer);
    }

    protected final function addUser(array $data)
    {
        return new User($data, $this->writer);
    }

    protected final function addEquivalency(array $data)
    {
        return new Equivalency($data, $this->writer);
    }

    protected final function addScheduleCourse(array $data)
    {
        return new ScheduleCourse($data, $this->writer);
    }

    protected final function addPrerequisite()
    {
        return new Prerequisite([], $this->writer);
    }

    protected final function error($message)
    {
        throw new IntegrationException($message);
    }

    abstract public function getCatalog();
    abstract public function getUsers();
    abstract public function getUser(string $identifier);
    abstract public function getEquivalencies();
    abstract public function getSchedule();
    abstract public function getPrerequisites();
}
