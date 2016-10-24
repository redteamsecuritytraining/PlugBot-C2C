
<h1>Synopsis</h1>

PlugBot project is a security research project by <a href="http://www.redteamsecure.com">RedTeam Security</a>, led by Jeremiah Talamantes. It is designed to be a proof-of-concept / experimental foray into the development of software that could potentially support the concept of a hardware botnet. The project is made up of two components, PlugBot Bot and PlugBot Command & Control. The hardware component to this project is intended to be single-board computers, such as: Raspberry Pi, Beaglebone, Cubox, etc.

<h1>Motivation</h1>

Jeremiah began developing the concept in early 2010 upon the surge of <a href="http://en.wikipedia.org/wiki/Plug_computer">plug computers</a> into the tech market. Although the development ceased not soon after, the research aspect continued into his dissertation and finally came to life again in early 2015.

<h1>C2C Installation</h1>

Carry out the following steps to install:

<ol>
	<li>Copy the code into your web server's web root</li>
	<li>Open application/config/config.php and change the encryption_key to arbitrary/random characters (line 232)</li>
	<li>Open application/config/database.php and set your database's hostname, username and password (lines 51 to 53)</li>
	<li>Ensure the system requirements below are installed</li>
	<li>Import the MySQL database from file (db_plugbot.sql) into an empty db titled: db_plugbot</li>
	<li>Once system is running, change your password!</li>
</ol>

<b>C2C System Requirements</b>

<ul>
	<li>Linux OS</li>
	<li>Apache2</li>
	<li>PHP5 (php5-curl)</li>
	<li>MySQL</li>
	<li>Tor</li>
	<li>phpmyadmin (recommended)</li>
	<li>cURL, wput, wget</li>
</ul>

<h1>Configure .htaccess</h1>

The PlugBot project is built on the <a href="http://www.codeigniter.com/" target="_blank">CodeIgniter Framework</a>. To get the C2C to work effectively, you will likely need to add an .htaccess file to the root of your code folder.

		<IfModule mod_rewrite.c>
		  RewriteEngine On
		  # !IMPORTANT! Set your RewriteBase here and don't forget trailing and leading
		  #  slashes.
		  # If your page resides at
		  #  http://www.example.com/mypage/test1
		  # then use
		  # RewriteBase /mypage/test1/
		  RewriteBase /pb/
		  RewriteCond %{REQUEST_FILENAME} !-f
		  RewriteCond %{REQUEST_FILENAME} !-d
		  RewriteRule ^(.*)$ index.php?/$1 [L]
		</IfModule>
		
		<IfModule !mod_rewrite.c>
		  # If we don't have mod_rewrite installed, all 404's
		  # can be sent to index.php, and everything works as normal.
		  # Submitted by: ElliotHaughin
		
		  ErrorDocument 404 /index.php
		</IfModule>
		
Be sure to enable mod_rewrite if you are using Apache2

<code>sudo a2enmod rewrite</code>

For more information, go here: <a href="http://www.codeigniter.com/userguide2/general/urls.html" target="_blank">http://www.codeigniter.com/userguide2/general/urls.html</a>

<h1>Login</h1>

The default username is <b>admin</b> and the default password is <b>admin</b>.

<h1>Tor Setup</h1>

If you want your C2C to be a hidden Tor site, visit the link below to configure it accordingly:

<a href="https://www.torproject.org/docs/tor-hidden-service.html.en" target="_blank">https://www.torproject.org/docs/tor-hidden-service.html.en</a>

<h1>PlugBot Apps</h1>

To get started using PlugBot, we've provided the following Gist scripts that can be used with the PlugBot project:

<a href="https://gist.github.com/redteamsecurity" target="_blank">https://gist.github.com/redteamsecurity</a>

<h1>Contributors</h1>

Jeremiah is an information security consultant, not a developer. Therefore much help is needed to improve the project all around. If you're proficient in PHP / CodeIgniter and want to contribute, contact jeremiah[at]redteamsecure[dot]com. Help is greatly needed!

<h1>License</h1>

Non-commercial use, share/contribute and provide credit. <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International Public License.</a>
