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

use Exception;

class PAC
{
    /**
     * @var array
     */
    protected $pacs = [
        'InvoiceOne' => \Kinedu\CfdiPac\Strategies\InvoiceOneStrategy::class,
    ];

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
     * @var bool
     */
    protected $test;

    /**
     * Create a new pac instance.
     *
     * @param  string  $username
     * @param  string  $password
     * @param  string  $xml
     * @param  bool  $test
     */
    public function __construct(string $username, string $password, string $xml, bool $test = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->xml = $xml;
        $this->test = $test;
    }

    /**
     * @param  string  $method
     * @param  string  $arguments
     */
    public function __call(string $method, array $arguments)
    {
        $prefix = 'use';

        if ((substr($method, 0, 3) === $prefix)) {
            $name = substr($method, strlen($prefix));

            if ($pac = $this->pacs[$name]) {
                $p = new $pac(
                    $this->username,
                    $this->password,
                    $this->xml,
                    $this->test
                );

                return $p;
            } else {
                throw new Exception("This method doesn't exist");
            }
        }
    }
}
