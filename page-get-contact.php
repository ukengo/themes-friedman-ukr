<?
/*
Template Name: Оформить договор
*/


  require 'vendor/autoload.php';

    use PHPStamp\Templator;
    use PHPStamp\Document\WordDocument;


function clearchars($str){
	return str_replace(array( '\'', '/', '\\'), '', $str);
    //'«', '»', '"',
}

function clearchars2($str){
    //return htmlspecialchars(str_replace(array( '«', '»', '"', '\'', '/', '\\'), '', $str));
    return  str_replace(array('«', '»', '"'), '', $str );
    //
}


get_header();
$upload_dir = wp_upload_dir();
$upload_path = $upload_dir['basedir'];
//$upload_path = $upload_dir['path'];

$doc_path1 = get_field('document_template1');
$doc_path2 = get_field('document_template2');


$file_1 = get_attached_file($doc_path1['ID']);
$file_2 = get_attached_file($doc_path2['ID']);


  if(isset($_POST['doc_type'])) {

    $required=['doc_type', 'company', 'director', 'edrpou', 'tel'];
        foreach ($_POST as $key => $value) {
            if (in_array($key, $required) && $value == '') {
                $errors[$key] = $key;
            }
            $ph[$key]=clearchars($value);
        }
        if (!count($errors)) {

            $cachePath = get_template_directory().'/docx-cache/';
            $templator = new Templator($cachePath);
            $templator->debug = true;
            $documentPath = '';
            if ($ph['doc_type']=='temp1') {
//                $documentPath = get_template_directory().'/docx-templates/mutno.docx';
                $documentPath = $file_2;
                $type_text = get_field('suf_2');
//                $type_text = 'МБ-17';
            } else if ($ph['doc_type']=='temp2') {
//                                $documentPath = get_template_directory().'/docx-templates/avto.docx';
                $documentPath = $file_1;
                $type_text = get_field('suf_1');
//                $type_text = '-ТР';
            }
            $document = new WordDocument($documentPath);

             $args = array(
                'post_type' =>'docx',
                'posts_per_page' => 1
                );
            $recent_post = wp_get_recent_posts($args);
            $doc_id = get_field('id_doc', $recent_post[0]['ID']);
            $doc_id+=1;

            if($ph['svidet_nds']){
                $svidet_nds = 'Св-во платника ПДВ '.$ph['svidet_nds'];
            }else{
                $svidet_nds = '';
            }
            // $string = str_replace("'", "", "$string");

            $values = array(
                'numberDoc'  => $doc_id,
                'curDate'    => date("d.m.Y", strtotime('now')),
                // 'company'    => htmlspecialchars($ph['company']),
                //'company'    => htmlspecialchars(str_replace(array('«', '»', '"', "'"), '', $ph['company'])),
                'company'    => $ph['company'],
                'director'   => $ph['director'],
                'edrpou'     => $ph['edrpou'],
                'address'    => $ph['address'],
                'tel'        => $ph['tel'],
                'rs'         => $ph['rs'],
                'bank'       => $ph['bank'],
                'mfo_bank'   => $ph['mfo_bank'],
                'inn'        => $ph['inn'],
                'doc_name'   => 'Документ №'.$doc_id.$type_text.' - '.$ph['company'].'-'.$ph['edrpou'].'.docx', 
                'svidet_nds' => $svidet_nds,
                'typeText'  => $type_text
        
            );
            $result = $templator->render($document, $values);
           
            $doc_name = get_template_directory().'/docx/'.'Документ №'.$doc_id.$type_text.' - '.clearchars2($ph['company']).'-'.$ph['edrpou'].'.docx';
            $doc_name_clear = 'Документ №'.$doc_id.$type_text.' - '.$ph['company'].'-'.$ph['edrpou'].'.docx';
        
            $doc_url = get_template_directory_uri().'/docx/'.'Документ №'.$doc_id.$type_text.' - '.clearchars2($ph['company']).'-'.$ph['edrpou'].'.docx';


            //$doc_name = get_template_directory().'/docx/'.'Документ №'.$doc_id.$type_text.' - '.$ph['company'].'-'.$ph['edrpou'].'.docx';
            //$doc_name_clear = 'Документ №'.$doc_id.$type_text.' - '.$ph['company'].'-'.$ph['edrpou'].'.docx';
        
            //$doc_url = get_template_directory_uri().'/docx/'.'Документ №'.$doc_id.$type_text.' - '.$ph['company'].'-'.$ph['edrpou'].'.docx';


            $doc = $result->buildFile();
            $res_doc = rename($doc, $doc_name);

            $post_data = array(
                'post_title'      => wp_strip_all_tags($doc_name_clear),
                'post_content'    => '',
                'post_type'       => 'docx',
                'post_status'     => 'publish',
                'post_author'     => 1
                );

            // Вставляем запись в базу данных
            $post_id = wp_insert_post( $post_data );
            update_field( 'url_to_doc', $doc_url, $post_id );
            update_field( 'user_agent', $_SERVER[HTTP_USER_AGENT], $post_id );
            update_field( 'user_ip', $_SERVER[REMOTE_ADDR], $post_id );
            update_field( 'company', $ph['company'], $post_id );
            update_field( 'director', $ph['director'], $post_id );
            update_field( 'edrpou', $ph['edrpou'], $post_id );
            update_field( 'address', $ph['address'], $post_id );
            update_field( 'tel', $ph['tel'], $post_id );
            update_field( 'rs', $ph['rs'], $post_id );
            update_field( 'bank', $ph['bank'], $post_id );
            update_field( 'mfo_bank', $ph['mfo_bank'], $post_id );
            update_field( 'inn', $ph['inn'], $post_id );
            update_field( 'doc_type', $ph['doc_type'], $post_id );
            update_field( 'doc_date', date("d.m.Y", strtotime('now')), $post_id );
            update_field( 'id_doc', $doc_id, $post_id );
            update_field( 'doc_name', clearchars2($doc_name_clear), $post_id );

            $to = get_field('email_doc', 'options');
            $subject = 'Оформлен новый договор '.$doc_name_clear;
            $body = 'Пользователь оформил новый документ <br/>';
            $body.= 'Компания: '.$ph['company'].'<br/>';
            $body.= 'Директор: '.$ph['director'].'<br/>';
            $body.= 'Телефон: '.$ph['tel'].'<br/>';
            $body.= 'Скачать документ: <a href="'.$doc_url.'">'.$doc_name_clear.'</a><br/>';
            $body.= '<a href="//friedman.com.ua/wp-admin">Перейти в админ панель</a><br/>';
            $headers = array('Content-Type: text/html; charset=UTF-8');
             
            wp_mail( $to, $subject, $body, $headers );

        }
    }  

 ?>


    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/js/scripts.js"></script>
   

    <!-- content-position -->
    <div class="content-position">
