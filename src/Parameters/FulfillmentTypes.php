<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace ProductFlow\KauflandPhpClient\Parameters;

class FulfillmentTypes
{
    public const KAUFLAND   = 'fulfilled_by_kaufland';
    public const MERCHANT   = 'fulfilled_by_merchant';

    public function getList(): array
    {
        return [
            self::KAUFLAND,
            self::MERCHANT
        ];
    }
}