<?php

class AllTests
{

  /**
   * Prepare the test runner.
   *
   * @return void
   */
  public static function main()
  {
    PHPUnit_TextUI_TestRunner::run(self::suite());
  }
  
  /**
   * Add all Moodle Package test suites into a single test suite.
   *
   * @return PHPUnit_Framework_TestSuite
   */
  public static function suite()
  {
    $suite = new PHPUnit_Framework_TestSuite("Moodle Package");
    
    $suite->addTestSuite(
      self::_createSuite(
        "Automation", "vendor/covex-nn/moodle-automation/tests"
      )
    );
    
    $suite->addTestSuite(
      self::_createSuite(
        "Package", "tests"
      )
    );
    
    $suite->addTestSuite(
      self::_createSuite(
        "Modules", "src/*/*/tests"
      )
    );
    
    return $suite;
  }
  
  /**
   * Create test suite
   * 
   * @param  string       $name     Suite name
   * @param  array|string $paths    Paths
   * @param  array|string $suffixes Suffixes
   * @param  array|string $prefixes Prefixes
   * @param  array        $exclude  Exclude
   * 
   * @return AppendIterator
   */
  protected static function _createSuite($name, $paths, $suffixes = '_test.php', $prefixes = '', $exclude = array())
  {
    $factory = new File_Iterator_Factory();
    $iterator = $factory->getFileIterator(
      $paths, $suffixes, $prefixes, $exclude
    );
    
    $suite = new PHPUnit_Framework_TestSuite($name);
    $suite->addTestFiles($iterator);
    
    return $suite;
  }

}
