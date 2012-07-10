<?php

namespace HTML5Lib\Tests;
use UnitTestCase;
use DOMDocument;

require_once __DIR__ . '/../../autorun.php';

class TestDataTest extends UnitTestCase
{
    function testSample() {
        $data = new TestData(__DIR__ . '/TestDataTest/sample.dat');
        $this->assertIdentical($data->tests, array(
            array('data' => "Foo\n", 'des' => "Bar\n"),
            array('data' => "Foo\n")
        ));
    }
    function testStrDom() {
        $dom = new DOMDocument();
        $dom->loadHTML('<!DOCTYPE html PUBLIC "http://foo" "http://bar"><html><body foo="bar" baz="1">foo<b>bar</b>asdf</body></html>');
        $this->assertIdentical(TestData::strDom($dom), <<<RESULT
| <!DOCTYPE html "http://foo" "http://bar">
| <html>
|   <body>
|     baz="1"
|     foo="bar"
|     "foo"
|     <b>
|       "bar"
|     "asdf"
RESULT
);
    }
}
