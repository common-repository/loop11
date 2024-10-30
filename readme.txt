=== Loop11 for Wordpress ===
Contributors: loop11ux
Tags: loop11 
Requires at least: 2.0.0
Tested up to: 4.3.1
Stable tag: 1.0

This plugin allows simple insertion of the Loop11 JavaScript code, no programming required, start your user testing today!

== Description ==

With Loop11 for Wordpress you can start testing immediately without any knowledge of development or assistance from programmers. 

== Installation ==

Follow these steps to use the plugin:

1. Upload the 'loop11'-folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to your Loop11 account, click on ‘My Account’ and copy the JavaScript provided to you in this page
4. Then, back in WordPress, go to the Loop11 plugin in the side panel and follow the prompts to paste your Loop11 JavaScript code 

== Frequently Asked Questions ==

= Where do I get the tracking code? =

You get the tracking code by signing up on Loop11.com. You can easily create an account for free by following this link: http://loop11.com/sign-up/. Once signed up, click on 'My Account' and copy the code beneath the heading 'JavaScript'. If you are launching a test which intercepts visitors with a pop-up, you will be provided with a slightly different piece of code prior to launching your test.

If you wish to run tests across sub-domains or across different domains you will find a link to how to do this within the ‘My Account’ page.

= The code is not working =

1. Make sure you've inserted the script code in the settings page.
2. Check that you have the wp_footer() function in all pages of the website's template.
3. Check your website's html source (Page / View source) and search for "loop11". In the case that the JavaScript is found at the end of the <body> section, but still not working, you probably entered a different domain when configuring your Loop11 test. Make sure that the domains are matching. 
4. Get in touch with out support team.