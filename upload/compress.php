<?php

/**
 * Function remove ICC Profile information from image (make image size smaller)
 * @param type $old
 * @param type $new
 * @src https://stackoverflow.com/questions/3614925/remove-exif-data-from-jpg-using-php
 * status - currently not used by this script
 */
function removeIcc()
{

    // ...

}

/**
 * 
 * @param integer $newWidth - width in %
 * @param string $targetFile - path to a file
 * @param type $originalFile - path to a file
 * @param integer $value - image compression strength value from 0 - 9
 * @throws Exception - if file type not supported
 */
function resizeImg($newWidth, $targetFile, $originalFile, $options) {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg'; // not used - file are saved with oryginal extension
                    $new_image_ext = 'jpg';
                    $args = [$targetFile, $options['quality']]; // first argument will be added to the fornt of the array below - $temp
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png'; // not used - file are saved with oryginal extension
                    $args = [$targetFile, $options['compresionLvl'], PNG_ALL_FILTERS]; // first argument will be added to the fornt of the array below - $temp
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif'; // not used - file are saved with oryginal extension
                    $new_image_ext = 'gif';
                    $args = [$targetFile]; // first argument will be added to the fornt of the array below - $temp
                    break;

            default: 
                    throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);
    $newWidth = $width / 100 * $newWidth;
    if($newWidth > $options['maxWidth']) $newWidth = $options['maxWidth'];
    echo $width . " => " . $newWidth.PHP_EOL;
    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

//    if (file_exists($targetFile)) {
//            unlink($targetFile);
//    }
    array_unshift($args, $tmp);
    var_dump($args);

    call_user_func_array($image_save_func, $args); // new
    //$image_save_func($tmp, $targetFile, $value); //old
}

/**
 * Function responsible for image optimisation.
 * Function is used by listFiles function,
 */
function optymizeFile($file, $options){
    resizeImg($options['resizeImgProcent'], $file, $file, $options);
    removeIcc();
}

/**
 * Function is used by searchForFiles function 
 * Function depends on optymizeFile function to run image optimisation.
 * @param string $path - starting path
 * @param string $extRegEx - what file name/extension to search
 */
function listFiles($path, $extRegEx, $options){
    // BLOB REGULAR EXPRESION IS VERY LIMITED - that is why we get all files from directory and make comparisoin with preg_match
    $files = array_filter(glob($path.'*'));

    clearstatcache();
    foreach($files as $file){
        // TRUE REGULAR EXPRESION
        if(preg_match($extRegEx, $file)) {
            // DEPENDENCY - image optymisation

            // echo ceil((filesize($file) / 1024)).'Kb'.PHP_EOL;
            if(filesize($file) > ($options['optymizeFileLargerThen'] * 1024)){
                optymizeFile($file, $options);
            }
        }

    }
}

/**
 * This function search for files with given extension
 * Function depends on listFiles function to list all the files.
 * @param string $path - starting path
 * @param string $extRegEx - what file name/extension to search
 * @param boolean $recursive - search in subdirectories
 */
function searchForFiles($path, $extRegEx, $recursive = false, $options){
    $dir = new DirectoryIterator($path);
    // DEPENDENCY - list files in curent directory
    listFiles($path.'/', $extRegEx, $options);
    foreach ($dir as $fileinfo) {
        // if set as recursive 
        if ($recursive == true && $fileinfo->isDir() && !$fileinfo->isDot()) {
            //echo $fileinfo->getFilename().PHP_EOL;
            // GO RECURSIVE
            searchForFiles($path.'/'.$fileinfo->getFilename(), $extRegEx, $recursive, $options);
        }
    }
}

// USE EXAMPLE
$path = '.';
$extRegEx = '%.*(png|jpg|jpeg|gif)$%'; //where "%" is expresion delimiter
$recursive = true;
$options = [
    'resizeImgProcent' => 100, // this is Procentage. 100 = no resize
    'compresionLvl' => 9, // compresion strength from 0 to 9 where 9 is the strongest and 6 is the default
    'quality' => 20, // compresion strength from 0 to 100 where 100 is the heighest quality and 75 is the default
    'maxWidth' => 1200, // max width allowed for image
    'optymizeFileLargerThen' => 15 // optymise files larger then 15 Kb
];
searchForFiles($path, $extRegEx, $recursive, $options);