<?php

namespace SciPhp\LinAlg;

use SciPhp\Exception\Message;
use SciPhp\NdArray;
use SciPhp\NumPhp as np;
use Webmozart\Assert\Assert;

/**
 * Choleski decomposition
 */
trait CholeskyTrait
{
    /**
     * Decomposition of a Hermitian, positive-definite matrix into the
     * product of a lower triangular matrix
     *
     * @param  \SciPhp\NdArray|array $matrix
     *
     * @link http://sciphp.org/linalg.cholesky
     * Documentation for cholesky()
     *
     * @since 0.3.0
     * @api
     */
    final public function cholesky($matrix): NdArray
    {
        np::transform($matrix, true);

        $shape = $matrix->shape;

        Assert::true(
            $matrix->is_square(),
            sprintf(
                Message::MAT_NOT_SQUARE,
                trim(np::ar($shape))
            )
        );

        $size = $shape[0];
        $w =  $matrix->copy();

        $l = np::zeros($shape);

        for ($a = 0; $a < $size; $a++) {

            Assert::greaterThan(
                $w[$a][$a],
                0,
                "Not a positive-definite matrix"
            );

            $l["$a, $a"] = sqrt($w[$a][$a]);

            for ($b = $a + 1; $b < $size; $b++) {
                Assert::eq(
                    $matrix["$b, $a"],
                    $matrix["$a, $b"],
                    "Not a symetric matrix"
                );

                $l["$b, $a"] = $w["$b, $a"] / $l["$a, $a"];

                for ($c = $a + 1; $c <= $b; $c++) {
                    $w["$b, $c"] = $w["$b, $c"]
                                 - $l["$b, $a"]
                                 * $l["$c, $a"];
                }
            }

        }

        return $l;
    }
}
