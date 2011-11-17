<?php

namespace KL\UtilBundle\Twig\Extension;

use Symfony\Component\Translation\TranslatorInterface;

class KLTranslationExtension extends \Twig_Extension
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'transIn' => new \Twig_Filter_Method($this, 'transIn'),
        );
    }

    public function transIn($message, $context = null, array $arguments = array(), $domain = "messages", $locale = null)
    {
        if (!empty($context)) {
            $message = $context . '.' . $message;
        }
        return $this->translator->trans($message, $arguments, $domain, $locale);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'kl_translator';
    }
}
