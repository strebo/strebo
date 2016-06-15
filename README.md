[![Build Status](https://travis-ci.org/strebo/strebo.svg)](https://travis-ci.org/strebo/strebo) 
[![Quality Gate](http://sonarqube.it.dh-karlsruhe.de/api/badges/gate?key=strebo.net%3Astrebo)](http://sonarqube.it.dh-karlsruhe.de/overview?id=strebo.net%3Astrebo)
[![Code Climate](https://codeclimate.com/github/strebo/strebo/badges/gpa.svg)](https://codeclimate.com/github/strebo/strebo)
 [![Test Coverage](https://codeclimate.com/github/strebo/strebo/badges/coverage.svg)](https://codeclimate.com/github/strebo/strebo/coverage) [![Issue Count](https://codeclimate.com/github/strebo/strebo/badges/issue_count.svg)](https://codeclimate.com/github/strebo/strebo)

# strebo – social trend board ❤
![strebo - social trend board](/resources/logo-large-with-subtitle.png "strebo - social trend board")

## vision

Have you ever wished of a web-based application where you can see ALL the trendy stuff and all your relevant content from different social-media platforms at a glance?

Your journey will end here!

strebo is the project that we will work on, while we are in our third and fourth semester at the Cooperative State University in Karlsruhe.

Core features:
* Showing trending content (text, images, videos, …) from social media platforms
* Current implementation of: Instagram, Twitter, YouTube, SoundCloud and Bing News
* Connecting your social media accounts with strebo and show your personal relevant content from social media platforms
* Searching for content across several social media platforms
* Showing trends in single countries/regions (current Worldwide, Germany, US) or trends depending on other factors

Enjoy!

## installation with docker

Please be sure you have installed docker and you are in the root directory of our project.

Build the docker image with:

``docker build -t strebo .``

After the build process you just have to run it:

``docker run -it -p 80:80 -p 8080:8080 -p 443:443``

Et voilà:

<img src="https://strebo.files.wordpress.com/2016/06/screenshot.png" alt="screenshot"  />

<strong>Hint:</strong> The personal board for what logins are required <em>WON'T</em> work. For this you would have to need to create your own accounts and applications on several social networks. Since in our applications is set that only strebo.net is a valid request and redirect URI.

## manual installation
Please make sure you have **PHP7** (**thread-safe** version) installed and you have enabled the required extensions. An additional extension you have to download is **pthreads**. Follow the instruction of http://tzfrs.de/2014/07/fix-it-the-right-way-ssl-error-unable-to-get-local-issuer-certificate/ to enable HTTPS calls to social network APIs.

To install the required frameworks we use **Composer**. Execute the following commands in the shell in the directory of the project:

``composer install``

``composer update``

The authentification server requires **node.js**.
You can install the dependencies here with ``npm install``.

In addition there is a need of a Webserver like **Apache**.

### start

Execute the following commands in the shell:
``php start.php``
and
``node server.js``
to start the servers.

## extensions

The extensions are located in **Strebo/SocialNetworks**. If you want to add a social network please fork our project and make a pull request. It's sufficient to add a class there which inhertis from the AbstractSocialNetwork and implements the PublicInterface or PrivateInterface (or both). The new social network will be automatically and dynamically included.

## team

We are Aram Parsegyan, Fabian Retkowski and David Schreck and we are students of Applied Computer Science at the Cooperative State University in Karlsruhe.

This GitHub repository is created for the project that we will be working on in our Software Engineering course, in our third and fourth semester.
