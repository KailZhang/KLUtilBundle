<?php

namespace KL\UtilBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class InFuture extends Constraint
{
    public $after;
    public $message = '请设定一个未来时间';
    public $noFarMessage = '时间需设定为距现在{{ after }}小时后';
    
    public function validatedBy()
    {
        return 'kl.validator.infuture';
    }
}
