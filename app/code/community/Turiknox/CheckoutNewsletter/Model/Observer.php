<?php
/*
 * Turiknox_CheckoutNewsletter
 * @category   Turiknox
 * @package    Turiknox_CheckoutNewsletter
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento-checkout-newsletter/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_CheckoutNewsletter_Model_Observer
{
    /**
     * Subscribe customer email to newsletter if checkbox checked
     *
     * @param $observer
     * @return $this
     */
    public function subscribeCustomerToNewsletter($observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $customerEmail = $quote->getCustomerEmail();

        if (Mage::app()->getRequest()->getParam('is_subscribed')) {
            Mage::getModel('newsletter/subscriber')->subscribe($customerEmail);
        }

        return $this;
    }
}