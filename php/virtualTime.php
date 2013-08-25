<?php
	class virtualTime
	{
		public function getTime()
		{
			$jsonFileContents = file_get_contents('/var/www/WebDiP/2012_projekti/WebDiP2012_024/php/razmak.json');
			$json = json_decode($jsonFileContents, true);
			$timeOffset = $json['addTime'];
			return date('Y-m-d H:i:s', time()+ ($timeOffset*60*60));
		}

		public function setTime($timeOffset)
		{
			$offsetArray = array("addTime" => $timeOffset);
			$json = json_encode($offsetArray);
			file_put_contents('/var/www/WebDiP/2012_projekti/WebDiP2012_024/php/razmak.json', $json);
		}
	}
?>