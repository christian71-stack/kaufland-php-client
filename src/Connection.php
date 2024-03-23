<?php

namespace ProductFlow\KauflandPhpClient;

use Composer\InstalledVersions;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use ProductFlow\KauflandPhpClient\Options\Locale;
use ProductFlow\KauflandPhpClient\Options\Storefront;
use Psr\Http\Message\ResponseInterface;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandNoCredentialsException;

class Connection
{
    public const URL = 'https://sellerapi.kaufland.com/v2/';

    public const USERAGENT = 'Kaufland-php-client';

    protected string $client_key;

    protected string $secret_key;

    protected Locale $locale;

    protected Storefront $storefront;

    /**
     * Contains the HTTP client (Guzzle)
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * @throws KauflandNoCredentialsException
     */
    public function __construct(string $client_key, string $secret_key, Locale $locale, Storefront $storefront)
    {
        $this->client_key = $client_key;
        $this->secret_key = $secret_key;
        $this->locale     = $locale;
        $this->storefront = $storefront;
    }

    private function signRequest($method, $uri, $body, $timestamp, $secret_key): string
    {
        $string = implode("\n", [
            $method,
            $uri,
            $body,
            $timestamp,
        ]);

        return hash_hmac('sha256', $string, $secret_key);
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        $this->client = $this->client ??
            new Client([
                'base_uri' => self::URL,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Shop-Client-Key' => $this->client_key,
                    'User-Agent' => self::USERAGENT.'/'.InstalledVersions::getVersion('christian71-stack/kaufland-php-client')
                ]
            ]);

        return $this->client;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     * @throws KauflandException|GuzzleException
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            $body = '';
            $timestamp = time();

            $options['query'] = $options['query'] ?? [];

            $options['query'] = array_merge(
                [
                    Storefront::getQueryParameterName() => (string)$this->storefront,
                    Locale::getQueryParameterName() => (string)$this->locale,
                ],
                $options['query']
            );

            $query = '?' . http_build_query($options['query'], '', '&', PHP_QUERY_RFC3986);

            if (! empty($options['body'])) {
                $body = json_encode($options['body']);
                $options['body'] = json_encode($options['body']);
            }

            $header = [
                'Shop-Timestamp' => $timestamp,
                'Shop-Signature' => $this->signRequest(
                    $method,
                    self::URL . $uri . $query,
                    $body,
                    $timestamp,
                    $this->secret_key
                ),
                Locale::getQueryParameterName()    => (string)$this->locale
            ];

            $options['headers'] = $header;

            $response = $this->getClient()->request($method, $uri, $options);

            return $this->parseResponse($response);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->parseResponse($e->getResponse());
            }

            throw new KauflandException(
                'Kaufland error: ' . $e->getResponse()->getBody(),
                $e->getResponse()->getStatusCode(),
                $e
            );
        }
    }

    /**
     * @param ResponseInterface $response
     * @return array Parsed JSON result
     * @throws KauflandException
     */
    private function parseResponse(ResponseInterface $response): array
    {
        try {
            // Rewind the response (middlewares might have read it already)
            $response->getBody()->rewind();

            $response_body = $response->getBody()->getContents();
            $result_array = json_decode($response_body, true);

            if ($response->getStatusCode() === 204) {
                return [];
            }

            if (! is_array($result_array)) {
                throw new KauflandException(sprintf('Kaufland error %s: %s', $response->getStatusCode(), $response_body), $response->getStatusCode());
            }

            return $result_array;
        } catch (\RuntimeException $e) {
            throw new KauflandException(
                'Kaufland error: ' . $e->getMessage(),
                0,
                null,
                $e
            );
        }
    }
}
