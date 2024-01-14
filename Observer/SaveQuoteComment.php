<?php
/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */

namespace SbDevBlog\Checkout\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveQuoteComment implements ObserverInterface
{
    private const QUOTE_COMMENT = "SB Dev Blog Comment";

    /**
     * ADD SAMPLE PRICE
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getEvent()->getData('quote_item')->getQuote();
        $quote->setData("sbdevblog_comment", self::QUOTE_COMMENT);
    }
}
