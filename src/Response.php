<?php namespace Consys\Advisor\Integration;

use Consys\Advisor\Integration\Model\Catalog;
use Consys\Advisor\Integration\Model\Equivalencies;
use Consys\Advisor\Integration\Model\Model;
use Consys\Advisor\Integration\Model\Options;
use Consys\Advisor\Integration\Model\Prerequisites;
use Consys\Advisor\Integration\Model\Schedule;
use Consys\Advisor\Integration\Model\Sports;
use Consys\Advisor\Integration\Model\Terms;
use Consys\Advisor\Integration\Model\Users;
use Consys\Advisor\Integration\Writer\Writer;

class Response extends Model
{
    static protected $rules = [
        'request_id' => "required|integer",
    ];

    public function __construct(Writer $writer, int $requestId = 0)
    {
        parent::__construct(['request_id' => $requestId], $writer);

        $this->writer = $writer;

        $this->writer->startObject('response');
        $this->writer->startProperty("id");
        $this->writer->value($requestId);
        $this->writer->endProperty();
        $this->writer->startProperty("version");
        $this->writer->value("2.0");
        $this->writer->endProperty();
    }

    public final function addCatalog()
    {
        return new Catalog($this->writer);
    }

    public final function addTerms()
    {
        return new Terms($this->writer);
    }

    public final function addEquivalencies()
    {
        return new Equivalencies($this->writer);
    }

    public final function addOptions(array $options)
    {
        return new Options($options, $this->writer);
    }

    public final function addPrerequisites()
    {
        return new Prerequisites($this->writer);
    }

    public final function addSchedule()
    {
        return new Schedule($this->writer);
    }

    public final function addUsers()
    {
        return new Users($this->writer);
    }

    public final function addSports()
    {
        return new Sports($this->writer);
    }

    protected function write()
    {
        $this->writer->endObject();
        $this->writer->close();
    }
}
