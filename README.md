# WP 2FA Login As User Bypass

![Plugin Banner](assets/banner-1544x500.png)

A lightweight WordPress plugin that temporarily disables WP 2FA enforcement when using the "Login as User" plugin for seamless user switching.

## Description

This plugin solves a specific compatibility issue between [WP 2FA](https://wordpress.org/plugins/wp-2fa/) and [Login as User](https://wordpress.org/plugins/login-as-user/) plugins. When administrators use "Login as User" to temporarily access another user's account, this plugin prevents WP 2FA from being enforced during that session.

Key features:
- Automatically detects Login as User sessions
- Temporarily bypasses WP 2FA enforcement
- Zero configuration needed
- Lightweight and efficient

## Installation

1. Upload the plugin files to the `/wp-content/plugins/wp-2fa-loginasuser-bypass` directory
2. Activate the plugin through the 'Plugins' screen in WordPress
3. That's it! The plugin works automatically when both WP 2FA and Login as User are active

## Requirements

- WordPress 5.6+
- PHP 7.4+
- [WP 2FA](https://wordpress.org/plugins/wp-2fa/) plugin
- [Login as User](https://wordpress.org/plugins/login-as-user/) plugin

## Frequently Asked Questions

### Why do I need this plugin?

When using both WP 2FA and Login as User plugins, you might encounter a situation where 2FA is required even during temporary user switching. This plugin solves that specific use case.

### Is this secure?

Yes. The bypass only occurs:
- During active Login as User sessions
- For the duration of the session only
- When both plugins are properly installed

### Can I customize the behavior?

Currently the plugin works automatically with no configuration needed. If you need custom behavior, you can fork the repository or submit a feature request.

## Screenshots

1. Normal admin view with both plugins active
2. Seamless user switching without 2FA interruption

## Changelog

### 1.0.0
* Initial release
* Basic functionality to bypass WP 2FA during Login as User sessions

## License

GPL-2.0+