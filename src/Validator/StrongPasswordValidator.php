<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class StrongPasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\StrongPassword */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$this->isStrong($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function isStrong(mixed $value):bool
    {
        $hasLower = preg_match('/[a-z]/', $value, $matches);
        $hasUpper = preg_match('/[A-Z]/', $value, $matches);
        $hasDigit = preg_match('/[0-9]/', $value, $matches);
        if ($hasLower and $hasUpper and $hasDigit)
        {
            return true;
        }
        return false;
    }
}
