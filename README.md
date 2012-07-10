# HTML5Lib - PHP flavour

This is an implementation of the tokenization and tree-building parts
of the HTML5 specification in PHP.  Potential uses of this library
can be found in web-scrapers and HTML filters.

Warning: This is a pre-alpha release, and as such, certain parts of
this code are not up-to-snuff (e.g. error reporting and performance).
However, the code is very close to spec and passes 100% of tests
not related to parse errors.  Nevertheless, expect to have to update
your code on the next upgrade.


## Usage notes

```php
<?php
use HTML5Lib\Parser;
$dom = Parser::parse('<html><body>...');
$nodelist = Parser::parseFragment('<b>Boo</b><br>');
$nodelist = Parser::parseFragment('<td>Bar</td>', 'table');
?>
```

## Documentation
```
Parser::parse($text)
    $text  : HTML to parse
    return : DOMDocument of parsed document

Parser::parseFragment($text, $context)
    $text    : HTML to parse
    $context : String name of context element
    return   : DOMDocument of parsed document
```

## Developer notes

  * To setup unit tests, you need to add a small stub file test-settings.php
    that contains $simpletest_location = 'path/to/simpletest/'; This needs to
    be version 1.1 (or, until that is released, SVN trunk) of SimpleTest.

  * We don't want to ultimately use PHP's DOM because it is not tolerant
    of certain types of errors that HTML 5 allows (for example, an element
    "foo@bar"). But the current implementation uses it, since it's easy.
    Eventually, this html5lib implementation will get a version of SimpleTree;
    and may possibly start using that by default.

  * The original implementation of this performed line and column tracking
    in place.  However, it was found that this approximately doubled the
    runtime of tokenization, so we decided to take a more optimistic approach:
    only calculate line/column numbers when explicitly asked to.  This
    is slower if we attempt to calculate line/column numbers for everything
    in the document, but if there is a small enough number of errors it
    is a great improvement.
