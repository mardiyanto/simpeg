<?php



class WS
{
	/**
	 * @var mode string. mode 'sandbox2' => 'sandbox2.php', 'live2' => 'live2.php'
	 */
	public $mode = 'live2';
	//const MODE = 'sandbox';

	/**
	 * @var url string. Url web service feeder
	 */
	public $url = 'http://localhost:8082/ws/';

	public $username = '';

	public $password = '';



	public function execute($data, $type = 'json')
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_POST, 1); 

		$headers = array();

		if ($type == 'xml')
			$headers[] = 'Content-Type: application/xml';
		else
			$headers[] = 'Content-Type: application/json';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		if ($data) {
			if ($type == 'xml') {
				$data = stringXML($data);
			} else {
				$data = json_encode($data);
			}
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_URL, $this->url.$this->mode.'.php');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

	public function stringXML($data) {
		$xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
		$this->array_to_xml($data, $xml);
		return $xml->asXML();
	}

	protected function array_to_xml( $data, &$xml_data ) {
		foreach( $data as $key => $value ) {
			if( is_array($value) ) {
				$subnode = $xml_data->addChild($key);
				$this->array_to_xml($value, $subnode);
			} else {
				$xml_data->addChild("$key",$value);
			}
		}
	}
}