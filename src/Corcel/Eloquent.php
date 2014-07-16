<?php

namespace Corcel;

class Eloquent extends \Eloquent
{
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = array())
    {
        try
        {
            $this->connection = \Config::get('corcel.connection');
        }
        catch (Exception $e)
        {
            // pass
        }
        parent::__construct($attributes);
    }
}