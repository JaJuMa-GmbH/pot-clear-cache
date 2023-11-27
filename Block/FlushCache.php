<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\PotCacheCleaner\Block;

use Jajuma\PowerToys\Block\PowerToys\QuickAction;

class FlushCache extends QuickAction
{
    const XML_PATH_QUICK_FLUSH_CACHE_ENABLE = 'power_toys/cache_cleaner/is_enable_quick_button';

    public function isEnable(): bool
    {
        if ($this->getData('block_id') == 'flush_cache') {
            return $this->_scopeConfig->isSetFlag(self::XML_PATH_QUICK_FLUSH_CACHE_ENABLE);
        }
        return false;
    }
}
