<?php
/*
 * Turiknox_CheckoutNewsletter
 * @category   Turiknox
 * @package    Turiknox_CheckoutNewsletter
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento-checkout-newsletter/blob/master/LICENSE.md
 * @version    1.0.1
 */
class Turiknox_CheckoutNewsletter_Block_Newsletter extends Mage_Core_Block_Template
{
    /**
     * Check if module has been enabled in the admin
     *
     * @return bool
     */
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag('newsletter/checkout/enable');
    }

    /**
     * Check if the newsletter checkbox should be checked by default
     *
     * @return bool
     */
    public function isCheckboxCheckedByDefault()
    {
        return Mage::getStoreConfigFlag('newsletter/checkout/checked');
    }

    /**
     * Get the newsletter checkbox label text
     *
     * @return string
     */
    public function getCheckboxLabelText()
    {
        return $this->escapeHtml(Mage::getStoreConfig('newsletter/checkout/text'));
    }

     /**
     * Check if email address already known in checkout and if yes then validate against subscription to show/hide the option
     *
     * @return boolean
     */
    public function isAlreadySubscribed()
    {
    $IsSubscribed = false;
    $customer = Mage::getSingleton('customer/session')->getCustomer();
    if ($customer) {
        $customerEmail = $customer->getEmail();
        $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($customerEmail);
        if ($subscriber) {
            $IsSubscribed = $subscriber->isSubscribed();
        }
    }
    return $IsSubscribed;
    }
}
