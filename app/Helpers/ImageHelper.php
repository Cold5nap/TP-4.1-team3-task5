<?php

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

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
        if ($image_number != '')
            $image_number = $image_number . '_';
        $name = $image_number . $date . '_' . pathinfo($image_req->getClientOriginalName(), PATHINFO_FILENAME);
        $path = '/images/' . $name . '.webp';// относительный путь до файла

        //сохраняем на диске
        \Image::make($image_req)
            ->encode('webp', 20)
            ->fit(600, 700)
            ->save(public_path() . $path, 20, 'webp');

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

