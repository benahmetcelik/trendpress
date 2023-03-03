<?php

require_once TRENDPRESS_PLUGIN_DIR . "Trendyol.php";
require_once TRENDPRESS_PLUGIN_DIR . "Watermark.php";
function tp_connect_class()
{
    return new Trendyol();
}

function tp_get_trendyol_products($category)
{
    $trendpress = tp_connect_class();
    print_r($trendpress->infinite_scroll($category));
    // return $products;
}

function tp_permalink($str)
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $options = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


function tp_brands()
{
    $brands =file_get_contents(TRENDPRESS_PLUGIN_DIR . '/assets/brands.json');
    $brands = json_decode($brands);
    foreach ($brands as $brand) {
        echo '<option value="' . $brand->id . '">' . $brand->name . '</option>';
    }
}

function tp_level($level)
{
    $level = $level + 1;
    $str = '';
    for ($i = 0; $i < $level; $i++) {
        $str .= '--';
    }
    return $str;
}

function tp_watermark($source)
{

    $image = new Watermark();
    $custom_logo_id = get_theme_mod('custom_logo');
    $image_url = wp_get_attachment_image_src($custom_logo_id, 'full');
    if ($image_url && $image_url[0]) {
        $image_url = $image_url[0];
    } else {
        $image_url = TRENDPRESS_PLUGIN_DIR . '/assets/images/logo.png';
    }


    try {
        return $image->watermark($source, $image_url);
    } catch (Exception $e) {
        return $source;
    }
}

function tp_product_detail($id, $merchantId, $campaignId)
{
    $trendyol = new Trendyol();
    return $trendyol->product_detail($id, $merchantId, $campaignId);

}


function tp_create_product($id, $product, $category_id, $fligran, $spin, $publish_status, $double_spin, $commission_type, $commission_amount)
{
    if ($category_id == 0) {
        $category_id = wp_create_category($product->categoryName);

        $term = wp_insert_term( $product->categoryName, 'product_cat', [
                'description'=> $product->categoryName,
                'slug' => tp_permalink($product->categoryName) ]
        );

        $category_id = $term['term_id'];
    }

   

    $trendyol_product = $product;
    if (count($product->images) > 0) {
        if ($fligran) {
            foreach ($product->images as $image) {
                $images[] =  site_url() . '/wp-content' .tp_watermark(tp_image_save('https://cdn.dsmcdn.com/' . $image));
            }
        } else {
            foreach ($product->images as $image) {
                $images[] =  tp_image_save('https://cdn.dsmcdn.com/' . $image);
            }
        }


        

    }else{
        $images = [];
    }
    foreach ($images as $image) {
        $image_name = rand(1, 999999999) . '.jpg';

        $image_id = wp_insert_attachment(
            array(
                'guid' => $image,
                'post_mime_type' => 'image/jpeg',
                'post_title' => $image_name,
                'post_content' => '',
                'post_status' => 'inherit',
            ), $image
        );
        $image_ids[] = $image_id;

    }
    if ($spin) {
        $name = tp_spin($product->name);
        $description = tp_product_detail($product->id, $product->merchantId, $product->campaignId)->contentDescriptions;
        if (count($description) > 4){
            $description = $description[0]->description;
        }else{
            $description = $product->name;
        }
        $description = tp_spin($description);
    }
    if ($double_spin) {
        $name = tp_spin($name);
        $description = tp_spin($description);
    }
    $product = get_page_by_title($name, OBJECT, 'product');
    if (is_null($product)) {
        $category = get_the_category_by_ID($category_id);
        $post = array(
            'post_content' => $description,
            'post_status' => $publish_status,
            'post_title' => $name,
            'post_parent' => '',
            'post_type' => "product",
           
        );
        $product_id = wp_insert_post($post, false);
            wp_set_object_terms( $product_id, $category, 'product_cat' );
        $product = wc_get_product($product_id);

    } else {

        $product = wc_get_product($product->ID);

    }
  
    @$product->set_image_id($image_ids[0]);
    $product->set_regular_price(tp_commission($commission_type,$commission_amount,$trendyol_product->price->manipulatedOriginalPrice));
    $product->save();
    add_post_meta($product->get_id(), '_product_image_gallery', implode(',', $image_ids));
    $productPost = get_page_by_title($name, OBJECT, 'product');
    $product = wc_get_product($productPost->ID);
    $detail = tp_product_detail($trendyol_product->id, $trendyol_product->merchantId, $trendyol_product->campaignId);
    if (count($detail->variants) > 1) {
        wp_set_object_terms($product->get_id(), 'variable', 'product_type');
        foreach ($detail->variants as $variant) {
            if ($variant->attributeName == 'Renk') {
                if (wc_attribute_taxonomy_id_by_name('Renk') < 1) {
                    wc_create_attribute([
                        'name' => 'Renk',
                        'slug' => 'renk',
                        'type' => 'select',
                        'order_by' => 'menu_order',
                        'has_archives' => false,
                    ]);
                }
               foreach ($detail->variants as $attrbutes_loop){
                    $attrbutes[] = $attrbutes_loop->attributeValue;
                }
                $term_taxonomy_ids = wp_set_object_terms($product->get_id(), $attrbutes, 'pa_renk', false);
                $term = get_term_by('id', $term_taxonomy_ids[0], 'pa_renk', OBJECT);
                $theData = array(
                    'pa_renk' => array(
                        'name' => 'pa_renk',
                        'value' => $term->slug,
                        'is_visible' => '1',
                        'is_variation' => '1',
                        'is_taxonomy' => '1'
                    )
                );
                $variation_post = array(
                    'post_title' => $product->get_title() . ' - ' . $variant->attributeValue,
                    'post_name' => sanitize_title($product->get_title() . ' ' . $variant->attributeValue),
                    'post_status' => 'publish',
                    'post_excerpt' => 'Renk : ' . $variant->attributeValue,
                    'post_parent' => $product->get_id(),
                    'post_type' => 'product_variation',
                    'guid' => $product->get_permalink(),
                    'meta_input' => array(
                        'attribute_pa_renk' => $variant->attributeValue
                    )
                );
            }
            if ($variant->attributeName == 'Beden') {
                if (wc_attribute_taxonomy_id_by_name('Beden') < 1) {
                    wc_create_attribute([
                        'name' => 'Beden',
                        'slug' => 'beden',
                        'type' => 'select',
                        'order_by' => 'menu_order',
                        'has_archives' => false,
                    ]);
                }
                foreach ($detail->variants as $attrbutes_loop){
                    $attrbutes[] = $attrbutes_loop->attributeValue;
                }
                $term_taxonomy_ids = wp_set_object_terms($product->get_id(), $attrbutes, 'pa_beden', false);
                $term = get_term_by('id', $term_taxonomy_ids[0], 'pa_beden', OBJECT);
                $theData = array(
                    'pa_beden' => array(
                        'name' => 'pa_beden',
                        'value' => $term->slug,
                        'is_visible' => '1',
                        'is_variation' => '1',
                        'is_taxonomy' => '1'
                    )
                );
                $variation_post = array(
                    'post_title' => $product->get_title() . ' - ' . $variant->attributeValue,
                    'post_name' => sanitize_title($product->get_title() . ' ' . $variant->attributeValue),
                    'post_status' => 'publish',
                    'post_excerpt' => 'Beden : ' . $variant->attributeValue,
                    'post_parent' => $product->get_id(),
                    'post_type' => 'product_variation',
                    'guid' => $product->get_permalink(),
                    'meta_input' => array(
                        'attribute_pa_beden' => $variant->attributeValue
                    )
                );
            }
            update_post_meta($product->get_id(), '_product_attributes', $theData);
            $variation_id = wp_insert_post($variation_post);
            $variation = new WC_Product_Variation($variation_id);
            $variation->set_sku(rand(1000000, 9999999));
            $variation->set_price(tp_commission($commission_type,$commission_amount,$variant->price->sellingPrice->value));
            $variation->set_regular_price(tp_commission($commission_type,$commission_amount,$variant->price->sellingPrice->value));
            $variation->set_downloadable(true);
            $variation->set_manage_stock(false);
            $variation->set_weight('');
            $variation->save();

        }
    }else{
        $product->set_price(tp_commission($commission_type,$commission_amount,$detail->variants[0]->price->sellingPrice->value));
        $product->set_regular_price(tp_commission($commission_type,$commission_amount,$detail->variants[0]->price->sellingPrice->value));
        $product->save();
    }
}
function tp_commission($commission_type,$commission_amount,$price){
    if($commission_type == 0){
        $commission = ($price * $commission_amount / 100)+$price;
    }else{
        $commission =$price+ $commission_amount;
    }
    return $commission;


}

