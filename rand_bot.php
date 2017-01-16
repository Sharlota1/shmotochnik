<?php
/**
*@file Генерация рандомной нижней части одежды
*
*@autor Быкова Алёна
*/
require 'bd.php';
//header('Location: http://shmotochnik.zzz.com.ua/dashboard.php#settings');
session_start();
$name_user = $_SESSION['login'];
$temperature=$_POST['temp'];
$r;

$aDoor = $_POST['cloth_type'];

/**
*@brief Функция проверки того, выбрана ли галочка в чекбоксе
*
*@param $chkname Название группы чекбокса
*
*@param $value Значение чекбокса
*
*@return boolean Возврещает true, если чекбокс выбран, false-иначе.
*/
  function IsChecked($chkname,$value)
    {
        if(!empty($_POST[$chkname]))
        {
            foreach($_POST[$chkname] as $chkval)
            {
                if($chkval == $value)
                {
                    return true;
                }
            }
        }
        return false;
    }
/**
*@brief Функция вытягивания путей к картинкам из БД, удовлетворяющим указзанным параметрам, и рандомный выбор одного пути из полученного списка.
*
*@param $value_type Стиль одежды
*
*@param $category Категория одежды
*
*@return string Путь к изображению оджды
*/
function select($value_type, $category){
   global $name_user;
   global $temperature;
   $select="SELECT* FROM images 
   INNER JOIN type_of_clother 
   ON id_images=images.id AND value_type='$value_type' 
   WHERE category='$category' AND name_user='$name_user' AND '$temperature'>min_temperature AND '$temperature'< max_temperature
   ORDER BY RAND() LIMIT 1";
   $result = mysql_query($select);
   $row=mysql_fetch_array($result);
   $row['image'];
   return $row['image'];
}
/**
*@brief Функция нахождения и отображения изображения по указанному пути
*
*@param $r Путь к изображению
*
*/
function display($r){

     header("Content-type: image/png");
     $image=imagecreatefrompng("{$r}");
     imagepng($image);

}


if(IsChecked('cloth_type','casual')){
  
   $r=select('Повседневный стиль', 'Низ');
   if(!empty($r)){
   display($r);
  }

}


 if(IsChecked('cloth_type','oficial')){
  $r=select('Официальный/вечерний стиль', 'Низ');
   if(!empty($r)){
     display($r);
  }
}

 if(IsChecked('cloth_type','delov')){
  $r=select('Деловой стиль', 'Низ');
   if(!empty($r)){
     display($r);
  }  
}

if(IsChecked('cloth_type','sport')){
  $r=select('Спортивный стиль', 'Низ');
   if(!empty($r)){;
     display($r);
  }
  
}

?>            											