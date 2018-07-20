# Custom form element for static_info_tables

This TYPO3 extension adds a custom form element "Country select" to the
TYPO3 form framework. It displays a select list with all countries from the database table
`static_countries` from the extension `static_info_tables` within the frontend.
In addition, a country can be preselected in form editor.

## Installation

Copy the extension folder to `/typo3conf/ext/`, upload it via the extension
manager or add it to your composer.json. Add the static TypoScript configuration
to your TypoScript template. The Extension `static_info_tables` must be installed as well.

## Usage

Open the TYPO3 form editor and create a new form/ open an existing one. Add a
new element to your form. The modal will list the new custom form element
"Country select".

After selecting the "Country select" element, its properties can be edited.

The frontend will render the "Country select" as a select field which contains all country records from the database table `static_countries`.

## State of development

This extension is still in beta phase. Some parts still need some love.
Furthermore, even more properties of `static_info_tables` could be integrated.

## Todo:

* add better icon to form editor
* testing testing testing

## Credits

This TYPO3 extension was created by Ralf Zimmermann (https://www.tritum.de).
