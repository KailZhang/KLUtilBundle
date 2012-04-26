<?php

namespace KL\UtilBundle\Twig\Extension;

use Symfony\Component\Translation\TranslatorInterface;

class KLGeneralExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'first' => new \Twig_Filter_Method($this, 'getArrayFirstElement'),
            'last' => new \Twig_Filter_Method($this, 'getArrayLastElement'),
            'startsWith' => new \Twig_Filter_Method($this, 'stringStartsWith'),
            'endsWith' => new \Twig_Filter_Method($this, 'stringEndsWith'),
        );
    }
    
    public function getArrayFirstElement($obj, $domain = "messages", $locale = null)
    {
        if (is_array($obj) && !empty($obj)) {
            return $obj[0];
        }
        return $obj;
    }

    public function getArrayLastElement($obj, $domain = "messages", $locale = null)
    {
        if (is_array($obj) && !empty($obj)) {
            return $obj[count($obj) - 1];
        }
        return $obj;
    }
    
    public function stringStartsWith($str, $prefix)
    {
        return strpos($str, $prefix) === 0;
    }
    
    public function stringEndsWith($str, $suffix)
    {
        $expectedPos = strlen(str) - strlen($suffix);
        return strpos($str, $suffix) === $expectedPos;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'kl_general';
    }
}
