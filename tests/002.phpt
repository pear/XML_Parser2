--TEST--
XML Parser2: parse from file
--SKIPIF--
<?php if (!extension_loaded("xml")) echo 'skip'; ?>
--FILE--
<?php // -*- C++ -*-
//
// Test for: XML/Parser2.php
// Parts tested: - parser creation
//               - some handlers
//               - parse from file
//
require_once "XML/Parser2.php";

class __TestParser2 extends XML_Parser2 {
    function startHandler($xp, $element, $attribs) {
        print "<$element";
        reset($attribs);
        while (list($key, $val) = each($attribs)) {
            $enc = htmlentities($val);
            print " $key=\"$enc\"";
        }
        print ">";
    }
    function endHandler($xp, $element) {
        print "</$element>\n";
    }
    function cdataHandler($xp, $cdata) {
        print "<![CDATA[$cdata]]>";
    }
    function defaultHandler($xp, $cdata) {

    }
}
print "new __TestParser2 ";
var_dump(strtolower(get_class($o = new __TestParser2())));
print "setInputFile ";
print is_resource($o->setInputFile(dirname(__FILE__) . "/test2.xml"))."\n";
print "parse ";
var_dump($o->parse());

?>
--EXPECT--
new __TestParser2 string(13) "__testparser2"
setInputFile 1
parse <ROOT><![CDATA[foo]]></ROOT>
bool(true)
