<?php

namespace Neer\Foundation\Http;

interface RequestInterface
{
    /**
     * @param $name
     * @param $value
     * @return mixed
     */
	public function input($name, $value);

    /**
     * @return mixed
     */
	public function all();

    /**
     * @return mixed
     */
	public function isJson();

    /**
     * @return mixed
     */
	public function getJson();

    /**
     * @param $method
     * @return mixed
     */
	public function isMethod($method);

    /**
     * @return mixed
     */
	public function getRequest();
}