<!--        <script type="text/javascript" src="--><?php //echo get_template_directory_uri(); ?><!--/js/scripts1.js"></script>-->
        
        <div class="content-column ">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">', '</div>');
            }
            ?>
            <h1><?php pll_e('Юридические формальности'); ?></h1>
            <ul class="tabs-nav">
                <li><a href="http://xn--80ahyflx1k.xn--j1amh/<?php pll_e('get-contract2'); ?>"><?php pll_e('Наши документы'); ?></a></li>
                <li><?php pll_e('Оформить договор'); ?></li>
            </ul>

            <div class="hr"></div>
            <? if (isset($_POST['doc_type']) && !$errors): ?>

            <div class="reg-complete">
                <h3><?php pll_e('Ваш договор успешно зарегистрирован в системе!'); ?></h3>

                <p>
                    <?php pll_e('Скачайте его по ссылке:'); ?><br /><br />
                    <a href="<?=$doc_url;?>"><img src="<?=get_template_directory_uri()?>/img/docx.png" alt=""/><?=$doc_name_clear;?></a>
                </p>
                <a class="back" href="/legal-formalities/get-contract/"><?php pll_e('вернуться к форме заполнения'); ?></a>
            </div>
        <? else : ?>
            <form name="oforml" method="post" enctype="multipart/form-data">
            <div class="note">
                <?php the_content();?>  
            </div>
            <ul class="el-pos">
                <li>
                    <label><?php pll_e('Тип договора'); ?></label>

                    <div class="contract-box">
                        <div class="custom-select">
                            <div class="output">
                                <div class="text">
                                    <? if (isset($ph) && $ph['doc_type']=='temp1'):?>
                                        На надання комісійних та митно-брокерських послуг
                                    <? elseif (isset($ph) && $ph['doc_type']=='temp2'):?>
                                        На Автотранспортні послуги
                                    <? endif; ?>
                                </div>
                                <div class="btn"></div>
                            </div>
                            <div class="select">
                                <input type="hidden" value="<? if(isset($ph)): echo $ph['doc_type']; endif?>" name="doc_type" id="doc">
                                  <select class= name="doc_type2">
                                    <option></option>
                                    <option value="temp1" data-doc-url="<? the_field('doc_temp1') ?>">На надання комісійних та митно-брокерських послуг</option>
                                    <option value="temp2" data-doc-url="<? the_field('doc_temp2') ?>">На Автотранспортні послуги</option>
                                  </select>
                            </div>
                        </div>
                            
                        <p><?php pll_e('Выберите один из типов договоров'); ?></p>

                        <div class="current-document">
                            <a href="#"><?php pll_e('скачать образец договора'); ?></a>
                        </div>

                    </div>

                    </li>
                    <li>
                        <label><?php pll_e('Компания'); ?></label>
                        <input type="text" <?if($errors['company']):?>class="error"<?endif;?> name="company" value="<?php if($ph['company']): echo $ph['company']; endif;?>"/>
                        <?if($errors['company']):?><p class="error"><?php pll_e('Название компании должно быть настоящим'); ?></p><?endif;?>
                    </li>
                    <li>
                        <label><?php pll_e('ФИО директора компании'); ?></label>
                        <input type="text" <?if($errors['director']):?>class="error"<?endif;?> name="director" value="<?php if($ph['director']): echo $ph['director']; endif;?>"/>
                        <?if($errors['director']):?><p class="error"><?php pll_e('Укажите Фамилию и инициалы директора компании'); ?></p><?endif;?>
                    </li>
                    <li>
                        <label><?php pll_e('Адрес компании'); ?></label>
                        <input type="text" <?if($errors['address']):?>class="error"<?endif;?> name="address" value="<?php if($ph['address']): echo $ph['address']; endif;?>" />
                        <?if($errors['address']):?><p class="error"><?php pll_e('Укажите правильный адресс компании'); ?></p><?endif;?>
                    </li>
                    <li>
                        <label><?php pll_e('Телефон'); ?></label>
                        <input type="text" <?if($errors['tel']):?>class="error"<?endif;?> name="tel" value="<?php if($ph['tel']): echo $ph['tel']; endif;?>" />
                        <?if($errors['tel']):?><p class="error"><?php pll_e('Укажите телефон'); ?></p><?endif;?>
                    </li>
                    <li>
                        <label>ЕДРПОУ</label>
                        <input type="text" <?if($errors['edrpou']):?>class="error"<?endif;?> name="edrpou" value="<?php if($ph['edrpou']): echo $ph['edrpou']; endif;?>" />
                        <?if($errors['edrpou']):?><p class="error"><?php pll_e('Укажите ЕДРПОУ'); ?></p><?endif;?>
                    </li>
                    <li>
                        <label><?php pll_e('Р/С'); ?></label>
                        <input type="text" <?if($errors['rs']):?>class="error"<?endif;?> name="rs" value="<?php if($ph['rs']): echo $ph['rs']; endif;?>" />
                        <?if($errors['rs']):?><p class="error"><?php pll_e('Не введён расчётный счёт'); ?></p><?endif;?>
                    </li>
                    <li>
                        <label>Банк плательщика</label>
                        <input type="text" <?if($errors['bank']):?>class="error"<?endif;?> name="bank" value="<?if($ph['bank']): echo $ph['bank']; endif;?>" />
                        <?if($errors['bank']):?><p class="error">Не введён расчётный счёт</p><?endif;?>
                    </li>
                    <li>
                        <label>МФО банка</label>
                        <input type="text" <?if($errors['mfo_bank']):?>class="error"<?endif;?> name="mfo_bank" value="<?php if($ph['mfo_bank']): echo $ph['mfo_bank']; endif;?>" />
                        <?if($errors['mfo_bank']):?><p class="error">Укажите корректный МФО банка</p><?endif;?>
                    </li>
                    <li>
                        <label>ИНН</label>
                        <input type="text" <?if($errors['inn']):?>class="error"<?endif;?> name="inn" value="<?php if($ph['inn']): echo $ph['inn']; endif;?>" />
                        <?if($errors['inn']):?><p class="error">Не был указан идентификационный номер налогоплательщика</p><?endif;?>
                    </li>
                    <li>
                        <label>Свидетельство<br>плательщика НДС</label>
                        <input type="text" name="svidet_nds" value="<?php if($ph['svidet_nds']): echo $ph['svidet_nds']; endif;?>" />
                    </li>
                    <li>
                        <input type="submit" value="<?php pll_e('Оформить договор'); ?>"/>
                    </li>
                </ul>
            </form>
            <? endif; ?>
        </div>
        


        <?php get_sidebar();?>
    </div>
<?php get_sidebar('news');?>
    <div class="footer-place"></div>
</section>

<?php get_footer();?>
