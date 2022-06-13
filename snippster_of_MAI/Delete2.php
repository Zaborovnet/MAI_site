<?php
  if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
    //удаляем строку из таблицы
    $sql = mysqli_query($link, "DELETE FROM `products` WHERE `ID` = {$_GET['del_id']}");
    if ($sql) {
      echo "<p>Товар удален.</p>";
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }
?>