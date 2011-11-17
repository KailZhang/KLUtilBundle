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
        );
    }
    
    public function getArrayFirstElement($obj, $context = null, array $arguments = array(), $domain = "messages", $locale = null)
    {
        if (is_array($obj) && !empty($obj)) {
            return $obj[0];
        }
        return $obj;
    }

    public function getArrayLastElement($obj, $context = null, array $arguments = array(), $domain = "messages", $locale = null)
    {
        if (is_array($obj) && !empty($obj)) {
            return $obj[count($obj) - 1];
        }
        return $obj;
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
