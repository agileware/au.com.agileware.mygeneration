# My Generation

Calculates the Generation (Gen Y, Gen Z etc.) for Contacts in CiviCRM based in their Birth Date.

Generations are defined as being:
* Builder >= 1945
* Boomer 1946 - 1962
* Gen X 1963 - 1980
* Gen Y 1981 - 1999
* Gen Z 2000 - ?

This extension does not create a CiviCRM Custom Field or Option Values, you need to do this as part of the installation.

[![The Who - My Generation](http://img.youtube.com/vi/qN5zw04WxCc/0.jpg)](https://www.youtube.com/watch?v=qN5zw04WxCc "The Who - My Generation")

# Installation

1. Install and enable this CiviCRM extension.
2. Create a **CiviCRM Custom Field**, alphanumeric field as select field type. This will store the Generation value. Define the **Option Values** for the Generations.
3. Go to the **My Generation Settings** page, `civicrm/admin/setting/mygeneration` 
4. Enter the **ID** of the **Generation, Custom Field** on the My Generation Settings Page 
5. Enter the **Option Value** for **each Generation option** on the My Generation Settings Page
6. Save the settings
7. Enable the Scheduled Job, `Calculate Generation for Contacts`

# About the Authors

This CiviCRM extension was developed by the team at [Agileware](https://agileware.com.au).

[Agileware](https://agileware.com.au) provide a range of CiviCRM services including:

* CiviCRM migration
* CiviCRM integration
* CiviCRM extension development
* CiviCRM support
* CiviCRM hosting
* CiviCRM remote training services

Support your Australian [CiviCRM](https://civicrm.org) developers, [contact Agileware](https://agileware.com.au/contact) today!

![Agileware](images/agileware-logo.png)