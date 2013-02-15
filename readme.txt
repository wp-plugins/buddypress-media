=== BuddyPress Media ===
Contributors: rtcamp, rahul286, gagan0123, umesh.nevase, suhasgirgaonkar, neerukoul, saurabhshukla, JoshuaAbenazer, faishal, hrishiv90
Donate link: http://rtcamp.com/donate
Tags: BuddyPress, media, multimedia, album, audio, songs, music, video, photo, image, upload, share, MediaElement.js, ffmpeg, kaltura, media-node
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 2.5.5

Adds Photos, Music, Videos & Albums to your BuddyPress. Supports mobile devices (iPhone/iPad, etc) and automatic audio/video conversion.

== Description ==

BuddyPress Media adds Photos, Music, Videos & Albums to your BuddyPress. Supports mobile devices (iPhone/iPad, etc) and automatic audio/video conversion.

= Important =

BuddyPress Media is now available in **Brazilian Portuguese**, **Spanish** and **Japanese**. Translations for German, Italian, French and Dutch are in progress. BuddyPress Media includes [full translation support](https://rtcamp.com/tutorials/buddypress-media-translation/). Head over to the [translation project](http://rtcamp.com/translate/projects/buddypress-media/) to contribute your translations. If you don't see the language of your choice, let us know in the support forum, we'll add it.

= iOS6 Uploads =

There's a bug in iOS 6, due to which multiple image uploads won't work. It provides all images as image.jpeg which the WordPress uploader (plupload) doesn't like. It assumes that it's got duplicate images and will upload just one.

= Features =

* Images, Music, Videos Upload
* User-Albums Support
* Group Media Support
* Multiple files upload with Drag-n-Drop
* Uploading Photos/Videos via mobile (Tested on iPhone running iOS6)
* HTML5 player (with fall back to flash/silverlight player support)
* Automatic conversion of common audio & video formats to mp3/mp4. via [Kaltura Add-On](http://rtcamp.com/store/buddypress-media-kaltura/ "BuddyPress Media Kaltura Addon for Kaltura.com/Kaltura-CE/Kaltura On-Prem version") and [FFMPEG Add-On](http://rtcamp.com/store/buddypress-media-ffmpeg-converter/ "BuddyPress Media FFMPEG Addon")

= Translations =
* [Brazilian Portuguese](https://rtcamp.com/translate/projects/buddypress-media/pt-br/default)  translation by [Jose Fabiosan](http://profiles.wordpress.org/josefabiosan/) and [doutorsocrates](http://profiles.wordpress.org/doutorsocrates/)
* [Spanish](https://rtcamp.com/translate/projects/buddypress-media/es/default) translation by [Andrés Felipe](http://profiles.wordpress.org/naturalworldstm/)
* [Japanese](https://rtcamp.com/translate/projects/buddypress-media/ja/default) translation by [Tetsu Yamaoka](http://twitter.com/ytetsu)

= Roadmap =

* Activity-update form media upload
* Privacy Settings
* Importers for other media plugins
* Paid membership plans, i.e. "Upload Quota" for buddypress members  (in planning stage).

= Demo =
* [BuddyPress-Media Demo](http://demo.rtcamp.com/buddypress-media) (Stand-alone)
* [BuddyPress-Media + Kaltura Add-on](http://demo.rtcamp.com/bpm-kaltura)
* [BuddyPress-Media + FFMPEG Add-on](http://demo.rtcamp.com/bpm-ffmpeg)

== Installation ==

= BuddyPress Media Plugin =

* Install the plugin from the 'Plugins' section in your dashboard (Go to `Plugins > Add New > Search` and search for BuddyPress Media).
* Alternatively, you can [download](http://downloads.wordpress.org/plugin/buddypress-media.zip "Download BuddyPress Media") the plugin from the repository. Unzip it and upload it to the plugins folder of your WordPress installation (`wp-content/plugins/` directory of your WordPress installation).
* Activate it through the 'Plugins' section.

= BuddyPress Media Add-ons =

[**BuddyPress-Media Kaltura addon**](http://rtcamp.com/store/buddypress-media-kaltura/ "BuddyPress Media Kaltura Addon for Kaltura.com/Kaltura-CE/Kaltura On-Prem version")

* It also supports many video formats including *.avi, *.mkv, *.asf, *.flv, *.wmv, *.rm, *.mpg.
* You can use Kaltura.com/Kaltura On-Prem or self-hosted Kaltura-CE server with this.

You can purchase it from [here](http://rtcamp.com/store/buddypress-media-kaltura/ "BuddyPress Media Kaltura Addon for Kaltura.com/Kaltura-CE/Kaltura On-Prem version")

--

[**BuddyPress-Media FFMPEG addon**](http://rtcamp.com/store/buddypress-media-ffmpeg-converter/ "BuddyPress Media FFMPEG Addon").

* It also supports many video formats including *.avi, *.mkv, *.asf, *.flv, *.wmv, *.rm, *.mpg.
* It also supports many audio formats including *.mp3, *.ogg, *.wav, *.aac, *.m4a, *.wma.

You can purchase it from [here](http://rtcamp.com/store/buddypress-media-ffmpeg-converter/ "BuddyPress Media FFMPEG Addon").


== Frequently Asked Questions ==

Please visit [BuddyPress Media's FAQ page](http://rtcamp.com/buddypress-media/faq/ "Visit BuddyPress Media's FAQ page").

== Screenshots ==

Please visit [BuddyPress Media's Features page](http://rtcamp.com/buddypress-media/features/ "Visit BuddyPress Media's Features page").

== Changelog ==

Please visit [BuddyPress Media's Roadmap page](http://rtcamp.com/buddypress-media/roadmap/ "Visit BuddyPress Media's Features page") to get some details about future releases.

= 2.5.5 =
* Fixes thumbnail appearance and height issues with some themes.
* Other minor UI changes

= 2.5.4 =
* Added option to enable/disable BuddyPress Media on Groups. (Profile toggle, coming soon)
* Added Polish language.
* Media tabs display now responds to admin settings
* Improved Uploader UI.
* Improved settings screen.
* More code comments and documentation added.
* Fixed gallery responsiveness.
* A few bug fixes.

= 2.5.3 =
* Added option to toggle BuddyPress Media menu in admin bar
* Added incomplete translations for German, Italian, French and Dutch languages
* A few bug fixes.

= 2.5.2 =
* Fixes warning on admin side.

= 2.5.1 =
* Fixed bug where when a user visits another member's media tab when groups are inactive, they'd get an error.
* Improved long album title and count display.

= 2.5 =
* Bug fixes for admin notices on multisite installs.
* Bug fixes for activity on multiple uploads.
* Updated upload UI. Now uploads are possible from all tabs.
* Fixed translation readiness.
* Added Brazilian Portuguese, Spanish and Japanese languages.
* Added Album renaming and deleting functionality.

= 2.4.3 =
* Fixed latest activity formatting.
* Added auto-update for add-ons.
* Made minor changes for add-on compatibility.

= 2.4.2 =
* Fixed bug where settings weren't getting saved on multisites.
* Workaround for bug where the last activity wouldn't show up.
* Fixed bug with iOS uploads.
* Some minor code changes

= 2.4.1 =
* New Widget added with more options!
* Fixed 'Show More' action on Group Album thanks to [bowoolley](http://profiles.wordpress.org/bowoolley/)
* Fixed conflicts with 'BuddyPress Activity Plus', thanks to [number_6](http://profiles.wordpress.org/number_6/) and [param-veer](https://github.com/param-veer)
* Some more housekeeping, code cleanup and documentation.

= 2.4 =
* Total code overhaul. Fixed a lot of bugs and optimised a lot of other code.
* Added proper translation support!
* Removed extra jQuery UI scripts and styles, for speed and optimisation

= 2.3.2 =
* Album creation on a single file upload. Thanks to [Josh Levinson](http://profiles.wordpress.org/joshlevinson/) for providing the fix.
* Fixed Version number constant.

= 2.3.1 =
* Default permission for album creation in groups set to admin.
* Fixed the warning on the "New Post" about the MYSQL query.

= 2.3 =
* Groups Media feature added
* Featured image selection in albums

= 2.2.8 =
* Fixed some screen functions

= 2.2.7 =
* Fixed the "Upgrade" button issue

= 2.2.6  =
* Fixed the Multisite issue for the options page.

= 2.2.5 =
* Fixed a bug in upgrade script

= 2.2.4 =
* Added support for media-count on albums
* fixes bbPress conflict in_array() expects parameter 2

= 2.2.3 =
* Added more verification to check whether the object being used is available or not.
* Added custom message on delete activity action.
* Modified the upgrade loop to handle the sites with large number of media files.

= 2.2.2 =
* Fixed the Notice that was generated on the albums page.

= 2.2.1 =
* Removed anonymous function since its not supported in PHP versions < 5.3

= 2.2 =
* Album Support for Users
* Ajaxified pagination to make it easy to view large albums.
* Multiple file uploads with progress bar
* Easy access to the backend admin-options
* Admin-option to disable download button below media files.

= 2.1.5 =
* Fixed the postmeta box bug

= 2.1.4 =
* Added video thumbnail support for addons.
* Updated the MediaElementJS player library.

= 2.1.3 =
* Fixed file uploading via iPhone.

= 2.1.2 =
* Changed some default values and normalized all files with end of file as line feed only

= 2.1.1 =
* Some changes in readme file

= 2.1 =
* Added necessary hooks & filters to support buddypress-media add-on creation.
* Support for video format added including *.avi, *.mkv, *.asf, *.flv, *.wmv, *.rm, *.mpg.
* Support for audio format added including *.mp3, *.ogg, *.wav, *.aac, *.m4a, *.wma.

= 2.0.4 =
* Added remaining modules of getID3 php library
* Added checking for MP3 filetype and its content before uploading

= 2.0.3 =
* Added a few filters and actions for addon support
* Fixed the short open tag bug

= 2.0.2 =
* Delete functionality fixed
* Edit functionality for Media Title and Media Description
* Admins can manage which media types to allow

= 2.0.1 =
* Replaced codec finding library
* Fixed warning on activities page

= 2.0 =
* Integration into BuddyPress Activities
* HTML5 Audio Tag Support (with fallback)
* HTML5 Video Tag Support (with fallback)

== Upgrade Notice ==
=2.5.5=
Fixes css breaks on some themes.
