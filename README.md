This is a simple PHP script that pulls a log file from the Apache logs and formats it for display in a web browser.
To set it up on your machine, pass in the Apache log file name to the SimpleLogViewer constructor in index.php.

Instead of viewing Apache logs in Terminal on a Mac like this:
![Screenshot of Mac OS X Terminal showing Apache logs](terminal.png?raw=true)

We can view them in a browser like this:
![Screenshot of browser on Mac OS X showing Apache logs](browser.png?raw=true)


TODO: add heartbeat AJAX request to update the UI
TODO: display all logs from /var/log/apache2/, then user can click to view one