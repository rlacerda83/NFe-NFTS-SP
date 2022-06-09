<?php

namespace NotaFiscalSP\Validators;

use NotaFiscalSP\Constants\Requests\ComplexFieldsEnum;
use NotaFiscalSP\Constants\Requests\DetailEnum;
use NotaFiscalSP\Constants\Requests\RpsEnum;
use NotaFiscalSP\Constants\Requests\SimpleFieldsEnum;
use NotaFiscalSP\Entities\BaseInformation;
use NotaFiscalSP\Entities\Requests\NF\Rps;
use NotaFiscalSP\Helpers\Certificate;

class RpsValidator
{
    public static function validateRps(BaseInformation $baseInformation, $rps)
    {
        $rpsOK = [];

        $processRPS = null;
        if ($rps instanceof Rps) {
            $processRPS = [$rps];
        }

        if (is_array($rps)) {
            $processRPS = $rps;
        }

        foreach ($processRPS as $item) {
            if ($item instanceof Rps) {
                $item = $item->toArray();
            }

            if (empty($item[SimpleFieldsEnum::IM_PROVIDER])) {
                $item[SimpleFieldsEnum::IM_PROVIDER] = $baseInformation->getIm();
            }
                

            $item[RpsEnum::ISS_RETENTION] = $item[RpsEnum::ISS_RETENTION] ? 'true' : 'false';

            $item[ComplexFieldsEnum::RPS_KEY] = true;
            $item[DetailEnum::SIGN] = Certificate::rpsSignatureString($item);
            $rpsOK[] = $item;
        }
        return $rpsOK;
    }
}
