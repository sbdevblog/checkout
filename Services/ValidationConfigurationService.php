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
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get Validation Configuration
     *
     * @return array
     */
    public function getValidationConfig(): array
    {
        return [
            "validation_enable" => $this->getConfig(self::ENABLE_VALIDATION_PATH),
            "validation_regrex" => $this->getConfig(self::VALIDATION_REGREX_PATH)
        ];
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
}
