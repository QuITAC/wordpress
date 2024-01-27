=== Plugin Name ===
Contributors: eneoli
Donate link: https://paypal.me/eneoli
Tags: caldav, ics, events
Requires at least: 3.0.1
Tested up to: 5.6.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Termine eines CalDav-Servers auf deiner WordPress-Seite anzeigen lassen.

== Description ==

Zeige die Termine aus deinem CalDav-Server (z.B. Nextcloud) als Tabelle oder Kalender bequem auf deiner
Worpress Seite an.

### Installation

1. Plugin installieren und aktivieren.
2. Zugangsdaten unter Einstellungen -> caldavlist Einstellungen eintragen
3. Shortcode [caldavlist] zur Seite hinzufügen

URL: URL des Caldav-Servers mit Benutzername
Beispiel (Nextcloud): https://{server url}/nextcloud/remote.php/dav/calendars/{user}/

Benutzername: Name des Nutzers, mit dem sich am Caldav-Server authentifiziert wird

Passwort: Das Passwort des Benutzers

Filter Buttons:

Hier können die Filter eingetragen werden, nach denen die Kategorien in der Tabelle gefiltert werden.
Pro Filter immer ein Zeile.

Lesbarere Name:Filtername

Beispiel:

Ferien:vacation
Sehr wichtig:important
....

== Installation ==

1. Plugin installieren und aktivieren.
2. Zugangsdaten unter Einstellungen -> caldavlist Einstellungen eintragen
3. Shortcode [caldavlist] zur Seite hinzufügen

URL: URL des Caldav-Servers mit Benutzername
Beispiel (Nextcloud): https://{server url}/nextcloud/remote.php/dav/calendars/{user}/

Benutzername: Name des Nutzers, mit dem sich am Caldav-Server authentifiziert wird

Passwort: Das Passwort des Benutzers

Filter Buttons:

Hier können die Filter eingetragen werden, nach denen die Kategorien in der Tabelle gefiltert werden.
Pro Filter immer ein Zeile.

Lesbarere Name:Filtername

Beispiel:

Ferien:vacation
Sehr wichtig:important
....

== Troubleshooting ==

Sollte sich die Seite nicht abspeichern lassen, nachdem der Shortcode eingefügt wurde und/oder kommt der "Oops"-Screen, deutet dies auf falsche Server-Einstellungen hin.


== Mich unterstützen ==

Sollte das Plugin dir gefallen, würde ich mich über eine [Spende](https://paypal.me/eneoli) freuen. Das unterstützt mich und zeigt, dass das Plugin ankommt. Vielen Dank!

== Changelog ==
= 1.1.4 =
Bugfix: double events due to wrong rrule handling
Bugfix: scrollbar on long event description in calendar view
Bugfix: proper scrolling on long event description in calendar view on desktop and mobile
Bugfix: missing whitespace in calendar popup

= 1.1.3 =
Bugfix: ignored categories are not ignored

= 1.1.2 =
Bugfix: Prevent caldav error if DAV Header is lower case
Bugfix: Thunderbird Lightning/Nextcloud inconsistency fix applied for new object structure

= 1.1.1 =
Bugfix: Not all RRule occurrences shown
Bugfix: Table time formatting

= 1.1.0 =
* Feature: RRules are now supported
* Feature: Links are now clickable
* Feature/Bugfix: The Ooops Screen shows now EVERY error (PHP/JS)
* Bugfix: Plugin crashes if no events and start date is empty
* Bugfix: Preventing scrolling in calendar view
* Refactoring: added abstraction layer for events
* Refactoring: changed way of how events are parsed and transformed into objects
* Refactoring: removed old babel polyfill
* Refactoring: updated all dependencies

= 1.0.13 =
* Bugfix: prevent error if no categories set in settings

= 1.0.12 =
* Feature: added error screen
* Feature/Bugfix: added polyfill to support older devices

= 1.0.11 =
* Feature: Events marked as private are not shown
* Bugfix Thunderbird Lightning/Nextcloud category inconsistency

= 1.0.10 =
* Bugfix: Nicer category formatting

= 1.0.9 =
* Bugfix: Shows all Events if display uncategorized events option is enabled
* Bugfix: Nicer category formatting

= 1.0.8 =
* Feature: Also display events without Category when filtering option

= 1.0.7 =
* Bugfix: display multiple categories right
* Bugfix: responsive table

= 1.0.6 =
* white-space: pre-wrap
* Bugfix: No events if ignored categories empty

= 1.0.5 =
* Feature: filter categories

= 1.0.4 =
* bugfixes
* word-break normal on desktop view in table
* Added disabled cursor if trying to print calendar view

= 1.0.3 =
* performance optimization

= 1.0.2 =
* adding heading on print page
* minor bug fixes

= 1.0.1 =
* fix error in console if root element not found on current page

= 1.0 =
* first version
