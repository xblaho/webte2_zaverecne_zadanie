<?php
// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
echo exec('octave-cli --persist --eval "x = 1"');
echo exec('x + 2');
?>