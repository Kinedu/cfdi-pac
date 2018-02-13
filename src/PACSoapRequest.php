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

use DOMDocument;

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

    /**
     * Soap request.
     *
     * @return mixed
     */
    abstract protected function makeRequest();

    /**
     * Returns the cfdi with the TFD node.
     *
     * @return string
     */
    abstract public function getXML();

    /**
     * @param string $filename
     *
     * @return integer
     */
    public function save(string $filename)
    {
        $xml = new DOMDocument();
        $xml->preserveWhiteSpace = true;
        $xml->formatOutput = true;
        $xml->loadXML($this->getXML());

        return $xml->save($filename);
    }
}
