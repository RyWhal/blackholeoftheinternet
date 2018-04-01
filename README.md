blackholeoftheinternet
======================

**Blackholeoftheinternet is currently down and I have no intentenions of bringing it back up**



Blackhole of the Internet is a quick and dirty project that I decided to work on over a weekend a while back. I wondered what people would write if you gave them a empty text box with no prompt. And then you give them back something that someone else has said. And that was it.

Be warned, there is some vulgarity on bloackholeoftheinternet.com. Also, to aid in some basic spam filtering, there is a dictionary of vulgarity in the vars.php file. So if you don't want to see dirty words, dont look in that file.


You will need a "secrets.php" in the root directory. It will look something like this:
```
<?php
$host = "<database hostname>";
$username = "<mysql username>";
$password = "<mysql password>";
$db_name = "entry";
$table = "entry";
?>
```

And this is what my MySQL table looks like:
```
*************************** 1. row ***************************
       Table: entry
Create Table: CREATE TABLE `entry` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `name` tinytext,
  `text` tinytext,
  `md5` char(32) DEFAULT NULL,
  `score` int(2) DEFAULT '5',
  `spam_score` int(2) DEFAULT NULL,
  `spam` tinyint(1) DEFAULT '0',
  `ip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `md5` (`md5`)
) ENGINE=InnoDB AUTO_INCREMENT=734 DEFAULT CHARSET=latin1
1 row in set (0.00 sec)
```

Spam Function
=============
I ended up playing a lot with the spam function on this project. It became the more entertaining part of the whole thing.

Before the entry even hits the spam filter:

>1) All white space and special characters are stripped out from the text entry.

>2) All characters are converted to lowercase characters

>3) An Md5 hash is created from the new lowercase, no white space, no special charcter string.

>4) That MD5 hash is checked against the database to see if it already exists.

>5) If the MD5 does not exist, the original string (not the modified one) is sent off to the spam function for further checking

Once it reaches the spam filter:

>1) The original string is once again converted to all lowercase letters

>2) The entry string is compared against an english dictionary to see how many words dont appear in the english dictionary to get its "word score"

>3) The entry string is then compared againse a dictionary of vulgarity. However many vulgar words occur is its "vulgarity score"

>4) Then the # of occurances of characters and checks to see if they are near expected tolerances. Each time a set of characters is out of the expected range, that is one ticket to the "Character score". for example, this is to prevent something like "ljkahsdlfjhaslkdfjhsldkjfh".

>5) All of the three scores (spam, vulgarity, and character) are added together for a spam score

>6) The spam score that allows an entry is different based on the number of words.

If the entry passes the spam tolerances, its added to the Database and will show up in random entries. An entry that fails the spam check is still entered into the Database, but will now display.


The spam filter is not perfect, but it does help stop some spam.

CLI Blackhole
=============

To Get a random entry:
$> curl blackholeoftheinternet.com/api/get.php

To Set an entry:
$> curl -F "submission=Clever Entry" -F "name=Your Name" blackholeoftheinternet.com/api/set.php

*note the "name" field is not required
```
rwhalen-mbp:~ rwhalen$ curl blackholeoftheinternet.com/api/get.php
"Bill gates is god"
- Anonymous
rwhalen-mbp:~ rwhalen$
```

```
rwhalen-mbp:~ rwhalen$ curl -F "submission=I'm doin it for the Man Pages" -F "name=RyWhal" blackholeoftheinternet.com/api/set.php
rwhalen-mbp:~ rwhalen$
```
*no response from the set means success



