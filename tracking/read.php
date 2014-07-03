<?php
if(isset($_GET["track_id"])){
    $track_id = $_GET["track_id"];
}else{
    die("no ID 7illll");
}

$fileLoc = "log/log-$track_id.txt";
if(file_exists($fileLoc)){
    echo tailCustom($fileLoc)."<br>";
}else{
    echo "abcd";
} 
//    $coords = array();
//    $content = file_get_contents($fileLoc);
//    $lines = explode("\r\n",$content);
//    
//    foreach ($lines as $line){
//        $values = explode(",", $line);
//        if(count($values) == 3){  // coord
//            $coords[] = "[".$values[1].",".$values[2]."]";
//        }else if(count($values) == 2){  // end Date + EOF
//            die("Fall l zalame<br>");
//        }else if (count($values) == 1){ //start Date
//            echo("ba3ed ma ballach <br>");
//        }else{
//            die("error");
//        }
//    }
//}

function tailCustom($filepath, $lines = 1, $adaptive = true) {
 
		// Open file
		$f = @fopen($filepath, "rb");
		if ($f === false) return false;
 
		// Sets buffer size
		if (!$adaptive) $buffer = 4096;
		else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
 
		// Jump to last character
		fseek($f, -1, SEEK_END);
 
		// Read it and adjust line number if necessary
		// (Otherwise the result would be wrong if file doesn't end with a blank line)
		if (fread($f, 1) != "\n") $lines -= 1;
		
		// Start reading
		$output = '';
		$chunk = '';
 
		// While we would like more
		while (ftell($f) > 0 && $lines >= 0) {
 
			// Figure out how far back we should jump
			$seek = min(ftell($f), $buffer);
 
			// Do the jump (backwards, relative to where we are)
			fseek($f, -$seek, SEEK_CUR);
 
			// Read a chunk and prepend it to our output
			$output = ($chunk = fread($f, $seek)) . $output;
 
			// Jump back to where we started reading
			fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
 
			// Decrease our line counter
			$lines -= substr_count($chunk, "\n");
 
		}
 
		// While we have too many lines
		// (Because of buffer size we might have read too many)
		while ($lines++ < 0) {
 
			// Find first newline and remove all text before that
			$output = substr($output, strpos($output, "\n") + 1);
 
		}
 
		// Close file and return
		fclose($f);
		return trim($output);
 
	}

?>