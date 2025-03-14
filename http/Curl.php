<?php namespace Telegram\Http;

use Telegram\Http\Methods\Get;
use Telegram\Uri;

class Curl extends Base
{
	public function query(): Response
	{
		$curlHandle = curl_init();

		if ($this->headers){
			curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $this->headers);
		}

		curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, $this->httpMethod->toString());
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

		$url = $this->getUrl();

		if ($this->httpMethod instanceof Get){

			if (is_array($this->getBody())){
				$uri = new Uri($this->getUrl());

				foreach ($this->getBody() as $name => $value){
					$uri->addParam($name, $value);
				}

				$url = $uri->getUri();
			}
		}
		elseif ($fields = $this->getBody()) {
			if (is_array($this->getBody())){
				$fields = http_build_query($fields);
			}

			curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $fields);
		}

		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_HEADER, 1);

		$response = curl_exec($curlHandle);
		$responseCode = curl_getinfo($curlHandle, CURLINFO_RESPONSE_CODE);

		$info = curl_getinfo($curlHandle);

		curl_close($curlHandle);
		$header = substr($response, 0, $info['header_size']);
		$body = substr($response, -$info['download_content_length']);
		$status = strtok($header, "\r\n");

		$header = str_replace($status, "", $header);
		$header = trim($header);
		$headers = [];

		foreach (explode("\r\n", $header) as $h){
			if(false !== ($matches = explode(':', $h, 2))) {
				$headers[$matches[0]] = trim($matches[1]);
			}
		}

		return new Response(
			$responseCode,
			$status,
			$body,
			$headers
		);
	}
}
