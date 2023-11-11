<?php
/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */

namespace SbDevBlog\Checkout\Plugin\Block;

use SbDevBlog\Checkout\Services\ValidationConfigurationService;

class LayoutProcessor
{
    /**
     * @var ValidationConfigurationService
     */
    private ValidationConfigurationService $validationConfigurationService;

    /**
     * Constructor
     *
     * @param ValidationConfigurationService $validationConfigurationService
     */
    public function __construct(
        ValidationConfigurationService $validationConfigurationService
    ) {
        $this->validationConfigurationService = $validationConfigurationService;
    }

    /**
     * Add POBOX Validation to street address on street address
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array                                            $jsLayout
    ) {
        if ($this->validationConfigurationService->getValidationStatus()) {
            // PoBox Validation on street for shipping address
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']
            ['children']['street']['children'][0]['validation']['pobox-validation'] = true;
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']
            ['children']['street']['children'][1]['validation']['pobox-validation'] = true;

            // PoBox Validation on street for billing address
            if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'])) {

                foreach ($jsLayout['components']['checkout']['children']
                         ['steps']['children']['billing-step']['children']
                         ['payment']['children']['payments-list']['children'] as $key => $payment) {

                    if (isset($payment['children']['form-fields']['children']['street'])) {

                        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                        ['payment']['children']['payments-list']['children']
                        [$key]['children']['form-fields']['children']
                        ['street']["children"][1]['validation']['pobox-validation'] = true;
                        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                        ['payment']['children']['payments-list']
                        ['children'][$key]['children']['form-fields']['children']
                        ['street']["children"][0]['validation']['pobox-validation'] = true;
                    }
                }
            }
        }
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']
        ['children']['street']['sortOrder'] = 5;
        return $jsLayout;
    }
}
