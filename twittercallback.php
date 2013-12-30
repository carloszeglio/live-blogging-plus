<?php
/*
Plugin Name: Live Blogging Plus
Plugin URI: http://vidyut.net/downloads/live-blogging-plus/
Description: Plugin to support automatic live blogging and Twitter updates with link to liveblog.
Version: 1.0
Author: Vidyut Kale
Author URI: http://vidyut.net
Text-Domain: live-blogging

Based on the <a href="http://wordpress.org/extend/plugins/live-blogging/" target = "_blank">Live Blogging plugin by Chris Northwood</a>. Fixes some outdated code and allows adding links to the live blog in Twitter updates.

Details of original plugin: 

Live Blogging for WordPress
Copyright (C) 2010-2012 Chris Northwood <chris@pling.org.uk>
Contributors: Gabriel Koen, Corey Gilmore

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

// Twitter callback - save access token

require('../../../wp-blog-header.php');
$connection = new TwitterOAuth(LIVE_BLOGGING_TWITTER_CONSUMER_KEY, LIVE_BLOGGING_TWITTER_CONSUMER_SECRET, get_option('liveblogging_twitter_request_token'), get_option('liveblogging_twitter_request_secret'));
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

update_option('liveblogging_twitter_token', $access_token['oauth_token']);
update_option('liveblogging_twitter_secret', $access_token['oauth_token_secret']);
update_option('liveblogging_enable_twitter', '1');

header('Location: ' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=live-blogging-options');
