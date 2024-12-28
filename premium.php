<?php

// Warna teks
const n = "\n";          // Baris baru
const d = "\033[0m";     // Reset
const m = "\033[1;31m";  // Merah
const h = "\033[1;32m";  // Hijau
const k = "\033[1;33m";  // Kuning
const b = "\033[1;34m";  // Biru
const u = "\033[1;35m";  // Ungu
const c = "\033[1;36m";  // Cyan
const p = "\033[1;37m";  // Putih
const o = "\033[38;5;214m"; // Warna mendekati orange
const o2 = "\033[01;38;5;208m"; // Warna mendekati orange

// Warna teks tambahan
const r = "\033[38;5;196m";   // Merah terang
const g = "\033[38;5;46m";    // Hijau terang
const y = "\033[38;5;226m";   // Kuning terang
const b1 = "\033[38;5;21m";   // Biru terang
const p1 = "\033[38;5;13m";   // Ungu terang
const c1 = "\033[38;5;51m";   // Cyan terang
const gr = "\033[38;5;240m";  // Abu-abu gelap

// Warna latar belakang
const mp = "\033[101m\033[1;37m";  // Latar belakang merah
const hp = "\033[102m\033[1;30m";  // Latar belakang hijau
const kp = "\033[103m\033[1;37m";  // Latar belakang kuning
const bp = "\033[104m\033[1;37m";  // Latar belakang biru
const up = "\033[105m\033[1;37m";  // Latar belakang ungu
const cp = "\033[106m\033[1;37m";  // Latar belakang cyan
const pm = "\033[107m\033[1;31m";  // Latar belakang putih (merah teks)
const ph = "\033[107m\033[1;32m";  // Latar belakang putih (hijau teks)
const pk = "\033[107m\033[1;33m";  // Latar belakang putih (kuning teks)
const pb = "\033[107m\033[1;34m";  // Latar belakang putih (biru teks)
const pu = "\033[107m\033[1;35m";  // Latar belakang putih (ungu teks)
const pc = "\033[107m\033[1;36m";  // Latar belakang putih (cyan teks)
const yh = d."\033[43;30m"; // Latar belakang kuning (black teks)

// Warna latar belakang tambahan
const bg_r = "\033[48;5;196m";   // Latar belakang merah terang
const bg_g = "\033[48;5;46m";    // Latar belakang hijau terang
const bg_y = "\033[48;5;226m";   // Latar belakang kuning terang
const bg_b1 = "\033[48;5;21m";   // Latar belakang biru terang
const bg_p1 = "\033[48;5;13m";   // Latar belakang ungu terang
const bg_c1 = "\033[48;5;51m";   // Latar belakang cyan terang
const bg_gr = "\033[48;5;240m";  // Latar belakang abu-abu gelap

Class Requests {
	static function Curl($url, $head=0, $post=0, $data_post=0, $cookie=0, $proxy=0, $skip=0){while(true){$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);curl_setopt($ch, CURLOPT_COOKIE,TRUE);if($cookie){curl_setopt($ch, CURLOPT_COOKIEFILE,$cookie);curl_setopt($ch, CURLOPT_COOKIEJAR,$cookie);}if($post) {curl_setopt($ch, CURLOPT_POST, true);}if($data_post) {curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);}if($head) {curl_setopt($ch, CURLOPT_HTTPHEADER, $head);}if($proxy){curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);curl_setopt($ch, CURLOPT_PROXY, $proxy);}curl_setopt($ch, CURLOPT_HEADER, true);$r = curl_exec($ch);if($skip){return;}$c = curl_getinfo($ch);if(!$c) return "Curl Error : ".curl_error($ch); else{$head = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));$body = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));curl_close($ch);if(!$body){print "Check your Connection!";sleep(2);print "\r                         \r";continue;}return array($head,$body);}}}
	static function get($url, $head =0){return self::curl($url,$head);}
	static function post($url, $head=0, $data_post=0){return self::curl($url,$head, 1, $data_post);}
	static function getXskip($url, $head =0){return self::curl($url,$head,'','','','',1);}
	static function postXskip($url, $head=0, $data_post=0){return self::curl($url,$head, 1, $data_post,'','',1);}
	static function getXcookie($url, $head=0, $cookie=0){if(!$cookie){$cookie ="cookie.txt";}return self::curl($url,$head,'','',$cookie);}
	static function postXcookie($url, $head=0, $data_post=0, $cookie=0){if(!$cookie){$cookie ="cookie.txt";}return self::curl($url,$head,1,$data_post,$cookie);}
	static function getXproxy($url, $head=0, $proxy){return self::curl($url,$head,'','',1,$proxy);}
	static function postXproxy($url, $head=0, $data_post, $proxy){return self::curl($url,$head,1,$data_post,1,$proxy);}
}

