<?php
/**
 * Class Feeds
 * handles the feeds methods
 */
class Feeds
{
    /**
     * @var array $errors error messages
     */
    public $errors = array();
    /**
     * @var array $messages messages list
     */
    public $messages = array();
	
    public function __construct()
    {
		$this->connection = $this->connection();
		$this->data = $this->listData($this->connection);
    }
	
	/**
	 * Curl Get
	 * 
	 */	
	public function httpGet($url, $request_headers = array())
	{
		$ch = curl_init();
		$request_headers[] = 'AOKey: '. $request_headers["aokey"];
		$request_headers[] = 'AOToken: '. $request_headers["aotoken"];
		$request_headers[] = 'Accept: '. $request_headers["accept"];
	 
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		//curl_setopt($ch,CURLOPT_HEADER, false); 
	 
		$output=curl_exec($ch);
	 
		curl_close($ch);
		return $output;
	}
	
	/**
     * connection method
     */
    private function connection()
    {
		$login_username = 'webapiuser10';
		$login_password = md5('pr0punt3r++');
		$login_url = $this->httpGet("https://webapi.asianodds88.com/AsianOddsService/Login?accept=json&username=$login_username&password=$login_password");
		$login = json_decode( $login_url, true );
		
		return $login;
	}	
	
	/**
     * data list method
     */
    private function listData($connection)
    {
		$data = array("username" => $connection["Result"]["Username"],
					 "aokey" => $connection["Result"]["Key"],
					 "aotoken" => $connection["Result"]["Token"],
					 "accept" => "json");
		
		return $data;
	}
	
	/**
     * Register token to API
     */
	private function register($data)
	{
		$register_url = $this->httpGet("https://webapi.asianodds88.com/AsianOddsService/Register?username=".$data["username"], $data);
		$register = json_decode( $register_url, true );
	}
	
	/**
     * list of feeds method
     */
    public function listFeeds()
    {
		$x = $this->register($this->data);
		$getfeeds_url = $this->httpGet("https://webapi.asianodds88.com/AsianOddsService/GetFeeds?accept=".$this->data["accept"]."&AOToken=".$this->data["aotoken"]."&marketTypeId=1", $this->data);

		$getfeeds = json_decode( $getfeeds_url, true );
		$feeds_list = $getfeeds["Result"]["Sports"];
		
		return $feeds_list;
	}
	
    /**
     * list of league method
     */
    public function listLeagues()
    {
		if($this->connection["Result"]["SuccessfulLogin"] !== false){
			$this->register($this->data);
			
			$getleague_url = $this->httpGet("https://webapi.asianodds88.com/AsianOddsService/GetLeagues?accept=".$this->data["accept"]."&AOToken=".$this->data["aotoken"]."&marketTypeId=1", $this->data);

			$getleague = json_decode( $getleague_url, true );
			$league_list = $getleague["Result"]["Sports"][1]["League"];
			
			return $league_list;
		}
	}
	
		
    /**
     * api logout method
     */
    public function logout()
    {
		$logout_url = httpGet("https://webapi.asianodds88.com/AsianOddsService/Logout?accept=".$this->data["accept"]."&AOToken=".$this->data["aotoken"]);
		
		$logout = json_decode( $logout_url, true );
	}
}