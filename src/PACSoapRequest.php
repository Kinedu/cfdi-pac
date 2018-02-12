<?php

/*
 * This file is part of the cfdi-certificate project.
 *
 * (c) Kinedu
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kinedu\CfdiPac;

abstract class PACSoapRequest
{
    /**
     * Client username.
     *
     * @var string
     */
    protected $username;

    /**
     * Client password.
     *
     * @var string
     */
    protected $password;

    /**
     * CFDI XML.
     *
     * @var string
     */
    protected $xml;

    /**
     * @param bool
     */
    protected $test;

    /**
     * @var array
     */
    protected $options = [
        'soap_version' => SOAP_1_2,
        'trace' => 1,
    ];

    /**
     * Create a new invoice one strategy instance.
     *
     * @param string $username
     * @param string $password
     * @param string $xml
     * @param bool $test
     */
    public function __construct(string $username, string $password, string $xml, bool $test = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->xml = $xml;
        $this->test = $test;

        return $this;
    }

    abstract protected function makeRequest();

    abstract public function getXML();

    /**
     * @param string $filename
     */
    public function save(string $filename)
    {
        return file_put_contents($filename, $this->getXML());
    }
}
