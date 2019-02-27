<?php

/*
 * This file is part of the cfdi-certificate project.
 *
 * (c) Kinedu
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kinedu\CfdiPac\Strategies;

use SoapClient;
use Kinedu\CfdiPac\PACSoapRequest;

class InvoiceOneStrategy extends PACSoapRequest
{
    /**
     * Invoice one endpoint
     *
     * @var string
     */
    const WSDL_ENDPOINT = 'https://invoiceone.mx/TimbreCFDI/timbrecfdi.asmx?WSDL';

    /**
     * Invoice One Soap request.
     *
     * @return stdClass
     */
    protected function makeRequest()
    {
        $client = new SoapClient(static::WSDL_ENDPOINT, $this->options);

        return $client->{$this->getMethodName()}([
            'usuario' => $this->username,
            'contrasena' => $this->password,
            'xmlComprobante' => $this->xml,
        ]);
    }

    /**
     * Returns the cfdi with the TFD node.
     *
     * @return string
     */
    public function getXML(): string
    {
        $request = $this->makeRequest();

        $resultName = $this->getMethodName().'Result';

        return $request->{$resultName}->Xml;
    }

    /**
     * Soap method name.
     *
     * @return string
     */
    protected function getMethodName(): string
    {
        return ($this->test) ? 'ObtenerCFDIPrueba' : 'ObtenerCFDI';
    }
}
