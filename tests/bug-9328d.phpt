--TEST--
XML Parser2:  test for Bug #9328 "assigned by reference error in XML_RSS parse"
--SKIPIF--
<?php
if (version_compare(PHP_VERSION, '5.2.10', 'lt')) {
    print 'skip - test only applies to PHP5.2.10 and higher';
}
if (!extension_loaded('xml')) {
    print 'skip - xml extension not available';
}
/*
 * can't test if XML_RSS is not installed
 */
$originalErrorReporting = error_reporting();
error_reporting(E_ALL & ~E_WARNING);
if (false == (include_once 'XML/RSS.php')) {
    print('skip - XML_RSS is not installed');
}
error_reporting($originalErrorReporting);
?>
--FILE--
<?php
/*
 * this issue only exists in PHP4
 */

require_once 'XML/RSS.php';

$url = 'www.someverybogusurl.thisisnotatld';
$rss =& new XML_RSS($url);

$error = $rss->parse();
echo $error->getMessage() . PHP_EOL;
?>
--EXPECT--
XML_Parser2: Not well-formed (invalid token) at XML input line 1:1
