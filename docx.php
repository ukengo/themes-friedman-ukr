<?
    require 'vendor/autoload.php';

    use PHPStamp\Templator;
    use PHPStamp\Document\WordDocument;

    $cachePath = 'docx-cache/';
    $templator = new Templator($cachePath); // опционально можно задать свой формат скобочек
    // Для того чтобы каждый раз шаблон генерировался заново: 
    $templator->debug = true;

    $documentPath = 'docx-templates/example.docx';
    $document = new WordDocument($documentPath);

    $values = array(
        'library' => 'PHPStamp 0.1',
        'simpleValue' => 'I am simple value',
        'nested' => array(
            'firstValue' => 'First child value',
            'secondValue' => 'Second child value'
        ),
        'header' => 'test of a table row',
        'students' => array(
            array('id' => 1, 'name' => 'Student 1', 'mark' => '10'),
            array('id' => 2, 'name' => 'Student 2', 'mark' => '4'),
            array('id' => 3, 'name' => 'Student 3', 'mark' => '7')
        ),
        'maxMark' => 10,
        'todo' => array(
            'TODO 1',
            'TODO 2',
            'TODO 3'
        )
    );
    $result = $templator->render($document, $values);
    $result->download();


    phpinfo();
    



