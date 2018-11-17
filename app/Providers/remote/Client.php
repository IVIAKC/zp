<?php

namespace App\Providers\remote;


class Client
{
    const DEFAULT_URL = 'api.zp.ru';
    const DEFAULT_PROTOCOL = 'https';
    const DEFAULT_API_VERSION = 'v1';

    /** @var string $url */
    protected $url;
    /** @var string $version */
    protected $version;
    /** @var string $protocol */
    protected $protocol;

    /**
     * Client constructor.
     * @param string|null $url
     * @param string|null $protocol
     * @param string|null $version
     */
    public function __construct(string $url = null, string $protocol = null, string $version = null)
    {
        $this->url = $url ?? static::DEFAULT_URL;
        $this->protocol = $protocol ?? static::DEFAULT_PROTOCOL;
        $this->version = $version ?? static::DEFAULT_API_VERSION;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function send(Request $request): Response
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
            if (isset($response['metadata']['errors'])) {
                throw new \RuntimeException('error!');
            }
            $count = $response['metadata']['resultset']['count'];
            $result = array_merge($result, array_pop($response));

        } while ($request->addOffset($count));

        curl_close($curl);

        return new Response($result);
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
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
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
