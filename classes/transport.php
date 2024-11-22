<?php


class Transport
{
    private $url;
    private $apiKey;

    function __construct($url, $apiKey)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

    public function doRequest($data)
    {
        $ch = curl_init($this->url);

        // Set up the request headers
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . 'Bearer ' . $this->apiKey,
        ];

        // Set cURL options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute the API request
        $response = curl_exec($ch);

        // Check for cURL errors
        if ($response === false) {
            echo json_encode(['error' => 'Request Error: ' . curl_error($ch)]);
            curl_close($ch);
            exit;
        }

        // Close the cURL session
        curl_close($ch);

        return $response;
    }
}
