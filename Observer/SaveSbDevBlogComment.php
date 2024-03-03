<?php

namespace SbDevBlog\Checkout\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Psr\Log\LoggerInterface;

class SaveSbDevBlogComment implements ObserverInterface
{
    /**
     * @var CartRepositoryInterface
     */
    private CartRepositoryInterface $cartRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param CartRepositoryInterface $cartRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        LoggerInterface $logger
    ) {
        $this->cartRepository = $cartRepository;
        $this->logger = $logger;
    }

    /**
     * Saving Sb Dev Blog Order Comment
     *
     * @param EventObserver $observer
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        try {
            $order = $observer->getOrder();
            $quote = $this->cartRepository->get($order->getQuoteId());
            $order->setData("sbdevblog_comment", $quote->getData("sbdevblog_comment"));
        } catch (NoSuchEntityException $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
