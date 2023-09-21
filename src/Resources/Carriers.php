<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Carriers extends Model
{
    /**
     * @return array
     */
    public function list()
    {
        return $this->connection->request('GET', 'carriers', ['query' => $this->getQuery()]);
    }
}
