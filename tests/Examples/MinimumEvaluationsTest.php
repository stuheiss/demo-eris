<?php
use Eris\Generator;

class MinimumEvaluationsTest extends PHPUnit\Framework\TestCase
{
    use Eris\TestTrait;

    public function testFailsBecauseOfTheLowEvaluationRatio()
    {
        $this
            ->forAll(
                Generator\choose(0, 100)
            )
            ->when(function ($n) {
                return $n > 90;
            })
            ->then(function ($number) {
                $this->assertTrue($number * 2 > 90 * 2);
            });
    }

    public function testPassesBecauseOfTheArtificiallyLowMinimumEvaluationRatio()
    {
        $this
            ->minimumEvaluationRatio(0.01)
            ->forAll(
                Generator\choose(0, 100)
            )
            ->when(function ($n) {
                return $n > 90;
            })
            ->then(function ($number) {
                $this->assertTrue($number * 2 > 90 * 2);
            });
    }

    /**
     * @eris-ratio 1
     */
    public function testPassesBecauseOfTheArtificiallyLowMinimumEvaluationRatioFromAnnotation()
    {
        $this
            ->forAll(
                Generator\choose(0, 100)
            )
            ->when(function ($n) {
                return $n > 90;
            })
            ->then(function ($number) {
                $this->assertTrue($number * 2 > 90 * 2);
            });
    }
}
