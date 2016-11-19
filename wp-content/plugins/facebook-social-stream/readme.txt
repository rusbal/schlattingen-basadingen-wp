=== Facebook Social Stream ===
Contributors: Daniele Angileri
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WLXKFHGZ9WWGN
Tags: facebook, facebook stream, facebook feed, facebook page, facebook wall, facebook posts, custom facebook feed, custom facebook stream, custom facebook wall, custom facebook posts, social media, social stream, responsive, mobile
Requires at least: 3.0.1
Tested up to: 4.5.2
Stable tag: 1.6.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Facebook Social Stream plugin allows you to display a custom Facebook feed of a public Facebook page, groups, posts, events, photos and videos on your website

== Description ==

The [Facebook Social Stream](http://angileri.de/blog/en/free-wordpress-plugin-facebook-social-stream/) plugin generates a **responsive**, **SEO optimized** and **cached Facebook feed** for your website.
**You do not even need a Facebook API key!** 

Just configure the Facebook page name and add the shortcode `[fb_social_stream]` to your page. That's it.

Have a look at my **[example](http://angileri.de/blog/en/free-wordpress-plugin-facebook-social-stream/)** page for a live demo.


= Info =
This plugin was officially released at July 17th 2015 and will be ongoing improved by new features.
If you have found some bugs or if you have feature requests, please check out the [support forum](https://wordpress.org/support/plugin/facebook-social-stream)

It would be nice to contact me if you have troubles before you leave a bad rating. Thanks :)


= Support =
I am working as a professional Freelance Web Developer and I'm developing this plugin in my free time.
Please keep in mind that I am not able to provide support for every single WordPress instance with different themes, plugins and server environment.

I keep my [blog](http://angileri.de/blog/en/free-wordpress-plugin-facebook-social-stream/) updated with the newest plugin and WordPress version.
If it is up and running there without any errors please check your configuration and log-files for further information.


= Philosophy =
* KISS principle (keep it simple, stupid)
* Easiest possible configuration


= Features =
* Easy to add via **shortcode** `[fb_social_stream]`
* **Customizable** appearance without CSS knowledge
* **Responsive** behaviour
* **Crawlable** by search engine bots
* Fast delivery by **caching**
* HTML-links of Hashtags
* HTML-links of message URLs
* Modern **HTML5 video** delivery
* Display **YouTube** videos as video-box
* Promote your **Facebook events** on your website
* Choose from different **themes** to change the **style** of your Facebook stream

= Advanced Settings =
* get Facebook stream as **JSON-object** instead of HTML
* **disable CSS** in case you want to use your own stylesheet
* **disable JS** in case you want to use your own javascript

= Powerful Extensions =
* show **Facebook comments** within your stream
* add **paging functionality** to your social stream


== Installation ==

1. Upload plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the Facebook Social Stream plugin via the Settings page
4. Use the shortcode `[fb_social_stream]` to display the feed

== Frequently Asked Questions ==
= What kind of Facebook posts can be displayed as stream? =
The Facebook page has to be publicly accessible and without any restrictions like age verifications.
It is not possible to retrieve the information of your personal profile or any private
Facebook group.

= How do I find the page-name of my Facebook page? =
The page name of your Facebook page can be identified by the last part of the URL.
If your URL looks like this `https://www.facebook.com/angileri.de` then `angileri.de` is the name of your Facebook page.

= How does the update of the stream works? =
You can configure the update interval in the plugin settings. 
Once someone browses your site with a social stream, the plugin checks if the update interval is reached. This happens via ajax in background to prevent page-load issues.
If it is time to update, the plugin retrieves new Facebook data, stores it into the database and even updates the current HTML for the user immediately!

= What is a Facebook Access Token? =
In order to read Facebook data via the Facebook Graph API you need to authenticate yourself. This is done with a Facebook Access Token.

= Do I need a Facebook Access Token? =
**No**. If you don't have an Access Token the Facebook Social Stream plugin uses a fallback service to retrieve the data.

= Can I change the appearance of the stream? =
**Yes**. You can simply change the style of your stream within the plugin-settings. A color-picker supports you to find the right color hue easily.

= Does the stream also deliver Facebook videos? =
**Yes**. Facebook videos are delivered as modern HTML5 videos.
I did not use Flash on purpose. Many mobile phones do not support it and it will die anyway on the long run. 


== Screenshots ==
1. Plugin configuration "Settings"
2. Plugin configuration "Styling"
3. Plugin configuration "Advanced"
4. Plugin configuration "Extensions"
5. Example Social Stream ("default" theme)
6. Example Social Stream ("fbss_simple" theme)

== Changelog ==
= 1.6.2 =
* Enhancements
	* Changed URL of Facebook service in order to use load balancing
	* Added Spanish translations (thx Pablo)
	
= 1.6.1 =
* Features
	* Possibility to add custom inline CSS in advanced options
* Enhancements
	* Added validation rules to identify Facebook page ID
	* Added validation rules to "Update interval" and "Max messages" options
	* Added shortcode description
* Bugfix
	* Added check to prevent PHP notice message

= 1.6.0 =
* Features
	* Introduced template engine for different Facebook stream style selection
	* Added "fbss_simple" theme
* Enhancements
	* Using SASS to combine and minify CSS resources in order to increase web-performance

= 1.5.4 =
* Features
	* Added Facebook events to social stream (thx Luca for the hint)
	* Added CSS options to customize style the new event-box
	* Added CSS option to customize the width of a message-box in px or %
	
= 1.5.3 =
* Features
	* Inform about new extensions via WordPress notification system
* Enhancements
	* Minified Javascript libraries
	* Minified CSS
	* Improved automatic stream update
* Bugfix
	* Fixed bug of message limit recognition

= 1.5.2 =
* Features
	* Automatic cache clearing
* Enhancements
	* Using transactions for database manipulations

= 1.5.1 =
* Enhancements
	* Added word-wrap attribute to prevent overflow of long text
	* Added following attributes to JSON output (expert mode):
		* fbss_picture_src
		* fbss_picture_width
		* fbss_picture_height
* Bugfixes
	* Prevent warnings while initializing cached images

= 1.5.0 =
* Features
	* Advanced-Settings
		* Added settings-option to get Facebook stream as JSON-object
		* Added settings-option to disable CSS
		* Added settings-option to disable Javascript

= 1.4.4 =
* Bugfixes
	* Fixed T_PAAMAYIM_NEKUDOTAYIM error for PHP version < 5.3.0

= 1.4.3 =
* Features
	* Added setting-options for maximum width of the default-template message-box
	* Added setting-options for maximum width of the default-template meta-box
	* Added Swedish translations (credits to dreadford)
* Notes
	* Tested with 4.3-RC2

= 1.4.2 =
* Bugfixes
	* Fixed HTML attribute in extensions overview
	* Improved Javascript function to identify HTML return value if other plugins or themes produce header-output

= 1.4.1 =
* Bugfixes
	* Fixed settings link in plugin-view
	* Renamed extension-updater to prevent naming-collision

= 1.4.0 =
* Features
	* Extensions area available for new features
	* Introduced main administration page
* Enhancements
	* Outsourced inline HTML into template-views

= 1.3.6 =
* Features
	* Display shared videos (e.g. YouTube) as video-box
* Enhancements
	* Switched to Facebook Graph API v2.4
	* Reduced API calls

= 1.3.5 =
* Bugfixes
	* QuickFix for Facebook API changes

= 1.3.4 =
* Features
	* Show last stream-update time on settings page
	* Update stream manually via settings page

= 1.3.3 =
* Features
	* Added video messages as HTML5 video player (Flash dies anyway)
	* Added text-color-customization options of default template
* Enhancements
	* Recognize WordPress timezone settings for date output
	* Harmonized plugin option names

= 1.3.2 =
* Enhancements
	* Replace \n with html line-breaks in message-text

= 1.3.1 =
* Enhancements
	* Improved regex to identify hashtags and links in message-text

= 1.3.0 =
* Features
	* Added color-customization to plugin-settings
	* Added color-picker to settings page
	* Introduced configuration of template-styling
* Enhancements
	* Save current version number in database for later update routines
	* Update stream automatically if page-name or access-token changed or max-messages increased

= 1.2.6 =
* Enhancements
	* Set Javascript variables via wp_localize_script() to identify ajax-url in script

= 1.2.5 =
* Enhancements
	* Changed default value of update interval
* Bugfixes
	* Set database table to innoDB engine to prevent "Specified key was too long" error

= 1.2.4 =
* Bugfixes
	* Fixed Javascript error

= 1.2.3 =
* Enhancements
 	* Link to gallery instead of first image of gallery
 	* Skip videos until video-player is implemented
* Bugfixes
	* Changed CSS style of links without images to prevent whitespace

= 1.2.2 =
* Enhancements
	* Validation of Facebook page-name
	* Changed CSS to add responsive behaviour to profile image

= 1.2.1 =
* Enhancements
	* Renamed classes to prevent conflicts with other plugins or themes

= 1.2.0 =
* Features
	* Added schema.org markup to default-template
	* Added German translations
	* Create HTML-links out of message text URLs
	* Create HTML-links out of hashtags in message text
* Bugfixes
	* Added alt-attribute to link-image
	* Fixed likes- and comments-count
* Enhancements
	* Cleanup cached data after changing Facebook page-name

= 1.1.0 =
* Features
	* Added function to identify Facebook post-type "link"
	* Extended default-template to handle Facebook "link" objects
	* Changed colour-theme of default-template into bright grey

= 1.0.0  =
* First version ready to go!
