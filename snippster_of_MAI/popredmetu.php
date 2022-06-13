<?php



$host = 'dep805.mysql'; //имя хоста, на локальном компьютере это localhost
$user = 'dep805_u0'; //имя пользователя, по умолчанию это root
$password = 'Z/5GJaTo'; //пароль, по умолчанию пустой
$db_name = 'dep805_s0'; //имя базы данных
$connection = mysqli_connect($host, $user, $password, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$connection->set_charset("utf8mb4");

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $query = "select * from Books where `id`={$book_id}";
    $cursor = mysqli_query($connection, $query);



    if (!$cursor) {
        // нет книжек по запросу
        echo "<h1>Добрый день, Константин Александрович!</h1><br><p>Книжек не нашлось, но вы держитесь</p>";
    } else {
        $book_info = mysqli_fetch_array($cursor);

        echo "<h6>{$book_info['zagolovok']}</h6>"
?>
        <br>
        <table>
            <tr>
                <td width="250px">
                    <p align="center"><a href="/education/books/images/<? echo $book_info['pht_front'] ?>.jpg"><img src="/education/books/previews/<? echo $book_info['pht_front'] ?>.jpg" width="150" title="Нажмите для перехода к полноразмерному изображениюю" /></a></p>
                </td>
                <td>
                    <table cellpadding="3">
                        <tr valign="top">
                            <td>
                                <b>Авторы:</b>
                            </td>
                            <td>
                                <p><?php echo $book_info['autors805'] . ' ' . $book_info['autornes805']; ?></p>
                                <br />
                            </td>
                        </tr>
                    <?php
                    if ($book_info['izdatelstvo'] != '')
                        echo '</tr>
                    <tr valign="top">
            <td>
              <b>Издательство:</b>
            </td>
            <td>' . nl2br(htmlspecialchars($book_info['izdatelstvo'])) . '</td></tr>';


                    if ($book_info['year'] != '')
                        echo '</tr>
                    <tr valign="top">
            <td>
              <b>Год:</b>
            </td>
            <td>' . nl2br(htmlspecialchars($book_info['year'])) . '</td></tr>';


                    if ($book_info['seria'] != '')
                        echo '</tr>
                    <tr valign="top">
            <td>
              <b>Серия:</b>
            </td>
            <td>' . nl2br(htmlspecialchars($book_info['seria'])) . '</td></tr>';

                    if ($book_info['grif'] != '')
                        echo '</tr>
                    <tr valign="top">
            <td>
              <b>Гриф:</b>
            </td>
            <td>' . nl2br(htmlspecialchars($book_info['grif'])) . '</td></tr>';

                    if ($book_info['category'] != '')
                        echo '</tr>
                    <tr valign="top">
            <td>
              <b>Категория:</b>
            </td>
            <td>' . nl2br(htmlspecialchars($book_info['category'])) . '</td></tr>';

                    if ($book_info['predmet'] != '')
                        echo '</tr>
                    <tr valign="top">
            <td>
              <b>Связанные предметы:</b>
            </td>
            <td>' . nl2br(htmlspecialchars($book_info['predmet'])) . '</td></tr>';

                    if ($book_info['book_link'] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Скачать:</b>
            </td>
            <td><a href={$book_info['book_link']}>Ссылка на книгу</a></td></tr>";
                }
            } else {

//форма поиска
echo'
<form method="post" enctype="multipart/form-data">
    <h6><p>Выберите предмет для поиска:
<select name="Search" style="height:60px !important">
  <option></option>
  <option>Аналитическая геометрия</option>
  <option>Дискретная математика</option>
  <option>Дифференциальные уравнения</option>
  <option>Линейная алгебра</option>
  <option>Математика для абитуриентов</option>
  <option>Математический анализ</option>
  <option>Методы оптимизации (Теория оптимизации)</option>
  <option>Спецкурсы</option>
  <option>Теория вероятностей</option>
  <option>Теория игр</option>
  <option>Теория принятия решений</option>
  <option>Теория управления</option>
  <option>Теория функций комплексного переменного</option>
  <option>Уравнения математической физики</option>
  <option>Численные методы</option>
</select>
<input type="submit" name="Books_table" value="Найти" />
</p>
</h6>
</form>
';



 if ( isset($_POST['Books_table']) ) {
$selectSearch = $_REQUEST['Search'];
                $query = "SELECT * FROM `Books` WHERE `predmet` = '$selectSearch' AND  id!=0";
                $cursor = mysqli_query($connection, $query);

                    ?>
                    <link rel="stylesheet" href="/css/bootstrap-grid.css">
                    <style>
                        .row {
                            margin-bottom: 1rem;
                        }

                        .inner_table {
                            width: 100%;
                            height: 100%;

                        }

                        .inner_table ul {
                            list-style: none;
                            padding-left: 0;
                        }

                        .inner_table li {
                            margin: 1em 0.5em;
                        }

                        .pic {
                            width: 45%;
                            max-width: 150;
                        }

                        .pic img {
                            width: 100%;
                        }
                    </style>

                    <div class="container" style="width: 100%;">
                        <?
                        // foreach (array_chunk(mysqli_fetch_assoc($cursor), 2) as $b){
                        $res = array_chunk(mysqli_fetch_all($cursor, MYSQLI_ASSOC), 2);
                        foreach ($res as $b) {
                            $auth = [];
                            foreach ($b as $book) {
                                $auth[] = implode(', ', array_filter(array_merge(array($book['autors805']), array($book['autornes805'] = '' ? NULL : $book['autornes805']))));
                            }
                            // echo "<tr>";
                            // echo "<td>{$b['zagolovok']}</td>";
                            // echo "<td>{$curr_auth}</td>";
                            // echo "<td>{$b['year']}</td>";
                            // echo "<td><a href=\"?book_id={$b['id']}\">Подробнее</a></td>";
                            // echo "</tr>";

                            echo "
                        <div class=\"row\">
                            <div class=\"col\">
                                <div class=\"container inner_table\">
                                    <div class=\"row\">
                                        <div class=\"col pic\"><a href=\"?book_id={$b[0]['id']}\"><img src=\"/education/books/previews/{$b[0]['pht_front']}.jpg\"></a></div>
                                        <div class=\"col\">
                                            <ul>
                                                <li>Название:<br><a href=\"?book_id={$b[0]['id']}\">{$b[0]['zagolovok']}</a></li>
                                                <li>Авторы:<br>{$auth[0]}</li>
                                                <li>Издательство:<br>{$b[0]['izdatelstvo']} ({$b[0]['year']})</li>
                                                <li>Связанные предметы:<br>{$b[0]['predmet']}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col\">
                                <div class=\"container inner_table\">
                                    <div class=\"row\">
                                        <div class=\"col pic\"><a href=\"?book_id={$b[1]['id']}\"><img src=\"/education/books/previews/{$b[1]['pht_front']}.jpg\"></a></div>
                                        <div class=\"col\">
                                            <ul>
                                                <li>Название:<br><a href=\"?book_id={$b[1]['id']}\">{$b[1]['zagolovok']}</a></li>
                                                <li>Авторы:<br>{$auth[1]}</li>
                                                <li>Издательство:<br>{$b[1]['izdatelstvo']} ({$b[1]['year']})</li>
                                                <li>Связанные предметы:<br>{$b[1]['predmet']}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                        ?>
                    </div>

                <?
            }

}
            echo '</table>';
            echo '</table>';