<?php

namespace App\Entity;


class Client
{
    /** @var string $url */
    protected $url;

    /** @var string $version */
    protected $version;

    /** @var string $protocol */
    protected $protocol;

    const DEFAULT_URL = 'api.zp.ru';

    const DEFAULT_API_VERSION = 'v1';

    const DEFAULT_PROTOCOL = 'https';

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->url = static::DEFAULT_URL;
        $this->version = static::DEFAULT_API_VERSION;
        $this->protocol = static::DEFAULT_PROTOCOL;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function send(Request $request)
    {
        $curl = curl_init();

        $result = [];
        $url = $this->getFullUrl();

        do {
            curl_setopt($curl, CURLOPT_URL, $url . $request->getParams());
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, 0);

            $output = curl_exec($curl);

            $response = $this->getResponse($output);
            $result = array_merge($result, array_pop($response));
            $count = $response['metadata']['resultset']['count'];
            if (isset($response['metadata']['errors'])) {
                throw new \RuntimeException('error!');
            }
        } while ($request->addOffset($count) && false);

        curl_close($curl);

        $responseModel = new Response($result);

        return $responseModel;
    }

    /**
     * @return string
     */
    public function getFullUrl(): string
    {
        return $this->getProtocol() . '://' . $this->getUrl() . '/' . $this->getVersion() . '/';
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol(string $protocol): void
    {
        $this->protocol = $protocol;
    }

    /**
     * @param $output
     * @return array
     */
    public function getResponse($output): array
    {
        return json_decode($output, true);
    }
}
