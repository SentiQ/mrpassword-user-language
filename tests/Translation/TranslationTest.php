<?php
/**
 * File for RepositoryManagerTest class
 *
 * @copyright Copyright (c), final gene (http://www.final-gene.de)
 * @author Frak Giesecke <frank.giesecke@final-gene.de>
 */
namespace mrpassword\TranslationTest\Translation;

use PHPUnit_Framework_TestCase;

/**
 * Test for the RepositoryManager class
 *
 * @package Evolver\RepositoryManagerTest
 */
class RepositoryManagerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Data provider for translation tests
	 * Search in all source files for language strings and collect them unique
	 * @return array
	 */
	public function provider()
	{
		$translationList = [];
		foreach (['../../system', '../themes'] as $path) {
			$directory = new \RecursiveDirectoryIterator(
				$path,
				\FilesystemIterator::SKIP_DOTS
			);
			$iterator = new \RecursiveIteratorIterator($directory);
			$regexIterator = new \RegexIterator(
				$iterator,
				'/\.php$/i',
				\RecursiveRegexIterator::MATCH
			);

			/** @var \SplFileInfo $file */
			foreach ($regexIterator as $file) {
				$content = file_get_contents($file->getRealPath());
				if (preg_match_all('/\$language->get\((\'|")(.+?)\1\)/', $content, $matchList)) {
					$translationList = array_unique(array_merge($translationList, $matchList[2]));
				}
			}
		}

		$data = [];
		foreach ($translationList as $text) {
			$data[] = [$text];
		}
		return $data;
	}

	/**
	 * Test if all strings are registered in the language file
	 *
	 * @dataProvider provider
	 * @return void
	 */
	public function testLanguageGerman($text)
	{
		include_once('german.lang.php');
		$language = new \mrpassword\lang();

		$this->assertArrayHasKey($text, $language->get(), 'Missing translation');
	}
}
