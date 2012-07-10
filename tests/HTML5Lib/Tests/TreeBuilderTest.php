<?php

namespace HTML5Lib\Tests;
use HTML5Lib\Tokenizer;
use SimpleTest;

require_once __DIR__ . '/../../autorun.php';

SimpleTest::ignore('HTML5Lib\Tests\TreeBuilderHarness');
class TreeBuilderHarness extends TestDataHarness
{
    public function assertIdentical($expect, $actual, $test = array()) {
        $input = $test['data'];
        if (isset($test['document-fragment'])) {
            $input .= "\nFragment: " . $test['document-fragment'];
        }
        parent::assertIdentical($expect, $actual, "Identical expectation failed\nInput:\n$input\n\nExpected:\n$expect\n\nActual:\n$actual\n");
    }
    public function invoke($test) {
        // this is totally the wrong interface to use, but
        // for now we need testing
        $tokenizer = new Tokenizer($test['data']);
        $GLOBALS['TIME'] -= get_microtime();
        if (isset($test['document-fragment'])) {
            $tokenizer->parseFragment($test['document-fragment']);
        } else {
            $tokenizer->parse();
        }
        $GLOBALS['TIME'] += get_microtime();
        $this->assertIdentical(
            $test['document'],
            TestData::strDom($tokenizer->save()),
            $test
        );
    }
}

TestData::generateTestCases(
    'HTML5Lib\Tests\TreeBuilderHarness',
    'HTML5Lib\Tests\TreeBuilderTestOf',
    'tree-construction', '*.dat'
);
