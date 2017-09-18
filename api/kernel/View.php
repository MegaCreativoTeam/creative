<?php 

require_once PATH_API .'kernel'.DS. "ViewJSON.php";
require_once PATH_API .'kernel'.DS. "ViewXML.php";

abstract class ViewAPI
{
    //Código de error
    public
		$status,
		$module,
		$statusText;
	
    public abstract function response( $body, $header = [] );

}


class View {
	private 
		$_format,
		$_status,
		$_statusText,
		$_icon = 'info';

		
	function __construct( ) { }
	
	/**
	 * Undocumented function
	 *
	 * @param integer $status
	 * @return void
	 */
	public function initialize( $status = 400 )
	{
		$this->_status = $status;
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $format
	 * @return void
	 */
	public function set_format( $format )
	{
		$this->_format = $format;
	}
	
	/**
     * Imprime el cuerpo de la respuesta y setea el código de respuesta
     * @param mixed $body de la respuesta a enviar
     */
	public function response($status, $body)
	{
		
		$response = [];
		
		$this->_status = $status;
		
		$response['status']= $this->_status;
		$response['statusText']= $this->_statusText ? $this->_statusText : $this->get_http_status_text($this->_status);
		$response['time'] = date('d/m/Y H:m:s');
		$response['icon'] = $this->_icon;
		
		if( $this->_status == 200 OR $this->_status == 201 ){
			http_response_code($this->_status);
		}

		$response = array_merge($response, $body);
		ob_get_clean();
		ob_start();

		switch( $this->_format )
		{
			case 'xml':			
				
				header('Content-Type: text/xml; charset=utf-8');
		        $xml = new SimpleXMLElement('<response/>');
		        $this->parse($response, $xml);
		        echo $xml->asXML();
				
			break;

			case 'json':
			default:
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response, JSON_PRETTY_PRINT);
			break;
		}

		ob_end_flush(); 
		exit;        
    }
	
	public function parse($data, &$xml_data){
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }
                $subnode = $xml_data->addChild($key);
                self::parse($value, $subnode);
            } else {
                $xml_data->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
	
    public function get_http_status_text($status){
		$http_status = array(
			100 => 'Continue',  
			101 => 'Switching Protocols',  
			200 => 'OK',
			201 => 'Created',  
			202 => 'Accepted',  
			203 => 'Non-Authoritative Information',  
			204 => 'No Content',  
			205 => 'Reset Content',  
			206 => 'Partial Content',  
			300 => 'Multiple Choices',  
			301 => 'Moved Permanently',  
			302 => 'Found',  
			303 => 'See Other',  
			304 => 'Not Modified',  
			305 => 'Use Proxy',  
			306 => '(Unused)',  
			307 => 'Temporary Redirect',  
			400 => 'Bad Request',  
			401 => 'Unauthorized',  
			402 => 'Payment Required',  
			403 => 'Forbidden',  
			404 => 'Not Found',  
			405 => 'Method Not Allowed',  
			406 => 'Not Acceptable',  
			407 => 'Proxy Authentication Required',  
			408 => 'Request Timeout',  
			409 => 'Conflict',  
			410 => 'Gone',  
			411 => 'Length Required',  
			412 => 'Precondition Failed',  
			413 => 'Request Entity Too Large',  
			414 => 'Request-URI Too Long',  
			415 => 'Unsupported Media Type',  
			416 => 'Requested Range Not Satisfiable',  
			417 => 'Expectation Failed', 
			422 => 'Unprocessable Entity',
			500 => 'Internal Server Error',  
			501 => 'Not Implemented',  
			502 => 'Bad Gateway',  
			503 => 'Service Unavailable',  
			504 => 'Gateway Timeout',  
			505 => 'HTTP Version Not Supported');
		return $http_status[$status] ? $http_status[$status] : $http_status[500];
	}
    
    
}