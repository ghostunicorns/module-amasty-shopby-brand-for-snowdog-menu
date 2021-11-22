<?php
/*
 * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\AmastyShopByBrandForSnowdogMenu\Block\NodeType;

use Magento\Framework\Phrase;
use Snowdog\Menu\Model\TemplateResolver;
use Magento\Framework\View\Element\Template\Context;
use GhostUnicorns\AmastyShopByBrandForSnowdogMenu\Model\NodeType\Brand as BrandModel;
use Snowdog\Menu\Block\NodeType\AbstractNode;

class Brand extends AbstractNode
{
    /**
     * @var string
     */
    protected $defaultTemplate = 'GhostUnicorns_AmastyShopByBrandForSnowdogMenu::menu/node_type/brand.phtml';

    /**
     * @var string
     */
    protected $customTemplateFolder = 'menu/custom/brand/';

    /**
     * @var string
     */
    protected $nodeType = 'brand';

    /**
     * @var array
     */
    protected $nodes;

    /**
     * @var BrandModel
     */
    private $brandModel;

    /**
     * @var \Amasty\ShopbyBrand\Block\BrandsPopup
     */
    protected $brandsPopup;

    /**
     * @param Context $context
     * @param BrandModel $brandModel
     * @param TemplateResolver $templateResolver
     * @param \Amasty\ShopbyBrand\Block\BrandsPopup $brandsPopup
     * @param array $data
     */
    public function __construct(
        Context $context,
        BrandModel $brandModel,
        TemplateResolver $templateResolver,
        \Amasty\ShopbyBrand\Block\BrandsPopup $brandsPopup,
        $data = []
    ) {
        $this->brandModel = $brandModel;
        $this->brandsPopup = $brandsPopup;
        parent::__construct($context, $templateResolver, $data);
    }

    /**
     * @inheritDoc
     */
    public function getJsonConfig()
    {
        return $this->brandModel->fetchConfigData();
    }

    /**
     * @param array $nodes
     */
    public function fetchData(array $nodes)
    {
        $this->nodes = $this->brandModel->fetchData(
            $nodes,
            $this->_storeManager->getStore()->getId()
        );
    }

    /**
     * @param int $nodeId
     * @param int $level
     *
     * @return string
     */
    public function getHtml($nodeId, $level)
    {
        $classes = $level == 0 ? 'level-top' : '';
        $node = $this->nodes[$nodeId];
        $nodeClass = $node->getClasses();

        return <<<HTML
<div class="$classes $nodeClass" role="menuitem"></div>
HTML;
    }

    /**
     * @return Phrase
     */
    public function getLabel()
    {
        return __("Brand");
    }

    /**
     * @return string
     */
    public function getBrandMenu(): string
    {
        return $this->brandsPopup->toHtml();
    }
}
