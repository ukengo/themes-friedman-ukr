<?php 
require 'vendor/autoload.php';

function clearchars2($str){
    //return htmlspecialchars(str_replace(array( '«', '»', '"', '\'', '/', '\\'), '', $str));
    return  str_replace(array('«', '»', '"'), '', $str );
    //
}

    use PHPStamp\Templator;
    use PHPStamp\Document\WordDocument;


        $cachePath = get_template_directory().'/docx-cache/';
        $templator = new Templator($cachePath);
        $templator->debug = true;
        $ph['doc_type'] = get_field('doc_type', $dID);
        $ph['doc_date'] = get_field('doc_date', $dID);
        $ph['company'] = get_field('company', $dID);
        $ph['director'] = get_field('director', $dID);
        $ph['edrpou'] = get_field('edrpou', $dID);
        $ph['tel'] = get_field('tel', $dID);
        $ph['rs'] = get_field('rs', $dID);
        $ph['bank'] = get_field('bank', $dID);
        $ph['mfo_bank'] = get_field('mfo_bank', $dID);
        $ph['inn'] = get_field('inn', $dID);
        $ph['svidet_nds'] = get_field('svidet_nds', $dID);
        $ph['id_doc'] = get_field('id_doc', $dID);

        if ($ph['doc_type']=='temp2') {
            $documentPath = get_template_directory().'/docx-templates/avto.docx';
            //$type_text = '-ТР';
            $type_text = get_field('suf_1', 1915);
        } else if ($ph['doc_type']=='temp1') {
            $documentPath = get_template_directory().'/docx-templates/mutno.docx';
            //$type_text = 'МВ-17';
            $type_text = get_field('suf_2', 1915);
        }
        $document = new WordDocument($documentPath);

        $values = array(
            'numberDoc' => $ph['id_doc'],
            'curDate' => $ph['doc_date'],
            'company' => $ph['company'],
            'director' => $ph['director'],
            'edrpou' => $ph['edrpou'],
            'address' => $ph['address'],
            'tel' => $ph['tel'],
            'rs' => $ph['rs'],
            'bank' => $ph['bank'],
            'mfo_bank' => $ph['mfo_bank'],
            'inn' => $ph['inn'],
            'svidet_nds' => 'Св-во платника ПДВ '.$ph['svidet_nds']

        );
        $result = $templator->render($document, $values);
           
            $doc_name = get_template_directory().'/docx/'.'Документ №'.$ph['id_doc'].$type_text.' - '.$ph['company'].'.docx';
            $doc_name_clear = 'Документ №'.$ph['id_doc'].$type_text.' - '.$ph['company'].'-'.$ph['edrpou'].'.docx';
            $doc_url = get_template_directory_uri().'/docx/'.'Документ №'.$ph['id_doc'].$type_text.' - '.clearchars2($ph['company']).'-'.$ph['edrpou'].'.docx';
            $doc = $result->buildFile();
            $res_doc = rename($doc, $doc_name);

$edit = array( 'post_title' => $doc_name_clear, 'ID' => $dID);

wp_update_post( wp_slash($edit) );



    update_field( 'url_to_doc', $doc_url, $dID );
    update_field( 'doc_name', clearchars2($doc_name_clear), $dID );
    
    
