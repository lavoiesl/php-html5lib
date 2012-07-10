<?php

namespace HTML5Lib\Tests;
use SimpleTest;

SimpleTest::ignore('HTML5Lib\Tests\TestDataHarness');
abstract class TestDataHarness extends DataHarness
{
    protected $data;
    public function __construct() {
        parent::__construct();
        $this->data = new TestData($this->filename);
    }
    public function getDescription($test) {
        return $test['data'];
    }
    public function getDataTests() {
        return $this->data->tests;
    }
}
