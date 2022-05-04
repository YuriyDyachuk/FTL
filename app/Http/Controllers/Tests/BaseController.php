<?php


namespace App\Http\Controllers\Tests;


use App\Http\Controllers\Controller;
use DOMDocument;
use DOMXPath;
use SimpleXMLElement;
use Symfony\Component\Process\Process;

class BaseController extends Controller
{
    protected string $xmlTestResultFileName;
    protected string $htmlTestResultFileName;
    protected SimpleXMLElement $testResultsXmlObject;
    private int $runningTime;

    public function __construct()
    {
        $this->runningTime = time();
        $this->xmlTestResultFileName = 'phpunit/logs/'.$this->runningTime.'.xml';
        $this->htmlTestResultFileName = 'phpunit/logs/'.$this->runningTime.'.html';
    }

    protected function run(string $testClass):void
    {
        $classPath = './tests//'.str_replace(['Tests\\', '\\'], ['', '//'], $testClass);
        $process = new Process([
                './vendor/bin/phpunit',
                $classPath,
                '--log-junit',
                'public/'.$this->xmlTestResultFileName,
                '--testdox-html',
                'public/'.$this->htmlTestResultFileName
            ],
            base_path());

        $process->run();
        $this->testResultsXmlObject = simplexml_load_file('phpunit/logs/'.$this->runningTime.'.xml');
    }

    public function getResultsList():array
    {
        $results = [];

        $doc = new DOMDocument();
        $doc->loadHTMLFile($this->htmlTestResultFileName);
        $xpath = new DOMXpath($doc);

        $nodes = $xpath->query("/html/body/ul/li");

        foreach ($nodes as $i => $node) {
            $symbol = mb_substr($node->nodeValue, 0, 1);
            $text = mb_strtolower(mb_substr($node->nodeValue, 2));
            if(strpos($text, '::') > 0){
                $text = mb_substr($text, strpos($text, '::')+2);
            }
            $results[] = [
                'text' => $text,
                'symbol' => $symbol,
                'class' => $symbol === '✓' ? 'bg-success' : 'bg-danger'
            ];
        }

        $this->removeLogFiles();

        return $results;
    }

    private function removeLogFiles()
    {
        unlink($this->xmlTestResultFileName);
        unlink($this->htmlTestResultFileName);
    }

}
