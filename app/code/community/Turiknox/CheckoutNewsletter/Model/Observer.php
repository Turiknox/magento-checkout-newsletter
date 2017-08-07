<?php
/*
 * Turiknox_CheckoutNewsletter
 * @category   Turiknox
 * @package    Turiknox_CheckoutNewsletter
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento-checkout-newsletter/blob/master/LICENSE.md
 * @version    1.0.1
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
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $customerEmail = $quote->getCustomerEmail();
        if (!$customerEmail) {
            $customerEmail = $quote->getBillingAddress()->getEmail();
        }

        $subscriberModel = Mage::getModel('newsletter/subscriber');
        $subscriber = $subscriberModel->loadByEmail($customerEmail);
        if (!$subscriber->getId()) {
            if (Mage::app()->getRequest()->getParam('is_subscribed')) {
                $subscriberModel->subscribe($customerEmail);
            }
        }

        return $this;
    }
}