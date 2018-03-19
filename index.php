<?php
include_once('config.php');	

$GET_rules = file_get_contents($rule_url);

echo $GET_rules;

echo '
<br>
<h1>Сообщений: <div id="counter"></div></h1>
<br><br><br>

<div id="feed">

</div>';

// Вывод запроса

$wss_url = 'wss://'.$endpoint.'/stream?key='.$key;
echo '
<script>

var feedNews = 0;
var feed = document.getElementById("feed");
var counter = document.getElementById("counter");
var socket = new WebSocket("'.$wss_url.'");

socket.onopen = function() {
  feed.innerHTML = "Соединение установлено." + "<br><br>";
};

socket.onmessage = function(event) {
	
  feedNews = feedNews+1;
  
  user = JSON.parse(event.data)
  
if (user.event.event_type == "post"){
var event_type = "пост";
	} 
	if (user.event.event_type == "comment"){
	var event_type = "Комментарий";	
	}
	if (user.event.event_type == "share"){
		var event_type = "Репост";
	}
  
  
  feed.innerHTML =  "<div style=\"border: 1px solid black;\"><a href=\"" + user.event.author.author_url + "\">Автор</a> (" + event_type +")<br><Br>" + user.event.text + "</div><br><br>" + feed.innerHTML  ;
  counter.innerHTML = feedNews;
  
  
};

socket.onerror = function(error) {
  alert("Ошибка " + event.service_message);
};

</script>'; 
?>