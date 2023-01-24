<?php

//Что делает этот код, так это то, что он будет показывать метатеги noindex на всем выгружаемом контенте (is_page) из Google.
//Он добавит мета-тег robots в часть HTML-кода,


add_filter("wpseo_robots", function ($robots) {
    if (is_paged()) {
        return 'noindex,follow';
    } else {
        return $robots;
    }
});



//if (!current_user_can('administrator')):
//  show_admin_bar(false);
//endif;

//JS & CSS
//add_action( 'wp_enqueue_scripts', 'mcd_scripts' );
//function mcd_scripts() {
//CSS
//    wp_enqueue_style( 'umenemac', get_template_directory_uri() . '/css/umenemac.min.css');

//JS
//  wp_enqueue_script( 'libs', get_template_directory_uri() . '/js/libs.min.js', array(), '1.0.0', true );
//    wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
//  wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-custom.js', array(), '1.0.0', true );
//    wp_enqueue_script( 'umenemac', get_template_directory_uri() . '/js/umenemac.min.js', array(), '1.0.0', true );
//}

//Delete WP jQeury
//function modify_jquery() {
//    if (!is_admin()) {
//        wp_deregister_script('jquery');
//    }
//}
//add_action('init', 'modify_jquery');

//delete emoji script
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

//default actions
remove_action('wp_head', 'feed_links_extra', 3); // убирает ссылки на rss категорий
remove_action('wp_head', 'feed_links', 2); // минус ссылки на основной rss и комментарии
remove_action('wp_head', 'rsd_link');  // сервис Really Simple Discovery
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head', 'wp_generator');  // скрыть версию wordpress
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// Disabled Update
// add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
// wp_clear_scheduled_hook('wp_version_check');
// remove_action( 'load-update-core.php', 'wp_update_plugins' );
// add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
// wp_clear_scheduled_hook( 'wp_update_plugins' );



remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_update_plugins');
//Add Options Page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

// Block Access to /wp-admin for non admins.
//function custom_blockusers_init() {
//  if ( is_user_logged_in() && is_admin() && !current_user_can( 'administrator' ) ) {
//    wp_redirect( home_url() );
//    exit;
//  }
//}
//add_action( 'init', 'custom_blockusers_init' ); // Hook into 'init'

//Add Menu Wp
register_nav_menus(
    array(
        'menu' => __('Основное меню'),
    )
);
if (function_exists('add_theme_support')) {
    add_theme_support('menu');
}

