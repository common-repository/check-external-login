=== Check External Login ===
Contributors: vigicorp
Requires at least: 5.0
Tested up to: 6.1.1
Requires PHP: 7.4
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allow to check if user is logged in another website with JSONP

== Description ==
Allow to check if user is logged in another website with JSONP.

You can edit url to call in admin settings page.

Plugin add automatically all javascript needed to check if user is connected on the defined url.

Url must return a JSON like this :
`
{
   "connected":false,
   "link":
   {
      "linkName": "myLink"
   },
   "text":
   {
      "textName": "myText"
   },
}
`

Plugins will automatically do following actions on element depending on their html class :
- class `js-cel-not-connected` : will be hide if `connected` is true
- class `js-cel-connected` : will be hide if `connected` is false
- class `js-cel-text-[textName]` : element content will be replace with text in JSON
- class `js-cel-link-[linkName]` : element href will be replace with link in JSON

== Installation ==
1. Upload plugin folder to the "/wp-content/plugins/" directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Update url in plugin settings page

== Changelog ==
= 1.0 =
* Initial release.
