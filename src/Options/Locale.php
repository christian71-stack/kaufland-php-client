<?php

namespace ProductFlow\KauflandPhpClient\Options;

use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Locale
{
    public const DE_DE = 'de-DE';

    public const CS_CZ = 'cs-CZ';

    public const SK_SK = 'sk-SK';

    public const PL_PL = 'pl-PL';

    public const AT_AT = 'de_AT';

    protected $current;

    public function __construct()
    {
        $this->current = self::DE_DE;
    }

    public function __toString()
    {
        return $this->current;
    }

    public function set(string $locale): self
    {
        if (!$this->inList($locale)) {
            throw new KauflandException($locale . ' is not available in locales list');
        }

        $this->current = $locale;

        return $this;
    }

    public function inList(string $locale)
    {
        return in_array(
            $locale,
            [
                self::DE_DE,
                self::CS_CZ,
                self::SK_SK,
                self::PL_PL,
                self::AT_AT,
            ]
        );
    }

    public static function getQueryParameterName(): string
    {
        return 'locale';
    }
}
