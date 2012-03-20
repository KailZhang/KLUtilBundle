<?php

namespace KL\UtilBundle\Twig\Extension;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * KLImageExtension
 * 
 * Relies on LiipImagineBundle, or at least its configuration
 * 
 * @author kail
 */
class KLImageExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'heightenWidth'  => new \Twig_Filter_Method($this, 'getImageHeightenWidth'),
            'widenHeight' => new \Twig_Filter_Method($this, 'getImageWidenHeight'),
        );
    }
    
    /**
     * Get widen or heighten of LiipImagineBundle filter configuration
     * 
     * @param string $filter - LiipImagineBundle filter, defined in configuration
     * @param string $which - widen|heighten
     */
    private function getSiden($filter, $which)
    {
        if (!in_array($which, array('widen', 'heighten'))) {
            return 0;
        }
        $filterSets = $this->container->getParameter('liip_imagine.filter_sets');
        if (empty($filterSets) || !isset($filterSets[$filter])) {
            return 0;
        }
        $filters = $filterSets[$filter]['filters'];
        if (!isset($filters['relative_resize']) || !isset($filters['relative_resize'][$which])) {
            return 0;
        }
        
        return $filters['relative_resize'][$which];
    }
    
    /**
     * 
     * @param string $obj - image file path, relative to web root 
     * @param string $filter
     * @param string $domain
     * @param string $locale
     * @return integer
     */
    public function getImageHeightenWidth($obj, $filter, $domain = "messages", $locale = null)
    {
        $webRoot = $this->container->getParameter('liip_imagine.web_root');
        $webRoot = rtrim($webRoot, '/');
        $imgPath = $webRoot . '/' . ltrim($obj, '/');
        
        $heighten = $this->getSiden($filter, 'heighten');
        list($width, $height) = getimagesize($imgPath);
        return round($width*$heighten/$height);
    }

    /**
     * 
     * @param string $obj - image file path, relative to web root 
     * @param string $filter
     * @param string $domain
     * @param string $locale
     * @return integer
     */
    public function getImageWidenHeight($obj, $filter, $domain = "messages", $locale = null)
    {
        $webRoot = $this->container->getParameter('liip_imagine.web_root');
        $webRoot = rtrim($webRoot, '/');
        $imgPath = $webRoot . '/' . ltrim($obj, '/');
        
        $widen = $this->getSiden($filter, 'widen');
        list($width, $height) = getimagesize($imgPath);
        return round($height*$widen/$width);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'kl_image';
    }
}
