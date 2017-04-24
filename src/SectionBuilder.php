<?php
namespace Ayeo\Barcode;

use Ayeo\Barcode\Model\Section;

class SectionBuilder
{
    public function build($identifier, $value)
    {
        if (array_key_exists($identifier, $this->data) === false) {
            throw new \LogicException(sprintf('Unknown application identifier %s', $identifier));
        }

        //fixme: the logic below belongs to Section domain

        $sectionData = $this->data[$identifier];

        if (strlen($value) < $sectionData[0]) {
            throw new \LogicException($sectionData[2]);
        }

        if (strlen($value) > $sectionData[1]) {
            throw new \LogicException($sectionData[2]);
        }

        if ($sectionData[0] === $sectionData[1]) {
            $fixedLength = true;
        } else {
            $fixedLength = false;
        }

        return new Section($identifier, $value, $fixedLength);
    }

    private $data = [
        '00' => [18, 18, 'SERIAL SHIPPING CONTAINER CODE (00) - must contains exact 18 digits'],
        '01' => [14, 14, 'GLOBAL TRADE ITEM NUMBER (01) - must contains excat 14 digits'],
        '02' => [14, 14, 'ITEM TRADE ITEM NUMBER (02) - must contains excat 14 digits'],
        '10' => [1, 20, 'BATCH NUMBER (10) - must contains between 1-20 digits'],
        '12' => [6, 6, 'PAYMENT DATE (12) - must be in YYMMDD format'],
        '15' => [6, 6, 'BEST BEFORE DATE (YYMMDD) - must bi in YYMMDD format'],
        '37' => [1, 8, 'NUMBER OF UNITS CONTAINED (37) - must contains between 1-8 digits'],
        '3301' => [6, 6, 'CONTAINER GROSS WEIGHT (KG) - must contains 6 chars'],
        '3900' => [1, 15, 'AMOUNT PAYABLE - SINGLE MONETARY AREA (3902) - must contains between 1-15 digits'],
        '400' => [1, 30, 'CUSTOMER PURCHASE ORDER NUMBER (400) - must contains between 1-30 digits'],
        '415' => [13, 13, 'GLOBAL LOCATION NUMBER OF THE INVOICE PARTY (415) - must contains excat 13 digits'],
        '8020' => [1, 25, 'PAYMENT SLIP REFERENCE NUMBER (8020) - must contains between 1-25 digits'],
        '96' => [1, 30, 'COMPANY INTERNAL INFORMATION (96) - must contains between 1-30 digits'],
    ];
}
