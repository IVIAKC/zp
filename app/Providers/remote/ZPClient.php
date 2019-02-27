<?php

namespace App\Providers\remote;

class ZPClient
{
    const DEFAULT_URL = 'api.zp.ru';
    const DEFAULT_PROTOCOL = 'https';
    const DEFAULT_API_VERSION = 'v1';

    /** @var string */
    protected $url;

    /** @var string */
    protected $version;

    /** @var string */
    protected $protocol;

    public function __construct(
        string $url = self::DEFAULT_URL,
        string $protocol = self::DEFAULT_PROTOCOL,
        string $version = self::DEFAULT_API_VERSION
    ) {
        $this->url = $url;
        $this->protocol = $protocol;
        $this->version = $version;
    }

    public function send(Request $request): Response
    {
        $curl = curl_init();
        $url = $this->getFullUrl();

        $result = [];
        do {
            curl_setopt($curl, CURLOPT_URL, sprintf('%s%s', $url, $request->getParams()));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, 0);

            $response = $this->getResponse(curl_exec($curl));
            if (isset($response['metadata']['errors'])) {
                throw new \RuntimeException('error!');
            }

            $result = array_merge($result, array_pop($response));
        } while (
//            false
            $request->addOffset($response['metadata']['resultset']['count'])
        );

        curl_close($curl);

        return new Response($result);
    }

    public function getFullUrl(): string
    {
        return sprintf('%s://%s/%s/', $this->protocol, $this->url, $this->version);
    }

    public function getResponse($output): array
    {
        return json_decode($output, true);
    }
}
