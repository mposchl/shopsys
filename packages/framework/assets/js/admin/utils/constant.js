/* eslint-disable */

const constant = {
    '\\FOS\\CKEditorBundle\\Form\\Type\\CKEditorType::class': 'FOS\\CKEditorBundle\\Form\\Type\\CKEditorType',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Advert\\AdvertFormType::VALIDATION_GROUP_TYPE_IMAGE': 'typeImage',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Advert\\AdvertFormType::VALIDATION_GROUP_TYPE_CODE': 'typeCode',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Customer\\BillingAddressFormType::VALIDATION_GROUP_COMPANY_CUSTOMER': 'companyCustomer',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Customer\\DeliveryAddressFormType::VALIDATION_GROUP_DIFFERENT_DELIVERY_ADDRESS': 'differentDeliveryAddress',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Mail\\MailTemplateFormType::VALIDATION_GROUP_SEND_MAIL': 'sendMail',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Order\\OrderItemFormType::VALIDATION_GROUP_NOT_USING_PRICE_CALCULATION': 'notUsingPriceCalculation',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Order\\OrderFormType::VALIDATION_GROUP_DELIVERY_ADDRESS_SAME_AS_BILLING_ADDRESS': 'deliveryAddressSameAsBillingAddress',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\TransportAndPayment\\FreeTransportAndPaymentPriceLimitsFormType::VALIDATION_GROUP_PRICE_LIMIT_ENABLED': 'priceLimitEnabled',
    '\\Shopsys\\FrameworkBundle\\Form\\DatePickerType::FORMAT_JS': 'dd.mm.yy',
    '\\Shopsys\\FrameworkBundle\\Form\\FileUploadType::class': 'Shopsys\\FrameworkBundle\\Form\\FileUploadType',
    '\\Shopsys\\FrameworkBundle\\Form\\ImageUploadType::class': 'Shopsys\\FrameworkBundle\\Form\\ImageUploadType',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Product\\ProductFormType::VALIDATION_GROUP_USING_STOCK': 'usingStock',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Product\\ProductFormType::VALIDATION_GROUP_USING_STOCK_AND_ALTERNATE_AVAILABILITY': 'usingStockAndAlternateAvailability',
    '\\Shopsys\\FrameworkBundle\\Form\\Admin\\Product\\ProductFormType::VALIDATION_GROUP_NOT_USING_STOCK': 'notUsingStock',
    '\\Shopsys\\FrameworkBundle\\Form\\ProductsType::class': 'Shopsys\\FrameworkBundle\\Form\\ProductsType',
    '\\Shopsys\\FrameworkBundle\\Form\\SingleCheckboxChoiceType::class': 'Shopsys\\FrameworkBundle\\Form\\SingleCheckboxChoiceType',
    '\\Shopsys\\FrameworkBundle\\Model\\AdvancedSearch\\AdvancedSearchFilterInterface::OPERATOR_NOT_SET': 'notSet',
    '\\Shopsys\\FrameworkBundle\\Model\\Advert\\Advert::TYPE_IMAGE': 'image',
    '\\Shopsys\\FrameworkBundle\\Model\\Advert\\Advert::TYPE_CODE':'code',
    '\\Shopsys\\FrameworkBundle\\Model\\Order\\OrderData::NEW_ITEM_PREFIX': 'new_',
    '\\Shopsys\\FrameworkBundle\\Model\\Product\\MassAction\\ProductMassActionData::SELECT_TYPE_ALL_RESULTS': 'selectTypeAllResults',
    '\\Shopsys\\FrameworkBundle\\Model\\Product\\MassAction\\ProductMassActionData::SELECT_TYPE_CHECKED': 'selectTypeChecked',
    '\\Shopsys\\FrameworkBundle\\Model\\Product\\Product::OUT_OF_STOCK_ACTION_SET_ALTERNATE_AVAILABILITY': 'setAlternateAvailability',
    '\\Symfony\\Component\\Form\\Extension\\Core\\Type\\CheckboxType::class': 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CheckboxType',
    '\\Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType::class': 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType',
    '\\Symfony\\Component\\Form\\Extension\\Core\\Type\\CollectionType::class': 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CollectionType',
    '\\Symfony\\Component\\Validator\\Constraint::DEFAULT_GROUP': 'Default'
};

export default (key) => constant[key];
