<?php
/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */
namespace SbDevBlog\Checkout\Model\ResourceModel\Order\Grid;

class Collection extends \Magento\Sales\Model\ResourceModel\Order\Grid\Collection
{

    /**
     * Filtering sbdevblog comment
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        $joinTable = $this->getTable('sales_order');
        $this->getSelect()->joinLeft(
            $joinTable,
            'main_table.entity_id = sales_order.entity_id',
            ['sbdevblog_comment']
        );
        parent::_renderFiltersBefore();
    }
}
