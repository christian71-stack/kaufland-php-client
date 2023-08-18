<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use GuzzleHttp\Exception\GuzzleException;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Info extends Model
{
    /**
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function getLocales(): array
    {
        $data = $this->connection->request('GET', 'info/locale');

        if (!isset($data['data'])) {
            throw new KauflandException("Locales info response doesn't contain expected structure.");
        }

        return $data['data'];
    }

    /**
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function getStorefronts(): array
    {
        $data = $this->connection->request('GET', "info/storefront");

        if (!isset($data['data'])) {
            throw new KauflandException("Storefront info response doesn't contain expected structure.");
        }

        return $data['data'];
    }
}
