<?php

use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Aws\Exception\MultipartUploadException;

if (!function_exists('saveImageOnDisk')) {

    /**
     *  Сохраняет файл на диске, добавляя в название файла дату
     *  и изменяя его формат на webp. Сжатие 20%, размер 600:900, формат webp,
     *  средний размер изображений 28кб.
     * @param $image_req - изображение из запроса
     * @param $date - дата добавления файла
     * @param string $image_number - номер изображения добавленное в одну дату
     * return array (название, путь)
     */
    function saveImageOnDisk($image_req, $date, $image_number = '')
    {
        /* //сохраняем изображение на яндекс диске
        $date = date("d.m.Y,H.i.s");
        $name = $image_number . $date . '_' . pathinfo($image_req->getClientOriginalName(), PATHINFO_FILENAME);
        $path = 'https://storage.yandexcloud.net/fiori2/' . $name . '.jpg';

        //сохраняем фото на яндекс облаке
        $s3 = new S3Client([
            'version' => 'latest',
            'endpoint' => 'https://storage.yandexcloud.net',
            'region' => 'ru-central1',
        ]);
        $stream = Image::make($image_req)
            ->fit(500, 600)
            ->stream('jpg', 20);
        $uploader = new MultipartUploader($s3, $stream, [
            'bucket' => 'fiori2',
            'key' => $name.'.jpg',
        ]);
        try {
            $result = $uploader->upload();
        } catch (MultipartUploadException $e) {
            // State contains the "Bucket", "Key", and "UploadId"
            $params = $e->getState()->getId();
            $result = $s3->abortMultipartUpload($params);
        } */
        //сохраняем изображение на яндекс диске
        $date = date("d.m.Y,H.i.s");
        $name = $image_number . $date . '_' . pathinfo($image_req->getClientOriginalName(), PATHINFO_FILENAME);
        $path = 'images/' . $name . '.jpg';
        $stream = Image::make($image_req)
        ->fit(500, 600)
        ->save('jpg', 20);
        return ['name'=>$name,'path'=>$path];
    }
}

if (!function_exists('deleteImageOnDisk')) {

    /**
     * Возвращает сообщение о успешности удаления.
     * Удаляет файл изображения на диске.
     *
     * @param $image_name - название файла
     * @return string
     */

    function deleteImageOnDisk($image_name): string
    {
        if (Storage::disk('images')->exists($image_name.'.webp')){
            Storage::disk('images')->delete($image_name.'.webp');
            return "Изображение <" . $image_name . "> успешно удалено.";
        }else{
            return "Изображение <" . $image_name . ">не найдено на диске, удалена только запись из БД.";
        }
    }
}

