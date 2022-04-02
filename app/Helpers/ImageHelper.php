<?php

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

if (!function_exists('saveImageOnDisk')) {

    /**
     *  Сохраняет файл на диске, добавляя в название файла дату
     *  и изменяя его формат на webp.
     * @param $image_req - изображение из запроса
     * @param $date - дата добавления файла
     * @param string $image_number - номер изображения добавленное в одну дату
     * return array (название, путь, расширение файла)
     */
    function saveImageOnDisk($image_req, $date, $image_number = '')
    {
        if ($image_number != '')
            $image_number = $image_number . '_';
        $name = $image_number . $date . '_' . pathinfo($image_req->getClientOriginalName(), PATHINFO_FILENAME);
        $newExtension = 'webp';
        $path = '/images/' . $name . '.' . $newExtension;// относительный путь до файла

        //сохраняем на диске
        \Image::make($image_req)
            ->encode($newExtension, 20)
            ->fit(600, 900)
            ->save(public_path() . $path, 20, $newExtension);

        return ['name'=>$name,'path'=>$path,'extension'=>$newExtension];
    }
}

if (!function_exists('saveImageInDBAndDisk')) {

    /**
     *  Сохраняет файл на диске и в бд, добавляя в название файла дату
     *  и изменяя его формат на webp.
     * @param $image_req - изображение из запроса
     * @param $date - дата добавления файла
     * @param string $image_number - номер изображения добавленное в одну дату
     * @return Image возвращает созданную в бд запись
     */

    function saveImageInDBAndDisk($image_req, $date, $image_number = ''): Image
    {
       $file = saveImageOnDisk($image_req,$date,$image_number);

        // добавляем в бд изображение
        $image = new Image();
        $image->path = $file['path'];
        $image->name = $file['name'];
        $image->extension = $file['extension'];
        $image->save();
        return $image;
    }
}

if (!function_exists('deleteImageInDBAndDisk')) {

    /**
     *  Удаляет файл на диске и в бд.
     * @param $id - id - фото
     * @return string возвращает созданную в бд запись
     */

    function deleteImageInDBAndDisk($id)
    {
        $message = '';

        $image = Image::where('id',$id)->first();

        //удалим с диска
        if (Storage::disk('images')->exists($image->name.'.webp')){
            Storage::disk('images')->delete($image->name.'.webp');
            $message = "Материал успешно удален.";
        }else{
            $message = "При удалении изображение по такому пути не найденно на диске. Удалена только запись.";
        }

        //удалим из бд
        $image->delete();
        return $message;
    }
}
