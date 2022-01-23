<?php 
session_start();
header("Content-Type: text/html; charset=utf-8");
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
	///////////проверяем на заполнения поля номер $_POST['namber_add']
	if(!empty($_POST['add_foto_1']) && !empty($_POST['namber_add']) && trim($_POST['namber_add'])){

    	for ($i=1; $i <= 16; $i++) { 
		if(!empty($_FILES['foto'.$i.'']['tmp_name'])){
            ////////////Загрузка на сервер фото
            $errors = $_FILES['foto'.$i.'']['error'];
            $file_name = strtolower($_FILES['foto'.$i.'']['name']);
            $file_size = $_FILES['foto'.$i.'']['size'];
            $file_tmp = $_FILES['foto'.$i.'']['tmp_name'];
            $file_type = $_FILES['foto'.$i.'']['type'];
            if(!empty($errors)){
                $_SESSION['error_foto'] = 'Произошла ошибка загрузки';
             	header('Location: http://project3/admin/registration.php');
                exit;
            }
            if($file_size > 12048576){
                $_SESSION['error_foto'.$i.''] = 'Ошибка файл больше 12 мб';
                header('Location: http://project3/admin/registration.php');
                exit;
            }

            if($file_type == 'image/jpeg'){
                $jpeg = 'jpeg';
            }elseif ($file_type == 'image/jpg') {
                $jpg = 'jpg';
            }else{
                $_SESSION['error_foto'] = 'Не правильный формат изображения!';
                header('Location: http://project3/admin/registration.php');
                exit;
            }
           
				move_uploaded_file($file_tmp,'../../image_women/'.$_POST['namber_add'].''."/".''.$file_name);
	            $_SESSION['foto'] = '<p id="div_alarm_reg" class="error-foto" style="color: green">Благодарим, Фото успешно загружены</p>';
	            unset($_SESSION['error_foto']);
            ////////////////////////Сожмем фото каторые загружаем на сервер на сайт!

                $put = '../../image_women/'.$_POST['namber_add'].'/'.$file_name.'';

                $raz = getimagesize($put);
                
                if ($file_name !== 'ava.jpg' && ($raz[0] > 2100 || $raz[1] > 2100)) {
                         
  ////////////////////////////////Тип вырезки 1
                    
                        
                        $im=imagecreatefromjpeg($put);
                        $k1=1950/imagesx($im);
                        $k2=1950/imagesy($im);
                        $k=$k1>$k2?$k2:$k1;

                        $w=intval(imagesx($im)*$k);
                        $h=intval(imagesy($im)*$k);

                        $im1=imagecreatetruecolor($w,$h);
                        imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));
                    
                        imagejpeg($im1, $put, 85); 
                        imagedestroy($im);
                        
                        
                    }

          //////////////////////Скрипт который наносит на изображение текст

        $nametext = 'Ourname.com';  
        $font = '../../views/fonts/Italianno-Regular.ttf';  
        $img='../../image_women/'.$_POST['namber_add'].'/'.$file_name.'';
        $pic = ImageCreateFromjpeg($img); //открываем рисунок в формате JPEG
        $color = imagecolorallocatealpha($pic, 252, 252, 252, 15);
        ////////Вполне сносный вариант
        $razmer = getimagesize($img); // Получаем размеры картинки
        if($razmer[0] > $razmer[1]){
            $hsirina = $razmer[0] / 25;
            $wisota =$razmer[1] - $razmer[1] / 25;
            $fontSize = round($razmer[1] / 20);
        }else{
            $hsirina = $razmer[0] / 25;
            $wisota =$razmer[1] - $razmer[1] / 25;
            $fontSize = round($razmer[1] / 20);
        }

        if ($file_name !== 'ava.jpg') {
            ImageFTText($pic, $fontSize, 0, $hsirina, $wisota, $color, $font, $nametext);
         // заливка области

            Imagejpeg($pic, '../../image_women/'.$_POST['namber_add'].'/'.$file_name.'', 95); //сохраняем рисунок в формате JPEG
            imagedestroy($pic);
        }else{

        }

        }
    }  



         	$_SESSION['namber_add'] = $_POST['namber_add'];
 			unset($_SESSION['error_namber_add']);
            header('Location: http://project3/admin/registration.php/?reg=addfoto'); //РИДИРЕКТ
            exit;
        } else {///////С первого ифа если поле не заполненно
	        $_SESSION['error_namber_add'] = '<p id="div_alarm_reg" class="error-foto" style="color: red">** Укажите номер анкеты!</p>';
	        unset($_SESSION['namber_add']);
	        unset($_SESSION['foto']);
           
        }



             ///////////////////////////////////////////Правка фото
    ///////////проверяем на заполнения поля номер $_POST['namber_add']

        if (!empty($_POST['add_foto']) && !empty($_FILES['foto']['tmp_name'])) {


     if(!empty($_FILES['foto']['tmp_name'])){
            ////////////Загрузка на сервер фото
            $errors = $_FILES['foto']['error'];
            $file_name = $_FILES['foto']['name'];
            $file_size = $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            $file_type = $_FILES['foto']['type'];
            if(!empty($errors)){
                $_SESSION['error_foto'] = 'Произошла ошибка загрузки';
                 header('Location: http://project3/admin/registration.php');
                exit;
            }
            if($file_size > 10048576){
                $_SESSION['error_foto'.$i.''] = 'Ошибка файл больше 10мб';
                header('Location: http://project3/admin/registration.php');
                exit;
            }

            if($file_type == 'image/jpeg'){
                $jpeg = 'jpeg';
            }elseif ($file_type == 'image/jpg') {
                $jpg = 'jpg';
            }elseif ($file_type == 'image/png') {
                $jpg = 'png';
            }else{
                $_SESSION['error_foto'] = 'Не правильный формат изображения!';
                header('Location: http://project3/admin/registration.php');
                exit;
            }
           /////////////Сохраняем фото

             move_uploaded_file($file_tmp,'../../image/do_ava/'.'ava.jpg');
                $_SESSION['foto'] = '<p id="div_alarm_reg" class="error-foto" style="color: green">Благодарим, Фото успешно загружены</p>';
                unset($_SESSION['error_foto']);
          
                //////////////////Меняем размер 1
                $put = '../../image/do_ava/'.'ava.jpg' ;
                $raz = getimagesize($put);

                if ($raz[0] > 350 || $raz[1] > 350) {
                         
  ////////////////////////////////Тип вырезки 1
                    function imageresize($outfile,$infile,$neww,$newh,$quality) {

                        
                        $im=imagecreatefromjpeg($infile);
                        $k1=$neww/imagesx($im);
                        $k2=$newh/imagesy($im);
                        $k=$k1>$k2?$k2:$k1;

                        $w=intval(imagesx($im)*$k);
                        $h=intval(imagesy($im)*$k);

                        $im1=imagecreatetruecolor($w,$h);
                        imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));
                    

                        imagejpeg($im1, '../../image/do_ava/'.$w.'_'.$h.'.jpg', $quality); 
                        imagedestroy($im);
                                 
                // /////////////////Копируем нужную часть
                         $im2=imagecreatefromjpeg('../../image/do_ava/'.$w.'_'.$h.'.jpg');
                        $size = min(imagesx($im2), imagesy($im2));
                        $im2 = imagecrop($im2, ['x' => 20, 'y' => 0, 'width' => 183, 'height' => 244]);
                        imagejpeg($im2, '../../image/do_ava/183_244.jpg', $quality); 
                        imagedestroy($im2);

                // /////////////////Копируем нужную часть
                         $im3=imagecreatefromjpeg('../../image/do_ava/'.$w.'_'.$h.'.jpg');
                        $size = min(imagesx($im3), imagesy($im3));
                        $im3 = imagecrop($im3, ['x' => 40, 'y' => 0, 'width' => 220, 'height' => 293]);
                        imagejpeg($im3, '../../image/do_ava/220_293_40.jpg', $quality); 
                        imagedestroy($im3);
                // /////////////////Копируем нужную часть
                         $im4=imagecreatefromjpeg('../../image/do_ava/'.$w.'_'.$h.'.jpg');
                        $size = min(imagesx($im4), imagesy($im4));
                        $im4 = imagecrop($im4, ['x' => 0, 'y' => 0, 'width' => 220, 'height' => 293]);
                        imagejpeg($im4, '../../image/do_ava/220_293_0.jpg', $quality); 
                        imagedestroy($im4);


                        }
                        imageresize("",$put,900,300,99);

  ////////////////////////////////Тип вырезки 2
                    function imageresize2($outfile,$infile,$neww,$newh,$quality) {

                        
                        $im=imagecreatefromjpeg($infile);
                        $k1=$neww/imagesx($im);
                        $k2=$newh/imagesy($im);
                        $k=$k1>$k2?$k2:$k1;

                        $w=intval(imagesx($im)*$k);
                        $h=intval(imagesy($im)*$k);

                        $im1=imagecreatetruecolor($w,$h);
                        imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));
                    

                        imagejpeg($im1, '../../image/do_ava/'.$w.'_'.$h.'.jpg', $quality); 
                        imagedestroy($im);
                                 
                       // /////////////////Копируем нужную часть
                         $im5=imagecreatefromjpeg('../../image/do_ava/'.$w.'_'.$h.'.jpg');
                        $size = min(imagesx($im5), imagesy($im5));
                        $im5 = imagecrop($im5, ['x' => 90, 'y' => 20, 'width' => 220, 'height' => 293]);
                        imagejpeg($im5, '../../image/do_ava/220_293_20.jpg', $quality); 
                        imagedestroy($im5);
                       // /////////////////Копируем нужную часть
                         $im6=imagecreatefromjpeg('../../image/do_ava/'.$w.'_'.$h.'.jpg');
                        $size = min(imagesx($im6), imagesy($im6));
                        $im6 = imagecrop($im6, ['x' => 75, 'y' => 10, 'width' => 250, 'height' => 333]);
                        imagejpeg($im6, '../../image/do_ava/250_333_60.jpg', $quality); 
                        imagedestroy($im6);
                         // /////////////////Копируем нужную часть
                         $im7=imagecreatefromjpeg('../../image/do_ava/'.$w.'_'.$h.'.jpg');
                        $size = min(imagesx($im7), imagesy($im7));
                        $im7 = imagecrop($im7, ['x' => 30, 'y' => 10, 'width' => 300, 'height' => 400]);
                        imagejpeg($im7, '../../image/do_ava/300_400_30.jpg', $quality); 
                        imagedestroy($im7); 
                         // /////////////////Копируем нужную часть
                         $im8=imagecreatefromjpeg('../../image/do_ava/'.$w.'_'.$h.'.jpg');
                        $size = min(imagesx($im8), imagesy($im8));
                        $im8 = imagecrop($im8, ['x' => 175, 'y' => 0, 'width' => 450, 'height' => 600]);
                        imagejpeg($im8, '../../image/do_ava/450_600_75.jpg', $quality); 
                        imagedestroy($im8); 

                        }
                        imageresize2("",$put,1000,600,99);

                }  

 
        } 
            $_SESSION['add_foto'] = 'Добавлена для аватарки';
            unset($_SESSION['error_add_foto'] );
            unset($_SESSION['foto']);
            header('Location: http://project3/admin/registration.php/?reg=addfoto'); //РИДИРЕКТ
            exit;
        }else{
                $_SESSION['error_add_foto'] = '<p style="padding-left: 25px; color: red;">Выберите картинку!</p>';
                unset($_SESSION['add_foto'] );

                header('Location: http://project3/admin/registration.php/?reg=addfoto'); //РИДИРЕКТ
                exit;
        }


            header('Location: http://project3/admin/registration.php/?reg=addfoto'); //РИДИРЕКТ
            exit;
 ?>