class Display {
	static function Clear(){if( PHP_OS_FAMILY == "Linux" ){system('clear');}else{pclose(popen('cls','w'));}} 
	static function Menu($no, $title){print h."---[".p."$no".h."] ".k."$title\n";}
	static function Cetak($label, $msg = "[No Content]"){$len = 9;$lenstr = $len-strlen($label);print h."[".p.$label.h.str_repeat(" ",$lenstr)."]─> ".p.$msg.n;}
	static function Title($activitas){print bp.str_pad(strtoupper($activitas),50, " ", STR_PAD_BOTH).d.n;}
	static function Line($len = 50){print y.str_repeat('─',$len).n;}
	static function Ban($title, $versi){
		$api = self::ipApi();
		self::Clear();
		if($api){
			date_default_timezone_set($api->timezone);
			print str_pad($api->city.', '.$api->regionName.', '.$api->country, 50, " ", STR_PAD_BOTH).n;
		}
		print yh.' '.date("l").'            '.date("d/M/Y").'           '.date("H:i").' '.d."\n";
		print " ".strtoupper($title." [".$versi."]").n;
		print o2."╔═╗╔═╗╦═╗╔╦╗╔═╗╔╦╗╔═╗═╗ ╦\n";
		print o."╠═╝║╣ ╠╦╝ ║ ╠═╣║║║╠═╣╔╩╦╝\n";
		print y."╩  ╚═╝╩╚═ ╩ ╩ ╩╩ ╩╩ ╩╩ ╚═\n";
		print mp.str_pad("SCRIPT NOT FOR SALE", 50, " ", STR_PAD_BOTH).d.n.n;
	}
	static function ipApi(){
		$r = json_decode(file_get_contents("http://ip-api.com/json"));
		if($r->status == "success")return $r;
	}
	static function Error($except){return m."---[".p."!".m."] ".p.$except;}
	static function Sukses($msg){return h."---[".p."✓".h."] ".p.$msg.n;}
	static function Isi($msg){return m."╭[".p."Input ".$msg.m."]".n.m."╰> ".h;}
}

class Functions {
	static $configFile = "config.json";
	static function Tmr($tmr){date_default_timezone_set("UTC");$sym = [' ─ ',' / ',' │ ',' \ ',];$timr = time()+$tmr;$a = 0;while(true){$a +=1;$res=$timr-time();if($res < 1) {break;}print $sym[$a % 4].p.date('H',$res).":".p.date('i',$res).":".p.date('s',$res)."\r";usleep(100000);}print "\r           \r";}
	static function Server($title){$url = "https://iewilbot.my.id/List/server.php";$param = "title=".$title;$r = file_get_contents($url."?".$param);return json_decode($r,1);}
	static function setConfig($key){if(!file_exists(self::$configFile)){$config = [];}else{$config = json_decode(file_get_contents(self::$configFile),1);}if(isset($config[$key])){return $config[$key];}else{print Display::isi($key);$data = readline();print n;$config[$key] = $data;file_put_contents(self::$configFile,json_encode($config,JSON_PRETTY_PRINT));return $data;}}
	static function removeConfig($key){$config = json_decode(file_get_contents(self::$configFile),1);unset($config[$key]);file_put_contents(self::$configFile,json_encode($config,JSON_PRETTY_PRINT));}
	static function view($youtube){$tanggal = date("dmy");$config = json_decode(file_get_contents(self::$configFile),1);$view = $config['view'];if($tanggal == $view){return 0;}else{$config['view'] = $tanggal;if( PHP_OS_FAMILY == "Linux" ){system("termux-open-url ".$youtube);}else{system("start ".$youtube);}file_put_contents(self::$configFile,json_encode($config,JSON_PRETTY_PRINT));}}
	static function HiddenConfig($key, $data){if(!file_exists(self::$configFile)){$config = [];}else{$config = json_decode(file_get_contents(self::$configFile),1);}if(!$config[$key]){$config[$key] = $data;file_put_contents(self::$configFile,json_encode($config,JSON_PRETTY_PRINT));}return $config[$key];}
	static function temporary($newdata,$data=0){if(!$data){$data = [];}return array_merge($data,$newdata);}
	static function cfDecodeEmail($encodedString){$k = hexdec(substr($encodedString,0,2));for($i=2,$email='';$i<strlen($encodedString)-1;$i+=2){$email.=chr(hexdec(substr($encodedString,$i,2))^$k);}return $email;}
	static function getConfig($key){if(!file_exists(self::$configFile)){$config = [];}else{$config = json_decode(file_get_contents(self::$configFile),1);}return $config[$key];}
}

