<?php
/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */

namespace SbDevBlog\Checkout\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use SbDevBlog\Checkout\Services\ValidationConfigurationService;

class SaveQuoteComment implements ObserverInterface
{
    private const QUOTE_COMMENT = "SB Dev Blog Comment";

    /**
     * @var ValidationConfigurationService
     */
    private ValidationConfigurationService $validationConfigurationService;

    /**
     * @param ValidationConfigurationService $validationConfigurationService
     */
    public function __construct(
        ValidationConfigurationService $validationConfigurationService
    ) {
        $this->validationConfigurationService = $validationConfigurationService;
    }

    /**
     * ADD Sb Dev Blog Comment
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getEvent()->getData('quote_item')->getQuote();
        $comment  = $this->validationConfigurationService->getNotice();
        $quote->setData("sbdevblog_comment", $comment ?: self::QUOTE_COMMENT);
    }
}
