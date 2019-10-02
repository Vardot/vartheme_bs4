# Vartheme (Bootstrap 4 - SASS)
---

A SASS base theme for [Varbase](https://www.drupal.org/project/varbase) standard websites.
 Based on Bootstrap 4 framework using SASS,
  and extending [Barrio (Bootstrap 4)](https://www.drupal.org/project/bootstrap_barrio) contrib theme.

### Install with Composer:
```
 $ composer require 'drupal/vartheme_bs4:~6.0'
```

## Create a Vartheme BS4 sub theme ( Bootstrap 4 ) SASS for a project

To Create a subtheme from Vartheme BS4, you need to copy the VARTHEME_BS4_SUBTHEME folder to `web/themes/custom/` then rename the directory to your theme name, along with all the strings underneath it. or simply if you have bash on your system you can use our automated scrip that will do all of this for you.

[Here's the script link](https://github.com/Vardot/vartheme_bs4/tree/8.x-6.x/scripts). it's also doing a bit of a magic for you like downloading the necessary npm modules. after finishing it you should already have gulp watch up and running.


## Customizing your theme

To start customizing your theme's css , you will need to make sure that you are running gulp watch
then go to /scss/ and find the relevant scss file you want to edit.

The files in the `scss` directory are following Drupal's css coding standards. please read [this guide](https://www.drupal.org/docs/develop/standards/css/css-file-organization-for-drupal-8) to learn more
