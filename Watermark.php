<?php

use Intervention\Image\Image;

class Watermark
{


    protected $interventon;
    public function __construct()
    {
        $this->interventon = new Intervention\Image\ImageManager();
    }

    public  function watermark($source_url,$watermark_url){

        // create a new Image instance for inserting
        $image_name = rand(1,1000).time().'.jpg';
        //Varsayılan Yükleme Klasörü
        $upload_dir = wp_upload_dir();
        //Resimin Bilgilerini Getir
        $image_data = file_get_contents($source_url);
        //Yoksa yükleme klasörünü oluştur
        if (wp_mkdir_p($upload_dir['path']))
            $file = $upload_dir['path'] . '/' . $image_name;
        //Varsa Yüklemeye Devam Et
        else
            $file = $upload_dir['basedir'] . '/' . $image_name;
        //Resim datasını dosyaya yaz
        file_put_contents($file, $image_data);
        $source = $this->interventon->make($file);
        $source->insert($watermark_url, 'bottom-center', 10, 150);
        $source->save($file);
        $image_name = explode('wp-content',$file);

        return $image_name[1];

    }




}