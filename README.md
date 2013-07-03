# IMAP to IMAP migration script/howto

IMAP to IMAP migration with ImapSync and a quick PHP script (howto)
Works out of the box with Google Mail and other major mail providers.
Requires [[https://github.com/imapsync/imapsync|imapsync]], likes GNU Screen.

## Setup

On Debian (-based) distro:
```bash
apt-get install libmail-imapclient-perl libdigest-md5-file-perl \
libterm-readkey-perl libio-socket-ssl-perl libfile-spec-perl libdigest-hmac-perl

perl -MCPAN -e 'install Authen::NTLM' 
```

On other systems, via Perl CPAN:
```bash
perl -MCPAN -e 'install Mail::IMAPClient' 
perl -MCPAN -e 'install Digest::MD5' 
perl -MCPAN -e 'install Term::ReadKey' 
perl -MCPAN -e 'install IO::Socket::SSL' 
perl -MCPAN -e 'install File::Spec' 
perl -MCPAN -e 'install Digest::HMAC_MD5' 
perl -MCPAN -e 'install Authen::NTLM' 
perl -MCPAN -e 'install Time::HiRes' 
```

* Download and install [[https://github.com/imapsync/imapsync|imapsync]] >= 1.480 (dc7395e)
* Prepare pseudo-csv file as explained later) 
* Configure host and domain name in the script
* Open a screen and launch the script:

```bash
imap2imap.sh.php mailbox.csv
```

## Setup options

```php
define('HOST_FROM', 'imap.dominio.ext');      // Source IMAP host (IP address is better)
define('HOST_TO', 'imap.gmail.com');          // Target IMAP host
define('DOMAIN', 'dominio.ext');              // raw domain to migrate
```

## Mailbox CSV file

Mailbox CSV file is simply a list of mailbox to migrate, with this schema:

```
source_imap_username;source_imap_password;target_imap_username;target_imap_password
source_imap_username2;source_imap_password2;target_imap_username2;target_imap_password2
```

## Sample Output
```
msg INBOX.Sent/159 {2014}  copied to Sent/159  0.34 msgs/s  115.09 KiB/s  ETA: Sat Oct 27 23:15:35 2012  485 s  164 msgs left
```

