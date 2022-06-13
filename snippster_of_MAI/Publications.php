<?php

//	 if ( isset($_POST['Books_table']) ) {
				//Устанавливаем доступы к базе данных:
		$host = 'dep805.mysql'; //имя хоста, на локальном компьютере это localhost
		$user = 'dep805_u0'; //имя пользователя, по умолчанию это root
		$password = 'Z/5GJaTo'; //пароль, по умолчанию пустой
		$db_name = 'dep805_s0'; //имя базы данных

	//Соединяемся с базой данных используя наши доступы:
		$link = mysqli_connect($host, $user, $password, $db_name);
	
		$sql1=  "SELECT * FROM `Books` WHERE author LIKE '%Пантелеев%'";	//текст зпроса для выводим полученную таблицу
 	$query_books = mysqli_query($link, $sql1); //делаем запрос, сохраняем результат
		//выводим его построчно
	
	echo '<table>';
  while ($result1 = mysqli_fetch_array($query_books))
  {   
    echo "<tr>          
                                 <td>{$result1['author']}</td>
				<td>{$result1['subject_name']}</td>
				<td><a href={$result1['book_link']}>Ссылка на книгу</a></td>
				<td>{$result1['faq']}</td>
				<td>{$result1['year']}</td> </tr>";
  }   
			echo '</table>';
$resultE = mysqli_query($link, $sql1); //заносим в таблицу инфорацию
			if ($resultE == false) {  //проверка выполлнения запроса
				 print(mysqli_error($link));}