class HtmlScrap {
	function __construct(){
		$this->captcha = '/class=["\']([^"\']+)["\'][^>]*data-sitekey=["\']([^"\']+)["\'][^>]*>/i';
		$this->input = '/<input[^>]*name=["\'](.*?)["\'][^>]*value=["\'](.*?)["\'][^>]*>/i';
		$this->limit = '/(\d{1,})\/(\d{1,})/';
	}
	private function scrap($pattern, $html){preg_match_all($pattern, $html, $matches);return $matches;}
	private function getCaptcha($html){$scrap = $this->scrap($this->captcha, $html);for($i = 0; $i < count($scrap[1]); $i++){$data[$scrap[1][$i]] = $scrap[2][$i];}return $data;}
	private function getInput($html, $form = 1){$form = explode('<form', $html)[$form];$scrap = $this->scrap($this->input, $form);for($i = 0; $i < count($scrap[1]); $i++){$data[$scrap[1][$i]] = $scrap[2][$i];}return $data;}
	public function Result($html, $form = 1)
	{
		$data['title'] = explode('</title>',explode('<title>', $html)[1])[0];
		$data['cloudflare']=(preg_match('/Just a moment.../',$html))? true:false;
		$data['firewall'] =(preg_match('/Firewall/',$html))? true:false;
		$data['locked'] = (preg_match('/Locked/',$html))? true:false;
		$data["captcha"] = $this->getCaptcha($html);
		
		$input = $this->getInput($html, $form);
		$data["input"] = ($input)? $input:$this->getInput($html, 2);
		$data["faucet"] = $this->scrap($this->limit, $html);
		
		$sukses = explode("icon: 'success',",$html)[1];
		if($sukses){
			$data["response"]["success"] = strip_tags(explode("'",explode("html: '",$sukses)[1])[0]);
		}else{
			$warning = explode("'",explode("html: '",$html)[1])[0];
			$ban = explode('</div>',explode('<div class="alert text-center alert-danger"><i class="fas fa-exclamation-circle"></i> Your account',$html)[1])[0];
			$invalid = (preg_match('/invalid amount/',$html))? "You are sending an invalid amount":false;
			$shortlink = (preg_match('/Shortlink in order to claim from the faucet!/',$html))? $warning:false;
			$sufficient = (preg_match('/sufficient funds/',$html))? "Sufficient funds":false;
			$daily = (preg_match('/Daily claim limit/',$html))? "Daily claim limit":false;
			$data["response"]["unset"] = false;
			$data["response"]["exit"] = false;
			if($ban){
				$data["response"]["warning"] = $ban;
				$data["response"]["exit"] = true;
			}elseif($invalid){
				$data["response"]["warning"] = $invalid;
				$data["response"]["unset"] = true;
			}elseif($shortlink){
				$data["response"]["warning"] = $shortlink;
				$data["response"]["exit"] = true;
			}elseif($sufficient){
				$data["response"]["warning"] = $sufficient;
				$data["response"]["unset"] = true;
			}elseif($warning){
				$data["response"]["warning"] = $warning;
			}else{
				$data["response"]["warning"] = "Not Found";
			}
		}
		return $data;
	}
}
class PERTAMAX {
	function __construct($apikey, $originalLicense){
		$this->url = "https://api-iewil.my.id/FREE/";
		$this->apikey = $apikey;
		$this->headers = $originalLicense;
	}
	private function requests($postParameter){
		$ch = curl_init($this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postParameter);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ["user-agent: ".$this->headers]);
		$response = curl_exec($ch);
		if(!curl_errno($ch)) {
			switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
				case 200:  # OK
					break;
				default:
					return '{"status":0, "message":"iewilbot HTTP code "'.$http_code.'}';
			}
		}
		curl_close($ch);
		return $response;
	}
	private function getResult($postParameter){
		$r = json_decode($this->requests($postParameter),1);
		if($r && !$r['error'])return $r['result'];
		if($r["msg"]){
			print substr($r["msg"],0,30);
			sleep(2);
			print "\r                                   \r";
		}
		if(!$r)print "captcha cannot be solve\n";
	}
	public function IconCoordiant($base64Img){
		$postParameter = http_build_query([
			"img"		=> $base64Img,
			"method"	=> "icon_coordinat",
			"apikey"	=> $this->apikey
		]);
		return $this->getResult($postParameter);
	}
	public function Antibot($source){
		$data["apikey"] = $this->apikey;
		$data["method"] = "antibot";
		
		$main = explode('"',explode('src="',explode('Bot links',$source)[1])[1])[0];
		$data["main"] 	= $main;
		$src = explode('rel=\"',$source);
		foreach($src as $x => $sour){
			if($x == 0)continue;
			$no = explode('\"',$sour)[0];
			$img = explode('\"',explode('src=\"',$sour)[1])[0];
			$data[$no] = $img;
		}
		$postParameter = http_build_query($data);
		$res = $this->getResult($postParameter);
		unset($data["apikey"]);
		unset($data["method"]);
		unset($data["main"]);
		if(isset($res["solution"])){
			$cap = $res["solution"];
			$cek = explode(",", $cap);
			for($i=0;$i<count($data);$i++){
				if(!$cek[$i]){
					return;
				}
			}
			return " ".str_replace(","," ",$cap);
		}
	}
}
class License{
	private function sysUnique(){
		if( PHP_OS_FAMILY == "Linux" ){
			exec("getprop", $output);
			$data_sys = [];
			foreach($output as $system){
				if(isset(explode("[", $system)[1])){
					$key = explode("]", explode("[", $system)[1])[0];
					$value= explode("]", explode("[", $system)[2])[0];
					$data_sys[$key] = $value;
				}
			}
			$unique = $data_sys["ro.build.fingerprint"];
		}else{
		  exec("wmic csproduct get UUID", $output);
		  $unique = $output[1];
		}
		return $unique;
	}
	private function CheckLicense($originalLicense, $licenseMD5){
		$url = 'https://api-iewil.my.id/License/index.php';
		$data = array(
			'license' => $licenseMD5
		);
		$postdata = http_build_query($data);

		$options = array(
			'http' => array(
				'method'  => 'POST',
				'header'  => "Content-Type: application/x-www-form-urlencoded\r\n" .
                     "User-Agent: ".$originalLicense."\r\n",
				'content' => $postdata
			)
		);
		$context = stream_context_create($options);
		return json_decode(file_get_contents($url, false, $context));
	}
	private function Loading() {
		$colors = [
			"\033[48;5;16m",  // Black
			"\033[48;5;24m",  // Dark blue
			"\033[48;5;34m",  // Green
			"\033[48;5;44m",  // Blue
			"\033[48;5;54m",  // Light blue
			"\033[48;5;64m",  // Violet
			"\033[48;5;74m",  // Purple
			"\033[48;5;84m",  // Purple-Blue
			"\033[48;5;94m",  // Light purple
			"\033[48;5;104m"  // Pink
		];
		$text = "Chek License...";
		$textLength = strlen($text);
		for ($i = 1; $i <= $textLength; $i++) {
			usleep(150000);
			$percent = round(($i / $textLength) * 100); 
			$bgColor = $colors[$i % count($colors)];
			$coloredText = substr($text, 0, $i);
			$remainingText = substr($text, $i);
			echo $bgColor . $coloredText . "\033[0m" . $remainingText . " {$percent}% \r";
			flush();
		}
	}
	public function loadLisense(){
		$originalLicense = $this->sysUnique()."iewilofficial";
		$licenseMD5 = strtoupper(md5($originalLicense));
		$cek = $this->CheckLicense($originalLicense, $licenseMD5);
		if($cek->error){
			print Display::Error("Lisense tidak di temukan");
			exit;
		}
		$status = $cek->status;
		$this->Loading();
		
		print Display::Sukses("License: ".$licenseMD5);
		if($status == "off"){
			print Display::Error("Lisensi anda berakhir, hubungi @fat9ght untuk memperpanjang\n");
			exit;
		}elseif($status == "pending"){
			print Display::Error("Lisensi anda belum aktif, silahkan hubungi @fat9ght untuk aktifkan lisensi\n");
			exit;
		}elseif($status == "aktif"){
			print Display::Sukses("Lisensi berhasil");
			sleep(3);
		}else{
			print Display::Error("Lisense tidak di temukan");
			exit;
		}
		return [$cek->license,$originalLicense];
	}
}
