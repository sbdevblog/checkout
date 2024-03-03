<?php
/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */

namespace SbDevBlog\Checkout\Services;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ValidationConfigurationService
{
    private const ADDITIONAL_VALIDATION_PATH = "sbcheckout/additional_validation/";
    private const ENABLE_VALIDATION_PATH = "enable";
    private const VALIDATION_REGREX_PATH = "pobox_validation_regex";

    private const SBDEVBLOG_NOTICE = "sbcheckout/notice/notice";

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get Validation Configuration
     *
     * @return bool
     */
    public function getValidationStatus():bool
    {
        return $this->getConfig(self::ENABLE_VALIDATION_PATH);
    }

    /**
     * Get Configuration value
     *
     * @param string $path
     * @return mixed
     */
    private function getConfig(string $path)
    {
        return $this->scopeConfig->getValue(self::ADDITIONAL_VALIDATION_PATH . $path, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get SBDevBlog Notice
     *
     * @return string
     */
    public function getNotice():string
    {
        return (string)$this->scopeConfig->getValue(self::SBDEVBLOG_NOTICE, ScopeInterface::SCOPE_STORE);
    }
}
