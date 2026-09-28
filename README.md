# My Generation (au.com.agileware.mygeneration)

This is a [CiviCRM](https://civicrm.org) extension which calculates the generational cohort (Builder,
Boomer, Gen X, Gen Y, Gen Z) for Contacts based on their Birth Date, and stores the result in a
CiviCRM Custom Field. This saves you from having to manually classify or periodically re-classify
Contacts by generation for segmentation, reporting, or targeted communications.

Generations are defined as being:
* Builder - born before 1946
* Boomer - 1946 to 1962
* Gen X - 1963 to 1980
* Gen Y - 1981 to 1999
* Gen Z - 2000 onwards

[![The Who - My Generation](http://img.youtube.com/vi/qN5zw04WxCc/0.jpg)](https://www.youtube.com/watch?v=qN5zw04WxCc "The Who - My Generation")

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Usage

This extension does not create the Custom Field or its Option Values for you, nor does it calculate
Generations automatically on save, it works entirely through a Scheduled Job that you configure and
enable:

* A **My Generation Settings** admin page is added at `civicrm/admin/setting/mygeneration`
  (also linked from **Administer > My Generation**), where you specify which Custom Field stores the
  Generation and which Option Value corresponds to each generation.
* A **Scheduled Job**, `Calculate Generation for Contacts`, is provided (API `Mygeneration.Calculatemygeneration`).
  When enabled and run, it scans all non-deleted Contacts' Birth Dates and updates the configured
  Custom Field with the matching Generation Option Value for every Contact, in bulk, via direct SQL.
  This is disabled by default and must be enabled and scheduled (e.g. Daily) as required.

Because this runs as a batch job rather than on individual Contact save, re-run the Scheduled Job (or
wait for its next scheduled run) after Birth Dates change or new Contacts are added, to keep the
Generation field up to date.

## Special configuration requirements

Before the extension will function, you must complete the following one-time setup:

1. Create a **CiviCRM Custom Field** (alphanumeric field, with **Select** as the HTML field type) to
   store the Generation value, and define an **Option Value** for each of the five generations.
2. Go to **Administer > My Generation** (`civicrm/admin/setting/mygeneration`) and enter:
   * The **ID** of the Generation Custom Field.
   * The **Option Value** for each of the Builder, Boomer, Gen X, Gen Y, and Gen Z generations.
3. Save the settings.
4. Enable the Scheduled Job **Calculate Generation for Contacts** (Administer > System Settings >
   Scheduled Jobs), and set its run frequency as required (defaults to Daily).

No API keys, external credentials, or dependent extensions are required. Access to the settings page
and Scheduled Job requires the **administer CiviCRM** permission.

## Requirements

* CiviCRM 5.51+

Note: no minimum PHP version is declared in `info.xml`.

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin
Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

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
