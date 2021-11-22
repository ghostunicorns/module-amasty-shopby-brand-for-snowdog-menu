<?php
/*
 * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\AmastyShopByBrandForSnowdogMenu\Model\NodeType;

use Magento\Framework\Profiler;
use Snowdog\Menu\Model\NodeType\AbstractNode;
use Snowdog\Menu\Model\TemplateResolver;

class Brand extends AbstractNode
{
    /**
     * @var TemplateResolver
     */
    private $templateResolver;

    /**
     * @param Profiler $profiler
     * @param TemplateResolver $templateResolver
     */
    public function __construct(
        Profiler $profiler,
        TemplateResolver $templateResolver
    ) {
        $this->templateResolver = $templateResolver;
        parent::__construct($profiler);
    }

    /**
     * @inheritDoc
     */
    public function fetchConfigData()
    {
        $this->profiler->start(__METHOD__);

        $data = [
            'snowMenuNodeCustomTemplates' => [
                'defaultTemplate' => 'brand',
                'options' => $this->templateResolver->getCustomTemplateOptions('brand'),
                'message' => __('Template not found'),
            ]
        ];

        $this->profiler->stop(__METHOD__);

        return $data;
    }
}
