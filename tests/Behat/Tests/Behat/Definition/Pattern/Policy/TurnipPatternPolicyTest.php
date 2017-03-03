<?php

namespace Behat\Tests\Definition\Pattern\Policy;

use Behat\Behat\Definition\Pattern\Policy\TurnipPatternPolicy;

class TurnipPatternPolicyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider generatePatternProvider
     *
     * @param string $incomingStepText
     * @param string $expectedPattern
     * @param string $expectedCanonicalText
     */
    public function testGeneratePattern($incomingStepText, $expectedPattern, $expectedCanonicalText)
    {
        $turnipPatternPolicy = new TurnipPatternPolicy();

        $pattern = $turnipPatternPolicy->generatePattern($incomingStepText);

        $this->assertEquals($expectedPattern, $pattern->getPattern());
        $this->assertEquals($expectedCanonicalText, $pattern->getCanonicalText());
    }

    public function generatePatternProvider()
    {
        return [
            [
                'I have magically created 10$',
                'I have magically created :arg1$',
                'IHaveMagicallyCreated',
            ],
            [
                'do something undefined with \1',
                'do something undefined with \:arg1',
                'DoSomethingUndefinedWith',
            ],
            [
                'I should get a simple string:',
                'I should get a simple string:',
                'IShouldGetASimpleString',
            ],
            [
                'I have a package v2.5',
                'I have a package v2.5',
                'IHaveAPackageV',
            ],
            // Slashes...
            [
                'images should be uploaded to web/uploads/media/default/0001/01/',
                'images should be uploaded to web\/uploads\/media\/default\/:arg1\/:arg2\/',
                'ImagesShouldBeUploadedToWebUploadsMediaDefault',
            ],
            // Single quotes...
            [
                'I have chose \'coffee with turkey\' in coffee machine',
                'I have chose :arg1 in coffee machine',
                'IHaveChoseInCoffeeMachine',
            ],
            [
                'I should have \'turkey with coffee sauce\'',
                'I should have :arg1',
                'IShouldHave',
            ],
            [
                'I should get a \'super/string\':',
                'I should get a :arg1:',
                'IShouldGetA',
            ],
            // Double quotes...
            [
                'I have chose "pizza tea" in coffee machine',
                'I have chose :arg1 in coffee machine',
                'IHaveChoseInCoffeeMachine',
            ],
            [
                'I should have "pizza tea"',
                'I should have :arg1',
                'IShouldHave',
            ],
            [
                'I should get a "super/string":',
                'I should get a :arg1:',
                'IShouldGetA',
            ],
            // Apostrophes...
            [
                'that it\'s eleven o\'clock',
                'that it\'s eleven o\'clock',
                'ThatItsElevenOClock',
            ],
            [
                'the guest\'s taxi has arrived',
                'the guest\'s taxi has arrived',
                'TheGuestsTaxiHasArrived',
            ],
        ];
    }
}
