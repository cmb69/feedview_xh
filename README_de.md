# Feedview_XH

Feedview_XH ermöglicht die Einbindung von RSS und Atom News-Feeds auf Ihrer
Website.
Beachten Sie, dass die Wiedergabe solcher Feeds nicht notwendigerweise
erlaubt ist; prüfen Sie die Bestimmungen des Herausgebers des Feeds; im
Zweifelsfall fragen Sie um Erlaubnis.

- [Voraussetzungen](#voraussetzungen)
- [Download](#download)
- [Installation](#installation)
- [Einstellungen](#einstellungen)
- [Verwendung](#verwendung)
  - [Benutzerdefinierte Templates](#benutzerdefinierte-templates)
- [Fehlerbehebung](#fehlerbehebung)
- [Lizenz](#lizenz)
- [Danksagung](#danksagung)

## Voraussetzungen

Feedview_XH ist ein Plugin für CMSimple_XH.
Es benötigt CMSimple_XH ≥ 1.7.0 und PHP ≥ 7.2.0.

## Download

Das [aktuelle Release](https://github.com/cmb69/feedview_xh/releases/latest)
kann von Github herunter geladen werden.

## Installation

Die Installation erfolgt wie bei vielen anderen CMSimple_XH-Plugins
auch. Im
[CMSimple_XH Wiki](https://wiki.cmsimple-xh.org/doku.php/de:installation#plugins)
finden Sie weitere Details.

1. **Sichern Sie die Daten auf Ihrem Server.**
1. Entpacken Sie die ZIP-Datei auf Ihrem Computer.
1. Laden Sie den gesamten Ordner `feedview/` auf Ihren Server
   in den `plugins/` Ordner von CMSimple_XH hoch.
1. Vergeben Sie Schreibrechte für die Unterverzeichnisse `cache/`, `css/`,
   `config/` und `languages/`.

## Einstellungen

Die Konfiguration des Plugins erfolgt wie bei vielen anderen
CMSimple_XH Plugins auch im Administrationsbereich der Homepage.
Wählen Sie Plugins → Feedview.

Sie können die Original-Einstellungen von Feedview_XH unter `Konfiguration`
ändern. Beim Überfahren der Hilfe-Icons mit der Maus werden Hinweise zu den
Einstellungen angezeigt.

Die Lokalisierung wird unter `Sprache` vorgenommen. Sie können die
Zeichenketten in Ihre eigene Sprache übersetzen (falls keine entsprechende
Sprachdatei zur Verfügung steht), oder sie entsprechend Ihren Anforderungen
anpassen.

Das Aussehen von Feedview_XH kann unter `Stylesheet` angepasst werden.

## Verwendung

Um einen Feed auf einer CMSimple_XH Seite einzubinden, schreiben Sie:

    {{{feedview('%FEED_URL%')}}}

Um einen Feed im Template einzubinden, schreiben Sie:

    <?php echo feedview('%FEED_URL%')?>

`%FEED_URL%` ist die URL eines beliebigen RSS oder Atom News-Feeds. Zum
Beispiel:

    {{{feedview('http://3-magi.net/plugins/yanp/data/feed-de.xml')}}}

Sie können beliebig viele Feeds auf jeder Seite und/oder dem Template
einbinden.

### Benutzerdefinierte Templates

Die Standard-Ansicht von Feedview_XH ist sehr einfach. Wenn Sie weitergehende
Anforderungen und grundlegende Kenntnisse von PHP haben, dann können Sie sich
Ihr eigenes Template erstellen. Diese Templates werden in `feeedview/views/`
gespeichert und funktionieren ähnlich wie CMSimple_XH Templates (allerdings
können Sie sie nicht im Administrationsbereich bearbeiten). Für den Anfang
könnten Sie vielleicht eine Kopie von `default.php` erstellen, und mit ihr
experimentieren.

Um ein benutzerdefiniertes Template zu verwenden, müssen Sie seinen Namen
(ohne das abschließende .php) als zweiten Parameter an `feedview()` übergeben. Zum
Beispiel:

    {{{feedview('%FEED_URL%', 'my_template')}}}
    <?php echo feedview('%FEED_URL%, 'my_template');?>

Innerhalb des Templates sind einige Variablen verfügbar, wovon die wichtigste
`$feed` ist, ein Exemplar von
[SimplePie](https://dev.simplepie.org/api/class-SimplePie.html).

## Fehlerbehebung

Melden Sie Programmfehler und stellen Sie Supportanfragen entweder auf
[Github](https://github.com/cmb69/feedview_xh/issues) oder im
[CMSimple_XH Forum](https://cmsimpleforum.com/).

## Lizenz

Feedview_XH ist freie Software. Sie können es unter den Bedingungen der
GNU General Public License, wie von der Free Software Foundation
veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß
Version 3 der Lizenz oder (nach Ihrer Option) jeder späteren Version.

Die Veröffentlichung von Feedview_XH erfolgt in der Hoffnung, daß es
Ihnen von Nutzen sein wird, *aber ohne irgendeine Garantie*, sogar ohne
die implizite Garantie der *Marktreife* oder der *Verwendbarkeit für einen
bestimmten Zweck*. Details finden Sie in der GNU General Public License.

Sie sollten ein Exemplar der GNU General Public License zusammen mit
Feedview_XH erhalten haben. Falls nicht, siehe <https://www.gnu.org/licenses/>.

Copyright 2014-2023 Christoph M. Becker

## Danksagung

Feedview_XH wird von [SimplePie](https://simplepie.org/) angetrieben.
Vielen Dank an alle Entwickler, die die Entwicklung wieder
aufgenommen haben, nachdem sie 2009 eingestellt wurde. Und natürlich vielen Dank
für die Veröffentlichung dieser tollen Bibliothek unter BSD Lizenz.

Das Plugin-Icon wurde von [Anomie](https://en.wikipedia.org/wiki/User:Anomie) gestaltet.
Vielen Dank für die Veröffentlichung des Icons unter GPL.

Vielen Dank an die Gemeinschaft im [CMSimple_XH Forum](https://www.cmsimpleforum.com/)
für Tipps, Anregungen und das Testen. Besonders möchte ich *Der Zwerch*
und *Ralf H*. für ihr frühes Feedback danken.

Und zu guter letzt vielen Dank an [Peter Harteg](https://www.harteg.dk/),
den “Vater” von CMSimple, und allen Entwicklern von [CMSimple_XH](https://www.cmsimple-xh.org/de/)
ohne die es dieses phantastische CMS nicht gäbe.
