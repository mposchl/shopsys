import constant from '../../utils/constant';
import Register from 'framework/common/utils/Register';

export default function customerValidator () {

    const $customerDeliveryAddressForm = window.$('#customer_form_deliveryAddressData');
    $customerDeliveryAddressForm.jsFormValidator({
        'groups': function () {

            const groups = [constant('\\Shopsys\\FrameworkBundle\\Form\\ValidationGroup::VALIDATION_GROUP_DEFAULT')];
            if ($customerDeliveryAddressForm.find('#customer_form_deliveryAddressData_addressFilled').is(':checked')) {
                groups.push(constant('\\App\\Form\\Front\\Customer\\DeliveryAddressFormType::VALIDATION_GROUP_DIFFERENT_DELIVERY_ADDRESS'));
            }

            return groups;
        }
    });

    const $customerBillingAddressForm = window.$('#customer_form_billingAddressData');
    $customerBillingAddressForm.jsFormValidator({
        'groups': function () {

            const groups = [constant('\\Shopsys\\FrameworkBundle\\Form\\ValidationGroup::VALIDATION_GROUP_DEFAULT')];
            if ($customerBillingAddressForm.find('#customer_form_billingAddressData_companyCustomer').is(':checked')) {
                groups.push(constant('\\App\\Form\\Front\\Customer\\BillingAddressFormType::VALIDATION_GROUP_COMPANY_CUSTOMER'));
            }

            return groups;
        }
    });
}

(new Register()).registerCallback(customerValidator, 'customerValidator');
