<?php if(session_id() == ""){
	session_start();
}?>
<style type="text/css">
div.terms
{
	min-width: 100%;
	min-height: 505px;
	overflow: auto;
}
</style>

<div class="terms">

<?php
	function parseColor($str){
		$str = str_replace("[0;30;22m", "�0", $str);
		$str = str_replace("[0;34;22m", "�1", $str);
		$str = str_replace("[0;32;22m", "�2", $str);
		$str = str_replace("[0;36;22m", "�3", $str);
		$str = str_replace("[0;31;22m", "�4", $str);
		$str = str_replace("[0;35;22m", "�5", $str);
		$str = str_replace("[0;33;22m", "�6", $str);
		$str = str_replace("[0;37;22m", "�7", $str);
		$str = str_replace("[0;30;1m", "�8", $str);
		$str = str_replace("[0;34;1m", "�9", $str);
		$str = str_replace("[0;32;1m", "�a", $str);
		$str = str_replace("[0;36;1m", "�b", $str);
		$str = str_replace("[0;31;1m", "�c", $str);
		$str = str_replace("[0;35;1m", "�d", $str);
		$str = str_replace("[0;33;1m", "�e", $str);
		$str = str_replace("[0;37;1m", "�f", $str);
		$str = str_replace("[m", "�r", $str);
		$str = str_replace("[21m", "�l", $str);
		$str = str_replace("[9m", "�m", $str);
		$str = str_replace("[4m", "�n", $str);
		$str = str_replace("[3m", "�o", $str);
		$str = str_replace("[5m", "�k", $str);
		
		$str = MineToWeb($str);
		return $str;
	}
	echo parseColor(str_replace("\n", "<br>", (rtrim(shell_exec("tail -n 20 /var/mpcp2/servers/".$_SESSION["server"]["id"]."/logs/latest.log"), "\n"))));
	
	
	function MineToWeb($minetext){
		preg_match_all("/[^�&]*[^�&]|[�&][0-9a-z][^�&]*/", $minetext, $brokenupstrings);
		$returnstring = "";
		foreach ($brokenupstrings as $results){
			$ending = '';
			foreach ($results as $individual){
				$code = preg_split("/[&�][0-9a-z]/", $individual);
				preg_match("/[&�][0-9a-z]/", $individual, $prefix);
				if (isset($prefix[0])){
					$actualcode = substr($prefix[0], 1);
					switch ($actualcode){
						case "1":
							$returnstring = $returnstring.'<FONT COLOR="0000AA">';
							$ending = $ending ."</FONT>";
							break;
						case "2":
							$returnstring = $returnstring.'<FONT COLOR="00AA00">';
							$ending =$ending ."</FONT>";
							break;
						case "3":
							$returnstring = $returnstring.'<FONT COLOR="00AAAA">';
							$ending = $ending ."</FONT>";
							break;
						case "4":
							$returnstring = $returnstring.'<FONT COLOR="AA0000">';
							$ending =$ending ."</FONT>";
							break;
						case "5":
							$returnstring = $returnstring.'<FONT COLOR="AA00AA">';
							$ending =$ending . "</FONT>";
							break;
						case "6":
							$returnstring = $returnstring.'<FONT COLOR="FFAA00">';
							$ending =$ending ."</FONT>";
							break;
						case "7":
							$returnstring = $returnstring.'<FONT COLOR="AAAAAA">';
							$ending = $ending ."</FONT>";
							break;
						case "8":
							$returnstring = $returnstring.'<FONT COLOR="555555">';
							$ending =$ending ."</FONT>";
							break;
						case "9":
							$returnstring = $returnstring.'<FONT COLOR="5555FF">';
							$ending =$ending . "</FONT>";
							break;
						case "a":
							$returnstring = $returnstring.'<FONT COLOR="55FF55">';
							$ending =$ending ."</FONT>";
							break;
						case "b":
							$returnstring = $returnstring.'<FONT COLOR="55FFFF">';
							$ending = $ending ."</FONT>";
							break;
						case "c":
							$returnstring = $returnstring.'<FONT COLOR="FF5555">';
							$ending =$ending ."</FONT>";
							break;
						case "d":
							$returnstring = $returnstring.'<FONT COLOR="FF55FF">';
							$ending =$ending ."</FONT>";
							break;
						case "e":
							$returnstring = $returnstring.'<FONT COLOR="FFFF55">';
							$ending = $ending ."</FONT>";
							break;
						case "f":
							$returnstring = $returnstring.'<FONT COLOR="FFFFFF">';
							$ending =$ending ."</FONT>";
							break;
						case "l":
							if (strlen($individual)>2){
								$returnstring = $returnstring.'<span style="font-weight:bold;">';
								$ending = "</span>".$ending;
								break;
							}
						case "m":
							if (strlen($individual)>2){
								$returnstring = $returnstring.'<strike>';
								$ending = "</strike>".$ending;
								break;
							}
						case "n":
							if (strlen($individual)>2){
								$returnstring = $returnstring.'<span style="text-decoration: underline;">';
								$ending = "</span>".$ending;
								break;
							}
						case "o":
							if (strlen($individual)>2){
								$returnstring = $returnstring.'<i>';
								$ending ="</i>".$ending;
								break;
							}
						case "r":
							$returnstring = $returnstring.$ending;
							$ending = '';
							break;
					}
					if (isset($code[1])){
						$returnstring = $returnstring.$code[1];
						if (isset($ending)&&strlen($individual)>2){
							$returnstring = $returnstring.$ending;
							$ending = '';
						}
					}
				}
				else{
					$returnstring = $returnstring.$individual;
				}
	
			}
		}
	
		return $returnstring;
	}
?>
</div>