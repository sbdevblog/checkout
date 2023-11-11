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
    ) {
        $this->validationConfigurationService = $validationConfigurationService;
    }

    /**
     * @inheritDoc
     */
    public function getConfig()
    {
        return [
            "pobox_validation_enabled" => $this->validationConfigurationService->getValidationStatus()
        ];
    }
}
