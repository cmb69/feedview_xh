# Feedview_XH

Feedview_XH facilitates to embed RSS and Atom feeds on your website.
Note that the reproduction of such feeds is not necessarily permitted; check
the provisions of the publisher of the feed; if in doubt, contact them for
permission.

- [Requirements](#requirements)
- [Download](#download)
- [Installation](#installation)
- [Settings](#settings)
- [Usage](#usage)
  - [Custom Templates](#custom-templates)
- [Troubleshooting](#troubleshooting)
- [License](#license)
- [Credits](#credits)

## Requirements

Feedview_XH is a plugin for CMSimple_XH.
It requires CMSimple_XH ≥ 1.7.0 and PHP ≥ 7.2.0.

## Download

The [lastest release](https://github.com/cmb69/feedview_xh/releases/latest)
is available for download on Github.

## Installation

The installation is done as with many other CMSimple\_XH plugins. See the
[CMSimple\_XH Wiki](https://wiki.cmsimple-xh.org/?for-users/working-with-the-cms/plugins)
for further details.

1. **Backup the data on your server.**
1. Unzip the distribution on your computer.
1. Upload the whole folder `feedview/` to your server into the `plugins/`
   folder of CMSimple_XH.</li>
1. Set write permissions for the subfolders `cache/`, `css/`, `config/` and
   `languages/`.

## Settings

The configuration of the plugin is done as with many other CMSimple_XH plugins in
the back-end of the Website. Select Plugins → Feedview.

You can change the default settings of Feedview_XH under `Config`.
Hints for the options will be displayed when hovering over the help icons
with your mouse.

Localization is done under `Language`. You can translate the character
strings to your own language (if there is no appropriate language file
available), or customize them according to your needs.

The look of Feedview_XH can be customized under `Stylesheet`.

## Usage

To embed a feed on a CMSimple_XH page, write:

    {{{feedview('%FEED_URL%')}}}

To embed a feed in the template, write:

    <?php echo feedview('%FEED_URL%')?>

`%FEED_URL%` is the URL of an arbitrary RSS or Atom news feed. For example:

    {{{feedview('http://3-magi.net/plugins/yanp/data/feed-en.xml')}}}

You can embed an arbitrary amount of feeds on each page and/or the
template.

### Custom Templates

The default view of Feedview_XH is very simple. If you have advanced needs
and a basic knowledge of PHP, you can create your own template. These templates
are stored in `feedview/views`, and work similar to CMSimple_XH templates
(however, you cannot edit them in the administration). For a start you might want
to make a copy of `default.php` and experiment with it.

To use a custom template, you have to give its name (without the trailing
.php) as second parameter to `feedview()`, for example:

    {{{feedview('%FEED_URL%', 'my_template')}}}
    <?php echo feedview('%FEED_URL%, 'my_template');?>

Inside the template, some variables are available, most notably `$feed` which
is an instance of
[SimplePie](https://dev.simplepie.org/api/class-SimplePie.html).

## Troubleshooting

Report bugs and ask for support either on [Github](https://github.com/cmb69/feedview_xh/issues)
or in the [CMSimple_XH Forum](https://cmsimpleforum.com/).

## License

Feedview_XH is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Feedview_XH is distributed in the hope that it will be useful,
but *without any warranty*; without even the implied warranty of
*merchantibility* or *fitness for a particular purpose*. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Feedview_XH.  If not, see <https://www.gnu.org/licenses/>.

Copyright 2014 Christoph M. Becker

## Credits

Feedview_XH is powered by [SimplePie](https://simplepie.org/).
Many thanks to all developers who have resumed the development after it has been
ceased in 2009. And of course, many thanks for releasing this fine library under
BSD license.

The plugin icon is designed by [Anomie](https://en.wikipedia.org/wiki/User:Anomie).
Many thanks for publishing the icon under GPL.

Many thanks to the community at the [CMSimple_XH Forum](https://www.cmsimpleforum.com/)
for tips, suggestions and testing. Especially I want to thank *Der Zwerch* and
*Ralf H.* for their early feedback.

And last but not least many thanks to [Peter Harteg](https://www.harteg.dk/),
the “father” of CMSimple, and all developers of [CMSimple_XH](https://www.cmsimple-xh.org/)
without whom this amazing CMS would not exist.
