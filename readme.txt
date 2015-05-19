=== Plugin Name ===
Contributors: ryuheixys
Donate link: http://y-designs.com
Tags: bullhorn,rss,recuriting,jobs
Requires at least: 4.2.1
Tested up to: 4.2.1
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Put in the RSS link in the configs, it'll list the jobs for you.  This works pretty much as a simplest implementation RSS/XML reader.  This was specifically made for Bullhorn's RSS feed and has basic styling applied.  It may be used for other RSS feeds though I built it specifically for the Bullhorn usecase.

== Description ==

Plugin pulls any rss feed and displays relevant information on the page.
The url/feed you're looking for might look something like below:
```
http://XXXX.bullhornstaffing.com/JobBoard/Standard/JobOpportunitiesRSS.cfm?privateLabelID=XXXXX
```

== Installation ==

Install the plugin as you would with any WordPress plugin in your wp-content/plugins/ directory or equivalent.
Then:
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. A new settings sould appear after activation.  It should be called "BHRSS Settings"
1. Put in your configs there (Bullhorn RSS url which you can grab from any jobs listing page on BH)
1. Put the [bullhorn_rss] shortcode where you want your RSS content to display.


== Frequently Asked Questions ==

= Is this guaranteed to work =

No. I threw it together in 2 hours.  There are no guarantees.  Plus its free!

= Why don't you use the API? =

I suppose I could, but it would have been a lot more time.

= What about foo bar? =

If you want foo bar fixed, email me at info@y-designs.com 
You bet your butt you can pay me for it ;) 

== Screenshots ==

1. No screenshots yet.  I'll add it later, but you can check out an example here:

== Changelog ==

= 0.1 =
* Initial release no guarantees

== Upgrade Notice ==

No upgrades will happen at this time.