add_action('init', 'news_post_types');
function news_post_types()
{
    register_post_type('news', array(
        'label'  => null,
        'labels' => array(
            'name'               => 'Новости', // основное название для типа записи
            'singular_name'      => 'Новость', // название для одной записи этого типа
            'add_new'            => 'Добавить новость', // для добавления новой записи
            'add_new_item'       => 'Добавление новости', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать новость', // для редактирования типа записи
            'new_item'           => 'Новая запись', // текст новой записи
            'view_item'          => 'Просмотр новости', // для просмотра записи этого типа.
            'search_items'       => 'Поиск новости', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'В корзине не найдено', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Новости', // название меню
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => null,
        'exclude_from_search' => null,
        'show_ui'             => null,
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => null,
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 3,
        'menu_icon'           => null,
        'hierarchical'        => true,
        'supports'            => array('title', 'editor'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => array(),
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
        'menu_icon'           => 'dashicons-media-document'
    ));
    register_post_type('docx', array(
        'label'  => null,
        'labels' => array(
            'name'               => 'Документы', // основное название для типа записи
            'singular_name'      => 'Документ', // название для одной записи этого типа
            'add_new'            => 'Добавить документ', // для добавления новой записи
            'add_new_item'       => 'Добавление документа', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать документ', // для редактирования типа записи
            'new_item'           => 'Новый документ', // текст новой записи
            'view_item'          => 'Просмотр документа', // для просмотра записи этого типа.
            'search_items'       => 'Поиск документа', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'В корзине не найдено', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Документы', // название меню
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => null,
        'exclude_from_search' => null,
        'show_ui'             => null,
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => null,
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 3,
        'menu_icon'           => null,
        'hierarchical'        => true,
        'supports'            => array('title', 'editor'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => array(),
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
        'menu_icon'           => 'dashicons-media-document'
    ));
}
//add_action('init', 'news_taxonomy');
//function news_taxonomy(){
//    $labels = array(
//        'name'              => 'Категории',
//        'singular_name'     => 'Категория',
//        'search_items'      => 'Найти категорию',
//        'all_items'         => 'Все категории',
//        'parent_item'       => 'Родительский тип',
//        'parent_item_colon' => 'Родительские типы',
//        'edit_item'         => 'Редактировать категорию',
//        'update_item'       => 'Обновить категорию',
//        'add_new_item'      => 'Добавить категорию',
//        'new_item_name'     => 'Новая категория',
//        'menu_name'         => 'Категория',
//    );
//    // параметры
//    $args = array(
//        'label'                 => '', // определяется параметром $labels->name
//        'labels'                => $labels,
//        'description'           => '', // описание таксономии
//        'public'                => true,
//        'publicly_queryable'    => null, // равен аргументу public
//        'show_in_nav_menus'     => true, // равен аргументу public
//        'show_ui'               => true, // равен аргументу public
//        'show_tagcloud'         => true, // равен аргументу show_ui
//        'show_in_rest'          => null, // добавить в REST API
//        'rest_base'             => null, // $taxonomy
//        'hierarchical'          => true,
//        'update_count_callback' => '',
//        'rewrite'               => true,
//        //'query_var'             => $taxonomy, // название параметра запроса
//        'capabilities'          => array(),
//        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
//        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
//        '_builtin'              => false,
//        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
//    );
//    register_taxonomy('rubrics', array('rubrics'), $args );
//}


add_action('pre_get_posts', function ($q) {

    if (!is_admin() && $q->is_main_query() && $q->is_post_type_archive('news')) {

        $q->set('posts_per_page', 10);
    }
});

function remove_menus()
{
    //    remove_menu_page('index.php');                  //Консоль
    remove_menu_page('edit.php');                     //Записи
    //    remove_menu_page('upload.php');                 //Медиафайлы
    //    remove_menu_page('edit.php?post_type=page');    //Страницы
    //    remove_menu_page('edit-comments.php');          //Комментарии
    //    remove_menu_page('themes.php');                 //Внешний вид
    //    remove_menu_page('plugins.php');                //Плагины
    //    remove_menu_page('users.php');                  //Пользователи
    //    remove_menu_page('tools.php');                  //Инструменты
    //    remove_menu_page('options-general.php');        //Настройки

    //    remove_menu_page('admin.php?page=pmxi-admin-import');
    //    remove_menu_page('edit.php?post_type=acf-field-group');
    //        remove_menu_page( 'admin.php?page=Wordfence' );
    //        remove_menu_page( 'admin.php?page=pmxi-admin-import' );
    //        remove_menu_page( 'admin.php?page=wpseo_dashboard' );
}

add_action('admin_menu', 'remove_menus');

//function my_acf_google_map_api( $api ){
//
//    $api['key'] = 'IzaSyCAiXyBq0gGlBaj1zM3Nyb75v-jJ3g3i-0';
//
//    return $api;
//
//}
//
//add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//function my_acf_init() {
//
//    acf_update_setting('google_api_key', 'AIzaSyBvW5wdstfGS9kLXJz4ZsyCj1Qr51_czMs');
//}
//
//add_action('acf/init', 'my_acf_init');

function my_upload_mimes()
{
    $mime_types = array(
        //        '323'     => 'text/h323',
        //        'acx'     => 'application/internet-property-stream',
        //        'ai'      => 'application/postscript',
        //        'aif'     => 'audio/x-aiff',
        //        'aifc'    => 'audio/x-aiff',
        //        'aiff'    => 'audio/x-aiff',
        //        'asf'     => 'video/x-ms-asf',
        //        'asr'     => 'video/x-ms-asf',
        //        'asx'     => 'video/x-ms-asf',
        //        'au'      => 'audio/basic',
        //        'avi'     => 'video/x-msvideo',
        //        'axs'     => 'application/olescript',
        //        'bas'     => 'text/plain',
        //        'bcpio'   => 'application/x-bcpio',
        //        'bin'     => 'application/octet-stream',
        //        'bmp'     => 'image/bmp',
        //        'c'       => 'text/plain',
        //        'cat'     => 'application/vnd.ms-pkiseccat',
        //        'cdf'     => 'application/x-cdf',
        //        'cer'     => 'application/x-x509-ca-cert',
        //        'class'   => 'application/octet-stream',
        //        'clp'     => 'application/x-msclip',
        //        'cmx'     => 'image/x-cmx',
        //        'cod'     => 'image/cis-cod',
        //        'cpio'    => 'application/x-cpio',
        //        'crd'     => 'application/x-mscardfile',
        //        'crl'     => 'application/pkix-crl',
        //        'crt'     => 'application/x-x509-ca-cert',
        //        'csh'     => 'application/x-csh',
        //        'css'     => 'text/css',
        //        'dcr'     => 'application/x-director',
        //        'der'     => 'application/x-x509-ca-cert',
        //        'dir'     => 'application/x-director',
        //        'dll'     => 'application/x-msdownload',
        //        'dms'     => 'application/octet-stream',
        //        'doc'     => 'application/msword',
        //        'dot'     => 'application/msword',
        //        'dvi'     => 'application/x-dvi',
        //        'dxr'     => 'application/x-director',
        //        'eps'     => 'application/postscript',
        //        'etx'     => 'text/x-setext',
        //        'evy'     => 'application/envoy',
        //        'exe'     => 'application/octet-stream',
        //        'fif'     => 'application/fractals',
        //        'flr'     => 'x-world/x-vrml',
        //        'gif'     => 'image/gif',
        //        'gtar'    => 'application/x-gtar',
        //        'gz'      => 'application/x-gzip',
        //        'h'       => 'text/plain',
        //        'hdf'     => 'application/x-hdf',
        //        'hlp'     => 'application/winhlp',
        //        'hqx'     => 'application/mac-binhex40',
        //        'hta'     => 'application/hta',
        //        'htc'     => 'text/x-component',
        //        'htm'     => 'text/html',
        //        'html'    => 'text/html',
        //        'htt'     => 'text/webviewhtml',
        //        'ico'     => 'image/x-icon',
        //        'ief'     => 'image/ief',
        //        'iii'     => 'application/x-iphone',
        //        'ins'     => 'application/x-internet-signup',
        //        'isp'     => 'application/x-internet-signup',
        //        'jfif'    => 'image/pipeg',
        //        'jpe'     => 'image/jpeg',
        //        'jpeg'    => 'image/jpeg',
        //        'jpg'     => 'image/jpeg',
        //        'rar'     => 'application/x-rar-compressed',
        //        'js'      => 'application/x-javascript',
        //        'latex'   => 'application/x-latex',
        //        'lha'     => 'application/octet-stream',
        //        'lsf'     => 'video/x-la-asf',
        //        'lsx'     => 'video/x-la-asf',
        //        'lzh'     => 'application/octet-stream',
        //        'm13'     => 'application/x-msmediaview',
        //        'm14'     => 'application/x-msmediaview',
        //        'm3u'     => 'audio/x-mpegurl',
        //        'man'     => 'application/x-troff-man',
        //        'mdb'     => 'application/x-msaccess',
        //        'me'      => 'application/x-troff-me',
        //        'mht'     => 'message/rfc822',
        //        'mhtml'   => 'message/rfc822',
        //        'mid'     => 'audio/mid',
        //        'mny'     => 'application/x-msmoney',
        //        'mov'     => 'video/quicktime',
        //        'movie'   => 'video/x-sgi-movie',
        //        'mp2'     => 'video/mpeg',
        //        'mp3'     => 'audio/mpeg',
        //        'mpa'     => 'video/mpeg',
        //        'mpe'     => 'video/mpeg',
        //        'mpeg'    => 'video/mpeg',
        //        'mpg'     => 'video/mpeg',
        //        'mpp'     => 'application/vnd.ms-project',
        //        'mpv2'    => 'video/mpeg',
        //        'ms'      => 'application/x-troff-ms',
        //        'mvb'     => 'application/x-msmediaview',
        //        'nws'     => 'message/rfc822',
        //        'oda'     => 'application/oda',
        //        'p10'     => 'application/pkcs10',
        //        'p12'     => 'application/x-pkcs12',
        //        'p7b'     => 'application/x-pkcs7-certificates',
        //        'p7c'     => 'application/x-pkcs7-mime',
        //        'p7m'     => 'application/x-pkcs7-mime',
        //        'p7r'     => 'application/x-pkcs7-certreqresp',
        //        'p7s'     => 'application/x-pkcs7-signature',
        //        'pbm'     => 'image/x-portable-bitmap',
        //        'pdf'     => 'application/pdf',
        //        'pfx'     => 'application/x-pkcs12',
        //        'pgm'     => 'image/x-portable-graymap',
        //        'pko'     => 'application/ynd.ms-pkipko',
        //        'pma'     => 'application/x-perfmon',
        //        'pmc'     => 'application/x-perfmon',
        //        'pml'     => 'application/x-perfmon',
        //        'pmr'     => 'application/x-perfmon',
        //        'pmw'     => 'application/x-perfmon',
        //        'pnm'     => 'image/x-portable-anymap',
        //        'pot'     => 'application/vnd.ms-powerpoint',
        //        'ppm'     => 'image/x-portable-pixmap',
        //        'pps'     => 'application/vnd.ms-powerpoint',
        //        'ppt'     => 'application/vnd.ms-powerpoint',
        //        'prf'     => 'application/pics-rules',
        //        'ps'      => 'application/postscript',
        //        'pub'     => 'application/x-mspublisher',
        //        'qt'      => 'video/quicktime',
        //        'ra'      => 'audio/x-pn-realaudio',
        //        'ram'     => 'audio/x-pn-realaudio',
        //        'ras'     => 'image/x-cmu-raster',
        //        'rgb'     => 'image/x-rgb',
        //        'rmi'     => 'audio/mid',
        //        'roff'    => 'application/x-troff',
        //        'rtf'     => 'application/rtf',
        //        'rtx'     => 'text/richtext',
        //        'scd'     => 'application/x-msschedule',
        //        'sct'     => 'text/scriptlet',
        //        'setpay'  => 'application/set-payment-initiation',
        //        'setreg'  => 'application/set-registration-initiation',
        //        'sh'      => 'application/x-sh',
        //        'shar'    => 'application/x-shar',
        //        'sit'     => 'application/x-stuffit',
        //        'snd'     => 'audio/basic',
        //        'spc'     => 'application/x-pkcs7-certificates',
        //        'spl'     => 'application/futuresplash',
        //        'src'     => 'application/x-wais-source',
        //        'sst'     => 'application/vnd.ms-pkicertstore',
        //        'stl'     => 'application/vnd.ms-pkistl',
        //        'stm'     => 'text/html',
        //        'svg'     => 'image/svg+xml',
        //        'sv4cpio' => 'application/x-sv4cpio',
        //        'sv4crc'  => 'application/x-sv4crc',
        //        't'       => 'application/x-troff',
        //        'tar'     => 'application/x-tar',
        //        'tcl'     => 'application/x-tcl',
        //        'tex'     => 'application/x-tex',
        //        'texi'    => 'application/x-texinfo',
        //        'texinfo' => 'application/x-texinfo',
        //        'tgz'     => 'application/x-compressed',
        //        'tif'     => 'image/tiff',
        //        'tiff'    => 'image/tiff',
        //        'tr'      => 'application/x-troff',
        //        'trm'     => 'application/x-msterminal',
        //        'tsv'     => 'text/tab-separated-values',
        //        'txt'     => 'text/plain',
        //        'uls'     => 'text/iuls',
        //        'ustar'   => 'application/x-ustar',
        //        'vcf'     => 'text/x-vcard',
        //        'vrml'    => 'x-world/x-vrml',
        //        'wav'     => 'audio/x-wav',
        //        'wcm'     => 'application/vnd.ms-works',
        //        'wdb'     => 'application/vnd.ms-works',
        //        'wks'     => 'application/vnd.ms-works',
        //        'wmf'     => 'application/x-msmetafile',
        //        'wps'     => 'application/vnd.ms-works',
        //        'wri'     => 'application/x-mswrite',
        //        'wrl'     => 'x-world/x-vrml',
        //        'wrz'     => 'x-world/x-vrml',
        //        'xaf'     => 'x-world/x-vrml',
        //        'xbm'     => 'image/x-xbitmap',
        //        'xla'     => 'application/vnd.ms-excel',
        //        'xlc'     => 'application/vnd.ms-excel',
        //        'xlm'     => 'application/vnd.ms-excel',
        //        'xls'     => 'application/vnd.ms-excel',
        //        'xlt'     => 'application/vnd.ms-excel',
        //        'xlw'     => 'application/vnd.ms-excel',
        //        'xof'     => 'x-world/x-vrml',
        //        'xpm'     => 'image/x-xpixmap',
        //        'xwd'     => 'image/x-xwindowdump',
        //        'z'       => 'application/x-compress',
        //        'zip'     => 'application/zip'
    );
    return $mime_types;
}
//add_filter( 'upload_mimes', 'my_upload_mimes' );

add_action('pre_get_posts', 'change_order_post_list', 1);
function change_order_post_list($query)
{
    if (is_admin() && $query->is_main_query() && $query->query_vars['post_type'] == 'docx') {
        $query->set('order', 'desc');
        $query->set('orderby', 'Date');
    }
}

// подключаем пользовательские строки в Polylang перевод
add_action('init', function () {
    pll_register_string('polylang', 'Поиск');
    pll_register_string('polylang', 'Узнать больше');
    pll_register_string('polylang', 'Свежие новости раздела');
    pll_register_string('polylang', 'Вы искали: ');
    pll_register_string('polylang', 'Детальнее');
    pll_register_string('polylang', 'Поиск не дал результатов');
    pll_register_string('polylang', 'Разрешительные документы');
    pll_register_string('polylang', 'Таможенное оформление');
    pll_register_string('polylang', 'Перевозки');
    pll_register_string('polylang', 'Прочие услуги в сфере ВЭД');
    pll_register_string('polylang', 'Получить консультацию');
    pll_register_string('polylang', 'Другие материалы по теме');
    pll_register_string('polylang', 'Юридические формальности');
    pll_register_string('polylang', 'Наши документы');
    pll_register_string('polylang', 'Оформить договор');
    pll_register_string('polylang', 'Заказ услуг');
    //pll_register_string('polylang', 'Получить консультацию');
    pll_register_string('polylang', 'База знаний');
    pll_register_string('polylang', 'Другие материалы по теме');
    pll_register_string('polylang', 'Читать дальше');
    pll_register_string('polylang', 'Новости');
    pll_register_string('polylang', 'Читать все');

    pll_register_string('polylang', 'Ваш договор успешно зарегистрирован в системе!');
    pll_register_string('polylang', 'Скачайте его по ссылке:');
    pll_register_string('polylang', 'вернуться к форме заполнения');
    pll_register_string('polylang', 'Тип договора');
    pll_register_string('polylang', 'Выберите один из типов договоров');
    pll_register_string('polylang', 'скачать образец договора');
    pll_register_string('polylang', 'Компания');
    pll_register_string('polylang', 'Название компании должно быть настоящим');
    pll_register_string('polylang', 'ФИО директора компании');
    pll_register_string('polylang', 'Укажите Фамилию и инициалы директора компании');
    pll_register_string('polylang', 'Адрес компании');
    pll_register_string('polylang', 'Укажите правильный адресс компании');
    pll_register_string('polylang', 'Телефон');
    pll_register_string('polylang', 'Укажите телефон');
    pll_register_string('polylang', 'Укажите ЕДРПОУ');
    pll_register_string('polylang', 'Р/С');
    pll_register_string('polylang', 'Не введён расчётный счёт');
    pll_register_string('polylang', 'ООО «Фридман-Украина»');
    pll_register_string('polylang', 'Как к нам добраться:');
    pll_register_string('polylang', 'Обратная связь:');
    pll_register_string('polylang', 'Украина');
    pll_register_string('polylang', 'Страница не найдена');
    pll_register_string('polylang', 'Вернуться на главную');
    pll_register_string('polylang', ' Контакты ');
    pll_register_string('polylang', ' О компании ');
    pll_register_string('polylang', '<strong>Получить</strong> консультацию');
    pll_register_string('polylang', 'link_form');
    pll_register_string('polylang', 'read_all');
    pll_register_string('polylang', 'other_materials');
    pll_register_string('social1', 'social2');
    pll_register_string('uzb', 'uzb2');
    pll_register_string('today', 'today1');
    pll_register_string('docs', 'docs1');
    pll_register_string('tam', 'tam1');
    pll_register_string('move', 'move1');
    pll_register_string('other', 'other1');
    pll_register_string('polylang', 'get-contract');
    pll_register_string('polylang', 'documents-link');
    pll_register_string('polylang', 'get-contract1');
    pll_register_string('polylang', 'get-contract2');
    pll_register_string('polylang', 'main-link');
    pll_register_string('polylang', 'breadcrumbs-home1222');
    pll_register_string('polylang', 'cur_lang');
    pll_register_string('polylang', 'news_link');
    pll_register_string('polylang', 'order_link_lang');
    pll_register_string('polylang', 'Сегодня');
    pll_register_string('polylang', 'today');
});
