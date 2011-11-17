<?php

namespace KL\UtilBundle\Validator;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InFutureValidator extends ConstraintValidator
{
    /**
     * The service container
     * 
     * @var ContainerInterface
     */
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Indicates whether the constraint is valid
     *
     * @param DateTime   $datetime
     * @param Constraint $constraint
     */
    public function isValid($datetime, Constraint $constraint)
    {
        if (empty($datetime)) {
            // no my duty to check whether it's empty
            return true;
        }
        
        $time = strtotime($datetime);
        if ($time === false) {
            $this->setMessage('请输入正确的时间');
            return false;
        }
        
        $now = time();
        if ($constraint->after == null) {
            if ($time < $now) {
                $this->setMessage($constraint->message);
                return false;
            }
        } else if ($time < $now + $constraint->after) {
            $this->setMessage($constraint->noFarMessage, array('{{ after }}' => $constraint->after / 3600));
            return false;            
        }
        
        return true;
    }
}
