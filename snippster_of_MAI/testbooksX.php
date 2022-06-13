<?php

$host = "dep805.mysql"; //имя хоста, на локальном компьютере это localhost
$user = "dep805_u0"; //имя пользователя, по умолчанию это root
$password = "Z/5GJaTo"; //пароль, по умолчанию пустой
$db_name = "dep805_s0"; //имя базы данных
$connection = mysqli_connect($host, $user, $password, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$connection->set_charset("utf8mb4");


    $book_id = 2;
    $query = "select * from Books where `id`=2";
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
                    <p align="center"><a href="/education/books/images/<? echo $book_info['pht_front']?>.jpg"><img src="/education/books/previews/<? echo $book_info["pht_front"]?>.jpg" width="150" title="Нажмите для перехода к полноразмерному изображениюю" /></a></p>
                </td>
                <td>
                    <table cellpadding="3">
                        <tr valign='top'>
                            <td>
                                <b>Авторы:</b>
                            </td>
                            <td>
                                <p><?php echo $book_info['autors805'] . " " . $book_info['autornes805']; ?></p>
                                <br />
                            </td>
                        </tr>
                    <?php
                    if ($book_info["izdatelstvo"] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Издательство:</b>
            </td>
            <td>" . nl2br(htmlspecialchars($book_info["izdatelstvo"])) . "</td></tr>";


                    if ($book_info["year"] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Год:</b>
            </td>
            <td>" . nl2br(htmlspecialchars($book_info["year"])) . "</td></tr>";


                    if ($book_info['seria'] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Серия:</b>
            </td>
            <td>" . nl2br(htmlspecialchars($book_info['seria'])) . "</td></tr>";

                    if ($book_info["grif"] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Гриф:</b>
            </td>
            <td>" . nl2br(htmlspecialchars($book_info["grif"])) . "</td></tr>";

                    if ($book_info['category'] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Категория:</b>
            </td>
            <td>" . nl2br(htmlspecialchars($book_info['category'])) . "</td></tr>";

                    if ($book_info['predmet'] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Связанные предметы:</b>
            </td>
            <td>" . nl2br(htmlspecialchars($book_info['predmet'])) . "</td></tr>";

                    if ($book_info['book_link'] != '')
                        echo "</tr>
                    <tr valign='top'>
            <td>
              <b>Скачать:</b>
            </td>
            <td><a href={$book_info['book_link']}>Ссылка на книгу</a></td></tr>";
echo '</table>';
echo '</table>';
                }