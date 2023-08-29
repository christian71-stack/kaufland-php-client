<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use GuzzleHttp\Exception\GuzzleException;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Products extends Model
{
    public const EMBEDDED_CATEGORY = 'category';

    /**
     * @param $ean
     * @return array
     */
    public function getBySearch(string $term, $limit = null, $offset = null, $embedded = null)
    {
        return $this->connection->request('GET', "products/search/{$term}");
    }

    /**
     * @param $ean
     * @param array $attributes
     * @return array
     */
    public function getByEan(string $ean): array
    {
        return $this->connection->request('GET', "products/ean/{$ean}");
    }

    /**
     * @param string $productId
     *
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function getByProductId(string $productId, $embedded = self::EMBEDDED_CATEGORY): array
    {
        return $this->connection->request('GET', "products/{$productId}");
    }
}
