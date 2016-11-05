=== Plugin Name ===
Contributors: FirstFruitsMedia
Tags: digital bible platform, bible, verses, first fruits media
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: 1.0

The Digital Bible Plarform API plugin easily create dropdowns so you can display and result as per selected drop down values.

== Description ==

The Digital Bible Platform API plugin uses simple short codes to add dependent language, versions, books, chapter dropdowns in your post or page.
The Bible dropdown menus use AJAX requests to auto-populate using the Digital Bible Platform API from https://www.digitalbibleplatform.com.
Note: Here is their website to learn more: https://www.digitalbibleplatform.com/
It requires a valid API - go here to apply for an API Key: https://www.digitalbibleplatform.com/signup/

== Installation ==

1. Download the plugin archive
2. Extract all files from the zip archive
3. Copy the Digital Bible Platform folder to the /wp-content/plugins directory
4. Activate the plugin through the 'Plugins' menu in WordPress
5. Use the shortcodes [dbp-language] [dbp-version] [dbp-books] [dbp-chapters] anywhere in your site to create automatically populated Bible data dropdowns. Note: These 4 shortcodes work in conjunction with each other to create the dropdowns and produce the text / audio output.

== Frequently Asked Questions ==

= Where does this Bible data come from? =

The plugin uses data from the [Digital Bible Platform API](http://www.Digital Bible Platform.com "Digital Bible Platform API")

= What else can I use the Digital Bible Platform API for? =

There are many other things you can do with the Digital Bible Platform API outside of what the plugin enables.
NOTE: This is version 1 - I will add more stuff here once we determine other uses for websites
Visit the [Digital Bible Platform documentation page](http://www.digitalbibleplatform.com/ "Digital Bible Platform Documentation") for more details.


== Changelog ==

= 0.1 =
* Initial release=== Plugin Name ===
Contributors: FirstFruitsMedia
Tags: digital bible platform, bible, verses, first fruits media
Requires at least: 3.6
Tested up to: 3.9
Stable tag: 1.0

The Digital Bible Plarform API plugin easily create dropdowns so you can display and result as per selected drop down values.

== Description ==

The Digital Bible Platform API plugin uses simple short codes to add dependent language, versions, books, chapter dropdowns in your post or page.
The Bible dropdown menus use AJAX requests to auto-populate using the Digital Bible Platform API from https://www.digitalbibleplatform.com.
Note: Here is their website to learn more: https://www.digitalbibleplatform.com/
It requires a valid API - go here to apply for an API Key: https://www.digitalbibleplatform.com/signup/
In order for these shortcodes to work - a valid DBP API key must be saved in the Digital Bible Platform Wordpress Admin Settings Page

== Installation ==

1. Download the plugin archive
2. Extract all files from the zip archive
3. Copy the Digital Bible Platform folder to the /wp-content/plugins directory
4. Activate the plugin through the 'Plugins' menu in WordPress
5. Add you Digital Bible Platform API Key in the settings page.
6. Use the shortcodes [dbp-language] [dbp-version] [dbp-books] [dbp-chapters] anywhere in your site to create automatically populated Bible data dropdowns.

== Frequently Asked Questions ==

= Where does this Bible data come from? =

The plugin uses data from the [Digital Bible Platform API](http://www.Digital Bible Platform.com "Digital Bible Platform API")

= What else can I use the Digital Bible Platform API for? =

There are many other things you can do with the Digital Bible Platform API outside of what the plugin enables.
NOTE: This is version 1 - I will add more stuff here once we determine other uses for websites
Visit the [Digital Bible Platform documentation page](http://www.Digital Bible Platformapi.com/documentation/  "Digital Bible Platform Documentation") for more details.

= Can I style the dropdowns and output different? =

Yes, the plugin includes dbp-scripts.css file that provides the ability to change the look and feel of the dropdown box/sections and output.

= Why is the javascript file that does all of the API call being kept on your website? =

I decided to keep the javascript file that the plugin calls to retrieve all of the data on my website. This will then allow me to update and improve how the interactions work between the javascript
and the DBP API, without you having to update your plugin. So, if something changes in the DBP API (another version) - I can make backward compatible changes that should not break the installed plugin.

= Where can I see the plugin demo in action? =

You can see a demo of the plugin here: http://ministrystaff.org/dbp-bible/

=Do you have sample HTML to paste into my Post or Page that will create the respective dropdowns? =

Yes, here it is:

<div id="PageContent"><h2 id="audioBibleTitle">The Bible Online in Your Language</h2>
<div id="bibleTopBar">
<div style="float: left; margin-right: 10px;"><span style="display: block; font-size: 13px; line-height: 22px;">Choose Language:</span>[dbp-language]</div>
<div style="float: left; margin-right: 10px;"><span style="display: block; font-size: 13px; line-height: 22px;">Version:</span>[dbp-version]</div>
<div style="float: left; margin-right: 10px;"><span style="display: block; font-size: 13px; line-height: 22px;">Books:</span>[dbp-book]</div>
<div id ="chapters" style="float: left; margin-right: 10px;"><span style="display: block; font-size: 13px; line-height: 22px;">Chapters:</span>[dbp-chapter]</div>
</div><!-- /bibleTopBar -->
<div id="verses">
[dbp-audio]
</div>
<div id="verses">[dbp-verses]</div>
</div><!-- /pageContent —>
