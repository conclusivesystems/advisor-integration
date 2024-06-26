<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\Writer\Writer;
use Validator;

class DeliveryMethods extends Model
{
    static protected $rules = [
    ];

    public function __construct(Writer $writer)
    {
        parent::__construct([], $writer);

        $this->writer->startArray("delivery_methods");
    }

    public final function addDeliveryMethod(array $data)
    {
        return new DeliveryMethod($data, $this->writer);
    }

    protected function write()
    {
        $this->writer->endArray();
    }
}
