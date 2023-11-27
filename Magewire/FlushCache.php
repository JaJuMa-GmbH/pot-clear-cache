<?php declare(strict_types=1);
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\PotCacheCleaner\Magewire;

use Magento\Framework\App\Cache\Frontend\Pool;
use Magento\Framework\App\Cache\TypeListInterface;
use Magewirephp\Magewire\Component;

class FlushCache extends Component
{
    private $_cacheFrontendPool;

    private $_cacheTypeList;

    public function __construct(
        Pool $cacheFrontendPool,
        TypeListInterface $cacheTypeList,
        array $data = []
    ) {
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_cacheTypeList = $cacheTypeList;
    }

    public function getCacheStatus(){
        return count($this->_cacheTypeList->getInvalidated()) > 0 ? 'invalidate' : '';
    }

    public function cacheClear()
    {
        /* get all types of cache in system */
        $allTypes = array_keys($this->_cacheTypeList->getTypes());

        /* Clean cached data for specific cache type */
        foreach ($allTypes as $type) {
            $this->_cacheTypeList->cleanType($type);
        }

        /* flushed the Entire cache storage from system, Works like Flush Cache Storage button click on System -> Cache Management */
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }

    public function cachePageClear()
    {
        $this->_cacheTypeList->cleanType('full_page');
    }
}