function tp_category_tree($category_id)
{
    $category = get_category($category_id);

    if ($category->parent == 0) {
        return $category->name;
    }
    for ($i = 0; $i < 40; $i++) {
        if ($category->parent != 0) {
            $category[$i] = get_category($category->parent);
            $category_tree[] = $category->name;
        }
    }
    $category_tree = implode(' > ', $category_tree);
    return $category_tree;
}

function tp_group_by($data)
{
    $result = array();

    foreach ($data as $key => $val) {
        $result[$val->attributeName][] = $val->attributeValue;
    }
    return $result;

}

function tp_spin($text)
{
    $spinner = json_decode(file_get_contents(TRENDPRESS_PLUGIN_DIR . '/assets/spin.json'));
    $text = explode(' ', $text);
    $result = array();
    foreach ($text as $one_word){
        $trim_text = trim($one_word);
        if ($spinner->$one_word != null){
            $result[] = $spinner->$one_word;

        }else{
            $result[] = $one_word;
        }
    }
    return implode(' ',$result);
}

function tp_image_save($url)
{
    // create a new Image instance for inserting
    $image_name = rand(1, 1000) . time() . '.jpg';
    //Varsayılan Yükleme Klasörü
    $upload_dir = wp_upload_dir();
    //Resimin Bilgilerini Getir
    $image_data = file_get_contents($url);
    //Yoksa yükleme klasörünü oluştur
    if (wp_mkdir_p($upload_dir['path']))
        $file = $upload_dir['path'] . '/' . $image_name ;
    //Varsa Yüklemeye Devam Et
    else
        $file = $upload_dir['basedir'] . '/' . $image_name ;
    //Resim datasını dosyaya yaz
    file_put_contents($file, $image_data);
    $image_name = explode('wp-content', $file);
    return $image_name[1];

}


function tp_csv_to_array($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}


function tp_get_product($id)
{
    $product = wc_get_product($id);
    return $product;
}


