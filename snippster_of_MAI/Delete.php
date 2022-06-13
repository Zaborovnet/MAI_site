<table border='1'>
  <tr>
    <td>Идентификатор</td>
    <td>Заголовок</td>
    <td>Издательство</td>
    <td>Ссылка</td>
    <td>Год</td>
    <td>Гриф</td>
    <td>Серия</td>
    <td>Категория</td>
    <td>Автор с 805</td>
    <td>Автор с НЕ 805</td>
    <td>Предмет</td>
    <td>Удаление</td>
  </tr>
  <?php
			//Устанавливаем доступы к базе данных:
		$host = 'dep805.mysql'; //имя хоста, на локальном компьютере это localhost
		$user = 'dep805_u0'; //имя пользователя, по умолчанию это root
		$password = 'Z/5GJaTo'; //пароль, по умолчанию пустой
		$db_name = 'dep805_s0'; //имя базы данных

	//Соединяемся с базой данных используя наши доступы:
		$link = mysqli_connect($host, $user, $password, $db_name);
    $sql = mysqli_query($link, 'SELECT `id`, `zagolovok`, `izdatelstvo`, `book_link`, `year`, `grif`, `seria`, `category`, `autors805`, `autornes805`, `predmet`  FROM `Books`');
    while ($result = mysqli_fetch_array($sql)) {
      echo '<tr>' .
           "<td>{$result['id']}</td>" .
           "<td>{$result['zagolovok']}</td>" .
           "<td>{$result['izdatelstvo']} </td>" .
           "<td>{$result['book_link']} </td>" .
           "<td>{$result['year']} </td>" .
           "<td>{$result['grif']} </td>" .
           "<td>{$result['seria']} </td>" .
           "<td>{$result['category']} </td>" .
           "<td>{$result['autors805']} </td>" .
           "<td>{$result['autornes805']} </td>" .
           "<td>{$result['predmet']} </td>" .
           "<td><a href='?del_id={$result['id']}'>Удалить</a></td>" .
           '</tr>';
    }

</table>
  ?>