<?php
/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */

namespace SbDevBlog\Checkout\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use SbDevBlog\Checkout\Services\ValidationConfigurationService;

class AdditionalValidationConfig implements ConfigProviderInterface
{
    /**
     * @var ValidationConfigurationService
     */
    private ValidationConfigurationService $validationConfigurationService;

    /**
     * @param ValidationConfigurationService $validationConfigurationService
     */
    public function __construct(
        ValidationConfigurationService $validationConfigurationService
    )
    {
        $this->validationConfigurationService = $validationConfigurationService;
    }

    /**
     * @inheritDoc
     */
    public function getConfig()
    {
        $validationConfiguration = $this->validationConfigurationService->getValidationConfig();
        $validationConfig = [
            "pobox_validation_enabled" => $validationConfiguration["validation_enable"],
            "pobox_validation_regrex" => $validationConfiguration["validation_regrex"]
        ];

        return $validationConfig;
    }
}
