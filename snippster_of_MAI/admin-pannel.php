<?php
			//Устанавливаем доступы к базе данных:
		$host = 'dep805.mysql'; //имя хоста, на локальном компьютере это localhost
		$user = 'dep805_u0'; //имя пользователя, по умолчанию это root
		$password = 'Z/5GJaTo'; //пароль, по умолчанию пустой
		$db_name = 'dep805_s0'; //имя базы данных
		$link = mysqli_connect($host, $user, $password, $db_name);

    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

    //Если переменная Name передана
    if (isset($_POST["id"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
   //       $sql = mysqli_query($link, "UPDATE `Books` SET `zagolovok` = '{$_POST['zagolovok']}' ,`izdatelstvo` = '{$_POST['izdatelstvo']}',`book_link` = '{$_POST['book_link']}',`year` = '{$_POST['year']}',`grif` = '{$_POST['grif']}',`seria` = '{$_POST['seria']}' ,`category` = '{$_POST['category']}',`autors805` = '{$_POST['autors805']}',`autornes805` = '{$_POST['autornes805']}',`predmet` = '{$_POST['predmet']}'WHERE `id`={$_GET['red_id']}");

$sql = mysqli_query($link, "UPDATE `Books` SET `zagolovok` = '{$_POST['zagolovok']}' ,`izdatelstvo` = '{$_POST['izdatelstvo']}', `year` = '{$_POST['year']}',`grif` = '{$_POST['grif']}',`seria` = '{$_POST['seria']}' ,`category` = '{$_POST['category']}',`autors805` = '{$_POST['autors805']}',`autornes805` = '{$_POST['autornes805']}',`predmet` = '{$_POST['predmet']}'WHERE `id`={$_GET['red_id']}");


      } else {
          //Иначе вставляем данные, подставляя их в запрос
          $sql = mysqli_query($link, "INSERT INTO `Books` (`zagolovok`, `izdatelstvo`, `book_link`, `year`, `grif`, `seria`, `category`, `autors805`, `autornes805`, `predmet`) VALUES ('{$_POST['zagolovok']}', '{$_POST['izdatelstvo']}', '{$_POST['book_link']}', '{$_POST['year']}', '{$_POST['grif']}', '{$_POST['seria']}', '{$_POST['category']}', '{$_POST['autors805']}', '{$_POST['autornes805']}', ('{$_POST['predmet']}')");
      }

      //Если вставка прошла успешно
      if ($sql) {
        echo '<p>Успешно!</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $sql = mysqli_query($link, "DELETE FROM `Books` WHERE `id` = {$_GET['del_id']}");
      if ($sql) {
        echo "<p>Объект удален.</p>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `id`, `zagolovok`, `izdatelstvo`, `book_link`, `year`, `grif`, `seria`, `category`, `autors805`, `autornes805`, `predmet` FROM `Books WHERE `id`={$_GET['red_id']}");
      $book= mysqli_fetch_array($sql);
    }
  ?>
  <form action="" method="post">
    <table>

      <tr>
        <td>id:</td>
        <td><input type="text" name="id" value="<?= isset($_GET['red_id']) ? $book['id'] : ''; ?>"></td>
      </tr>

      <tr>
        <td>Заголовок:</td>
        <td><input type="text" name="zagolovok"  value="<?= isset($_GET['red_id']) ? $book['zagolovok'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Издательство:</td>
        <td><input type="text" name="izdatelstvo"  value="<?= isset($_GET['red_id']) ? $book['izdatelstvo'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Год:</td>
        <td><input type="text" name="year"  value="<?= isset($_GET['red_id']) ? $book['year'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Гриф:</td>
        <td><input type="text" name="grif"  value="<?= isset($_GET['red_id']) ? $book['grif'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Серия:</td>
        <td><input type="text" name="seria"  value="<?= isset($_GET['red_id']) ? $book['seria'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Категория:</td>
        <td><input type="text" name="category"  value="<?= isset($_GET['red_id']) ? $book['category'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Автор с 805:</td>
        <td><input type="text" name="autors805"  value="<?= isset($_GET['red_id']) ? $book['autors805'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Автор с НЕ 805:</td>
        <td><input type="text" name="autornes805"  value="<?= isset($_GET['red_id']) ? $book['autornes805'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Предмет:</td>
        <td><input type="text" name="predmet"  value="<?= isset($_GET['red_id']) ? $book['predmet'] : ''; ?>"></td>
      </tr>
      <tr>
        <td colspan="9"><input type="submit" value="OK"></td>
      </tr>
    </table>
  </form>
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
      <td>Редактирование</td>

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
             "<td><a href='?red_id={$result['id']}'>Изменить</a></td>" .

             '</tr>';
      }
    ?>
  </table>