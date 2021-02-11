# dbg
a small php debugging software

# Example
You need to add this to your config.php file or a file that's always included

```
// define the IP address BEFORE loading the library.
define('QS_DBG_ALLOWED_IPS', '127.0.0.1,1.2.3.4' );

// Load
require_once ___DIR__ . '/qs_dbg.php';

// debug simple variable.
qs_dbg("My data");

// debug an array
qs_dbg([
	'complex' => [
		'site_url' => 'https://qSandbox.com',
		'title' => 'WordPress staging sites',
	],
]);
```

# Support & Suggestions
Submit a ticket here
https://github.com/qsandbox/dbg/issues

# Paid customizations
Yes, that can be arranged.

# Author
Svetoslav Marinov (Slav) - https://qSandbox.com

# About qSandbox
Staging WordPress Sites Made Easy
Set up a free WordPress (test & private) site in seconds to experiment, learn, teach or (re)design.

# License
MIT
