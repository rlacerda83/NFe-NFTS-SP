<?php

namespace NotaFiscalSP\Builders;

use NotaFiscalSP\Constants\Params;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Helpers\General;

class BaseEntitiesBuilder
{
    public static function makeBaseInformation($params)
    {
        $baseInformation = new BaseInformation();
        $baseInformation->setCnpj(General::getPath($params, Params::CNPJ));
        $baseInformation->setCpf(General::getPath($params, Params::CPF));
        $baseInformation->setCertificate($params);
        $baseInformation->setCertificatePass(General::getPath($params, Params::CERTIFICATE_PASS));
        $baseInformation->setIm(General::getPath($params, Params::IM));
        return $baseInformation;

    }
}