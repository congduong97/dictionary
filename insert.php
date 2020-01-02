<?php
//code format file dictionary
// 	$order1   = "\\n";
//     $replace1 = '<br />';
//     $order2 = "'";
//     $replace2 = "\'";
	
// 	$fh = fopen('en_vi.txt','r');
// 	$fh2 = fopen('convertdata.txt','w');
// 	while ($line = fgets($fh)) {
// 		$tempstr = str_replace($order1, $replace1, $line);
// 		$newstr = str_replace($order2, $replace2, $tempstr);
// 		fwrite($fh2,$newstr);

// }
// fclose($fh);
// fclose($fh2);
//FOrmat dau nhay don..
// $order = "'";
// $replace = "\'";

// echo"<br/>";
// $f = fopen('anhviet109K.txt','r');
// $f2 = fopen('convertdata.txt','w');
// while($line = fgets($f)){
//     $newstr = str_replace($order, $replace, $line);
//     fwrite($f2,$newstr);
// }

// fclose($f);
// fclose($f2);

$servername = "localhost";
$username = "root";
$password = "";
$db = "demo_dictionary";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

// $sql = "SELECT * FROM dictionarydata WHERE word='am'";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "id: " . $row["id"]. " - word: " . $row["word"]. "<br>Spelling: " . $row["spelling"]."<br>type:".$row["type"]."<br>meaning :".$row["meaning"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }

echo"<br/>";
$fh = fopen('convertdata.txt','r');
$word = "";
$spelling="";
$type = "";
$meaning = "";

set_time_limit(600);

do {
	$line = fgets($fh);

	if (strpos($line,'@') !== false || feof($fh) ) {
	
		if( $word !== ""  && $spelling !== "" && $type !== "" && $meaning !== ""){
	
			 $sql = "INSERT INTO dictionarydata (word,spelling,type,meaning) VALUES ('$word','$spelling','$type','$meaning')";
			if ($conn->query($sql) === TRUE) {
				$type="";
				$meaning = "";
				$spelling = "";
				$word = "";
        	} else {
             	echo "Error: " . $sql . "<br>" . $conn->error;
        	}
			
		}
			
			list($word,$spelling)=explode(" /",$line);
			$word =preg_replace('/[^\sA-Za-z]/i','', $word);
			// echo"tet".$word."<br>";
			$spelling = "/".$spelling;
		
	
	}
	else if (strpos($line, '*') !== false) {
		if($type !== ''){
			$sql = "INSERT INTO dictionarydata (word,spelling,type,meaning) VALUES ('$word','$spelling','$type','$meaning')";
			if ($conn->query($sql) === TRUE) {
				
        	} else {
             	echo "Error: " . $sql . "<br>" . $conn->error;
        	}
		}
		$type =$line;
		$meaning = '';
	}
	else{
		$meaning .="<br>". $line;
		
	}
	
} while(!feof($fh));
echo "<br/>Done!";
fclose($fh);
$conn->close();

// ?>


	

