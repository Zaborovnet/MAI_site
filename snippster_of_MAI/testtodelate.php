<?php

//	 if ( isset($_POST['Books_table']) ) {
				//Устанавливаем доступы к базе данных:
		$host = 'dep805.mysql'; //имя хоста, на локальном компьютере это localhost
		$user = 'dep805_u0'; //имя пользователя, по умолчанию это root
		$password = 'Z/5GJaTo'; //пароль, по умолчанию пустой
		$db_name = 'dep805_s0'; //имя базы данных

	//Соединяемся с базой данных используя наши доступы:
		$link = mysqli_connect($host, $user, $password, $db_name);
	
		$sql1= 'SELECT * FROM `Books`';		//текст зпроса для выводим полученную таблицу
 	$query_books = mysqli_query($link, $sql1); //делаем запрос, сохраняем результат
		//выводим его построчно
	
	echo '<table>';
  while ($result1 = mysqli_fetch_array($query_books))
  {   
    echo "<tr>          
                                 <td>{$result1['id']}</td>
				<td>{$result1['zagolovok']}</td>
<td>{$result1['izdatelstvo']}</td>
				<td><a href={$result1['book_link']}>Ссылка на книгу</a></td>
				
				<td>{$result1['year']}</td>
<td>{$result1['grif']}</td>
<td>{$result1['seria']}</td>
<td>{$result1['category']}</td>
<td>{$result1['autors805']}</td>
<td>{$result1['autorsne805']}</td>
<td>{$result1['predmet']}</td>
 </tr>";
  }   
			echo '</table>';