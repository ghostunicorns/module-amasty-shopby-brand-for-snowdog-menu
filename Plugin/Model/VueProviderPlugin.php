<?php
/*
 * Copyright © Ghost Unicorns snc. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\AmastyShopByBrandForSnowdogMenu\Plugin\Model;

use Snowdog\Menu\Model\VueProvider;

class VueProviderPlugin
{
    /**
     * @param VueProvider $subject
     * @param $result
     * @return mixed
     */
    public function afterGetComponents(VueProvider $subject, $result)
    {
        foreach ($result as &$data) {
            if (strpos($data, 'brand') > -1) {
                $data = str_replace('Snowdog_Menu', 'GhostUnicorns_AmastyShopByBrandForSnowdogMenu', $data);
            }
        }
        return $result;
    }
}
