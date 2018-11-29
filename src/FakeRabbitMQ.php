<?php

namespace Kontoulis\RabbitMQLaravel;
use Kontoulis\RabbitMQLaravel\Broker\Broker;

/**
 * Class RabbitMQ
 * @package Kontoulis\RabbitMQLaravel
 */
class FakeRabbitMQ extends RabbitMQ
{
	/**
	 * Create a new Skeleton Instance
	 * @param $config
	 */
    public function __construct($config)
    {
    }
}
