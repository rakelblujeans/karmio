<?php
	
class CharitySearchTest extends CTestCase
{
    protected function setUp() {
        if (!defined(YII_DEBUG)) {
            define(YII_DEBUG, true);
        }
    }

    public function testSearchEmpty()
    {
        $model = new CharitySearch();
        $output = $model->search('', '', '', 0, '');
        $this->assertContains('Results 1 - 4 of', $output);
	    $this->assertSelectRegExp('li p', '/.*/', 4, $output);
    }

    public function testSearchCategory()
    {
        $model = new CharitySearch();
        $output = $model->search('', '', 'Arts, Culture, Humanities', 0, '');
        $this->assertContains('Results 1 - 4 of', $output);
	    $this->assertSelectRegExp('li p', '/.*/', 4, $output);
    }

    public function testSearchName()
    {
        // should be exactly one result
        $model = new CharitySearch();
        $output1 = $model->search('A Better Chance', '', '', 0, '');
        $output2 = $model->search('A BETTER CHANCE', '', '', 0, '');
        $this->assertEquals($output1, $output2);
        $this->assertContains('A Better Chance', $output1);
	    $this->assertSelectRegExp('li p', '/.*/', 1, $output1);
    }

    public function testSearchState()
    {
        $model = new CharitySearch();
        $output1 = $model->search('', 'nj', '', 0, '');
        $output2 = $model->search('', 'NJ', '', 0, '');
        $this->assertEquals($output1, $output2);
        $this->assertContains('Adler Aphasia Center', $output1);
        $this->assertContains('Results 1 - 4 of', $output1);
	    $this->assertSelectRegExp('li p', '/.*/', 4, $output1);
    }

    public function testSearchPartner()
    {
        $model = new CharitySearch();
        $output = $model->search('', '', '', 0, 'Partner');
	    $this->assertSelectRegExp('li p', '/.*/', 4, $output);
    }

}
?>