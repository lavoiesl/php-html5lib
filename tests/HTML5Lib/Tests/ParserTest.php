<?php

namespace HTML5Lib\Tests;
use HTML5Lib\Parser;
use UnitTestCase;

require_once __DIR__ . '/../../autorun.php';

class ParserTest extends UnitTestCase
{
    public function testParse() {
        $result = Parser::parse('<html><body></body></html>');
        $this->assertIsA($result, 'DOMDocument');
    }
    public function testParseFragment() {
        $result = Parser::parseFragment('<b>asdf</b> foo');
        $this->assertIsA($result, 'DOMNodeList');
    }
}
