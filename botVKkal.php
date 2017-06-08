<?php
//рабочий сука варик!!!
//https://w.qiwi.com/mobile/main.action?&amountInteger=100&extra%5B%27account%27%5D=79131092684
	$token = "22599e3edd058eb179fa0bb13a9603b7ffb8b0723deb208468aee384397c6be78e5c3879843bdf17ae931";
	$getData = "https://api.vk.com/method/messages.get?access_token=".$token."";
	$result = file_get_contents($getData);
	$json = json_decode($result, true);
	$newMessage = array();
	$phone = "123";
	$bank = "123";
	$datePay = "123";
	$summa = "0123";
	$todayDate = date('Y-m-d');
	$x = true;
	$y = false;
	foreach ($json as $key => $value) {
	    if (is_array($value)) {
	        foreach ($value as $key => $val) {
	        	$key1 = $key;
	        }
	    }
	}
	for ($i = $key1; $i > 0; $i--) { 
		if($json['response'][$i]['read_state'] == 0){
			$y = true;
			$newMessage[0] = $json['response'][$i]['uid'];
			$newMessage[1] = $json['response'][$i]['body'];
			$userName = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=".$newMessage[0].""), true);
			$userName = $userName['response'][0]['first_name'];
		}
	}
	///////////////проверка на наличие в БД///////////////////////////////
	$servername = "localhost";
		$username = "top4ek";
		$password = "q2w3e4r5";
		$dbname = "usersVK";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

	$sql = "SELECT uid FROM usersVK";
	$result = $conn->query($sql);
	///////////////////////////////////////////////////////////////////////

	///////////////запишем uid и имя///////////////////////////////
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        if($row['uid'] == $newMessage[0]){
	        	$x = false;
	        }
	    }
	    if($x && isset($newMessage)){
			$sql = "INSERT INTO usersVK (id, uid, firstName)
			VALUES (NULL, '".$newMessage[0]."', '".$userName."')";

			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				 echo "Error: " . $sql . "<br>" . $conn->error;
			}
	    }
	}
	$conn->close();



	//////////////////////оповещение//////////////////////////////////////////
	function checkWeek(){
		$servername = "localhost";
			$username = "top4ek";
			$password = "q2w3e4r5";
			$dbname = "usersvk";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SELECT phone, summa, uid, checkWeek FROM usersvk WHERE (datePay-$todayDate) <= 7";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	if($row['checkWeek'] == 0){
			        	sendMessage("Осталось%20меньше%20недели%20оплатите!!!%20http://top4ek.pw/href.php?summa=".$row["summa"]."%26phone=".$row["phone"]."",$newMessage[0]);
						updateCheck($row['uid']);
						//$sql = "UPDATE usersvk SET $checkWeek='1' WHERE uid=$row['uid']";
					}

			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
	}
	///////////////////////////////////////////////////////////////////////////
	checkWeek();
	/////////телефон///////////////////////////////////////////////////////
	if(iconv_strlen($newMessage[1]) == 11 && is_numeric($newMessage[1])){
		sendMessage('Я%20записал%20твой%20номер%20-'.$newMessage[1].'.%20Пожалуйста,%20введи%20сумму%20пополнения(максимум%20-15000%20рублей).<br>Неправильный%20номер?%20Введи%20заново:)',$newMessage[0]);
		connectbd("phone",$newMessage[1],$newMessage[0]);
	}
	////////////////////////////////////////////////////////////////////
	if(is_numeric($newMessage[1]) && $newMessage[1] <= '15000' && $newMessage[1] > 0){
		sendMessage('Сумма%20-'.$newMessage[1].'%20?%20Если%20верно,%20то%20введите%20"да".%20Если%20нет-%20напишите%20сумму%20еще%20раз:)',$newMessage[0]);
		connectbd("summa",$newMessage[1],$newMessage[0]);
	}
	if(is_numeric($newMessage[1]) && $newMessage[1] > '15000' && iconv_strlen($newMessage[1]) !== 11){
		sendMessage('Атата%20-'.$newMessage[1].'%20слишком%20большая%20сумма.%2015000-максимум',$newMessage[0]);
		//connectbd("summa",$newMessage[1],$newMessage[0]);
	}
	if($newMessage[1] == "Да" || $newMessage[1] == "да" || $newMessage[1] == "lf" || $newMessage[1] == "Lf"){
		sendMessage('Введите%20дату%20платежа%20в%20формате,%20год:месяц:день.%20Пример:%20"'.$todayDate.'".',$newMessage[0]);
	}
	if(strpos($newMessage[1], "2017-") !== false && iconv_strlen($newMessage[1]) == 10){
		connectbd("datePay",$newMessage[1],$newMessage[0]);
		$servername = "localhost";
			$username = "top4ek";
			$password = "q2w3e4r5";
			$dbname = "usersvk";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SELECT phone, summa FROM usersvk WHERE uid=$newMessage[0]";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        //echo "Summa: " . $row["summa"]. " - phone: " . $row["phone"]. "";
			        sendMessage("Вы%20заполнили%20все%20данные,%20ожидайте.%20Мы%20напомним%20Вам%20оплатить%20за%20неделю%20до%20срока.%20Или%20можете%20оплатить%20прямо%20сейчас%20по%20ссылке:%20http://top4ek.pw/href.php?summa=".$row["summa"]."%26phone=".$row["phone"]."",$newMessage[0]);

			    }
			} else {
			    echo "0 results";
			}
			$conn->close();

	}
	//////////Привет, банк////////////////////
	firstTime($newMessage,$userName);
	/////////////////////////////////////////

	/////////////////////PAPA SMOKE/////////////////
	if(strpos($newMessage[1], "Адрес") !== false){
		$newMessage[1] = str_replace(' ', '%20', $newMessage[1]);
		sendMessage("Вы%20выбрали%20Alfakher%20двойное%20яблоко%20и%20доставку%20на%20.$newMessage[1].%20,%20сумма%20к%20оплате%20-%20180%20рублей.<br>%20Все%20верно?%20Ваша%20ссылка%20на%20оплату:%20http://top4ek.pw/href.php?summa=180%26phone=79131092684",$newMessage[0]);
	}
	////////////////////////////////////////////

	function sendMessage($message,$uid){
		$token = "22599e3edd058eb179fa0bb13a9603b7ffb8b0723deb208468aee384397c6be78e5c3879843bdf17ae931";
		echo file_get_contents("https://api.vk.com/method/messages.send?user_id=".$uid."&message=".$message."&v=5.37&access_token=".$token."");
	}
	function firstTime($newMessage,$userName){
		switch ($newMessage[1]) {
				case 'Привет':
					sendMessage('Привет,%20'.$userName.',%20выбери%20свой%20банк%20для%20оплаты.<br>Варианты:"qiwi"',$newMessage[0]);
					break;
				case 'привет':
					sendMessage('Привет,%20'.$userName.',%20выбери%20свой%20банк%20для%20оплаты.<br>Варианты:"qiwi"',$newMessage[0]);
					break;
				case 'ghbdtn':
					sendMessage('Привет,%20'.$userName.',%20выбери%20свой%20банк%20для%20оплаты.<br>Варианты:"qiwi"',$newMessage[0]);
					break;		
				case 'Здравствуй':
					sendMessage('Привет,%20'.$userName.',%20выбери%20свой%20банк%20для%20оплаты.<br>Варианты:"qiwi"',$newMessage[0]);
					break;	
				case 'Ghbdtn':
					sendMessage('Привет,%20'.$userName.',%20выбери%20свой%20банк%20для%20оплаты.<br>Варианты:"qiwi"',$newMessage[0]);
					break;													
				case 'qiwi':
					sendMessage('Хорошо,%20теперь%20выбери%20услугу.%20<br>Варианты:%20пополнение%20баланса%20телефона-"баланс".%20<br>Доставка%20табака,углей%20и%20аксессуаров%20для%20кальяна%20от%20Malevich-shop(18+).-"Malevich-shop"',$newMessage[0]);
					connectbd("bank","qiwi",$newMessage[0]);
					break;	
				case 'Qiwi':
					sendMessage('Хорошо,%20теперь%20выбери%20услугу.%20<br>Варианты:%20пополнение%20баланса%20телефона-"баланс".%20<br>Доставка%20табака,углей%20и%20аксессуаров%20для%20кальяна%20от%20Malevich-shop(18+).-"Malevich-shop"',$newMessage[0]);
					connectbd("bank","qiwi",$newMessage[0]);
					break;		
				case 'QIWI':
					sendMessage('Хорошо,%20теперь%20выбери%20услугу.%20<br>Варианты:%20пополнение%20баланса%20телефона-"баланс".%20<br>Доставка%20табака,углей%20и%20аксессуаров%20для%20кальяна%20от%20Malevich-shop(18+).-"Malevich-shop"',$newMessage[0]);
					connectbd("bank","qiwi",$newMessage[0]);
					break;	
				case 'баланс':
					sendMessage('Хорошо,%20теперь%20напиши%20номер%20телефона,%20который%20необходимо%20оплачивать.%20<br>В%20формате(79111234567).',$newMessage[0]);
					break;
				case 'Malevich':
					sendMessage('Выбери%20нужный%20товар:<br>🔝Al%20Fakher%20-%2081%20руб.%20-%20"AF"<br>🔝Adalya%20-%20110%20руб.%20-%20"AD"<br>🔝Serbetli%20-%20105%20руб.%20-%20"SB"<br>🔝Nakhla%20-%20250%20руб.%20-%20"NH"<br>🔝%20Fasil%20-%20115%20руб.%20-%20"FS"<br>🔝%20Afzal%20-%20160%20руб.%20-%20"AZ"<br>🔝%20Argelini%2050гр.%20-%20235%20руб.%20-%20"AG"<br>',$newMessage[0]);
					break;
				case 'AF':
					sendMessage('Выбери%20вкус%20Al-Fakher:<br>Мята%20-%20"мята"<br>Двойное%20яблоко%20-%20"дя"<br>Виноград%20-%20"виноград"<br>Лесные%20ягоды%20-%20"ля"<br>',$newMessage[0]);					
					break;
				case 'дя':
					sendMessage('Вы%20выбрали%20Al-fakher%20двойное%20яблоко%20+%20доставка,%20сумма%20к%20оплате%20-%20180%20рублей.%20Все%20верно?%20Напишите%20адрес%20доставки%20в%20формате:%20"Адрес%20ул.Пушкина,%20д.15,%20кв.12"<br>Хотите%20изменить%20заказ?%20Напишите%20"Malevich-shop"',$newMessage[0]);
					break;
				case 'мята':
					sendMessage('Вы%20выбрали%20Al-fakher%20мята%20+%20доставка,%20сумма%20к%20оплате%20-%20180%20рублей.%20Все%20верно?%20Напишите%20адрес%20доставки%20в%20формате:%20"Адрес%20ул.Пушкина,%20д.15,%20кв.12"<br>Хотите%20изменить%20заказ?%20Напишите%20"Malevich-shop"',$newMessage[0]);
					break;
				case 'виноград':
					sendMessage('Вы%20выбрали%20Al-fakher%20виноград%20+%20доставка,%20сумма%20к%20оплате%20-%20180%20рублей.%20Все%20верно?%20Напишите%20адрес%20доставки%20в%20формате:%20"Адрес%20ул.Пушкина,%20д.15,%20кв.12"<br>Хотите%20изменить%20заказ?%20Напишите%20"Malevich-shop"',$newMessage[0]);
					break;
				case 'ля':
					sendMessage('Вы%20выбрали%20Al-fakher%20лесные%20ягоды%20+%20доставка,%20сумма%20к%20оплате%20-%20180%20рублей.%20Все%20верно?%20Напишите%20адрес%20доставки%20в%20формате:%20"Адрес%20ул.Пушкина,%20д.15,%20кв.12"<br>Хотите%20изменить%20заказ?%20Напишите%20"Malevich-shop"',$newMessage[0]);
					break;										
				default:
					break;
			}
	}
	function updateCheck($test){
			$servername = "localhost";
			$username = "top4ek";
			$password = "q2w3e4r5";
			$dbname = "usersvk";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			//$sql = "UPDATE usersvk SET $first='$second' WHERE uid=$uid";
			$sql = "UPDATE usersvk SET checkWeek='1' WHERE uid=$test";
			if (mysqli_query($conn, $sql)) {
			    echo "Record updated successfully";
			} else {
			    echo "Error updating record: " . mysqli_error($conn);
			}

			mysqli_close($conn);

	}
	function connectbd($first,$second,$uid){
			$servername = "localhost";
			$username = "top4ek";
			$password = "q2w3e4r5";
			$dbname = "usersvk";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "UPDATE usersvk SET $first='$second' WHERE uid=$uid";

			if (mysqli_query($conn, $sql)) {
			    echo "Record updated successfully";
			} else {
			    echo "Error updating record: " . mysqli_error($conn);
			}

			mysqli_close($conn);

	}
?>
<meta http-equiv="Refresh" content="1" />