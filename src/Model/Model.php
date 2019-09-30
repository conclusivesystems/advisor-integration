<?php namespace Consys\Advisor\Integration\Model;

use Consys\Advisor\Integration\IntegrationException;
use Consys\Advisor\Integration\Writer\Writer;
use Validator;

abstract class Model
{
    private $attributes = [];

    private $saved = false;

    static protected $rules = [];

    public function __construct(array $data, Writer $writer)
    {
        $this->writer = $writer;

        foreach($data as $key => $value)
        {
            if($value === null)
            {
                unset($data[$key]);
            }

            if(!isset(static::$rules[$key]))
            {
                throw new IntegrationException("Invalid field: \"" . $key . "\" for model:\n" . var_export($data, true));
            }
        }

        $validator = Validator::make($data, static::$rules);

        if($validator->fails())
        {
            throw new IntegrationException("Invalid data:\n" . var_export($validator->errors(), true) . "\nModel:\n" . var_export($data, true));
        }

        $this->attributes = $data;
    }

    public function get($var)
    {
        if(isset(static::$rules[$var]) && isset($this->attributes[$var])) return $this->attributes[$var];

        return null;
    }

    static public function fields()
    {
        return array_combine(array_keys(static::$rules), array_keys(static::$rules));
    }

    public function save()
    {
        if($this->saved)
        {
            throw new IntegrationException("Cannot save the same model twice.");
        }

        $this->saved = true;

        $this->write();
    }

    abstract protected function write();
}