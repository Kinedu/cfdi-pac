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

use Kinedu\CfdiPac\PACSoapRequest;
use SoapClient;

class InvoiceOneStrategy extends PACSoapRequest
{
    /**
     * @var string
     */
    const WSDL_ENDPOINT = 'https://invoiceone.mx/TimbreCFDI/timbrecfdi.asmx?WSDL';

    /**
     * @return stdClass
     */
    protected function makeRequest()
    {
        $client = new SoapClient(static::WSDL_ENDPOINT, $this->options);

        if ($this->test) {
            return $client->ObtenerCFDIPrueba([
                'usuario' => $this->username,
                'contrasena' => $this->password,
                'xmlComprobante' => $this->xml,
            ]);
        }
    }

    /**
     * @return string
     */
    public function getXML() : string
    {
        $request = $this->makeRequest();

        return $request->ObtenerCFDIPruebaResult->Xml;
    }
}
