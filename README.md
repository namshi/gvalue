# Gvalue: convert Google Docs to a KeyValue array

[![Build Status](https://travis-ci.org/namshi/gvalue.png?branch=master)](https://travis-ci.org/namshi/gvalue)

The aim of this library is to be able to parse a Google Spreadsheet as a simple key-value, so that you can use it
to configure your applications.

## Isn't this twisted?

> With great power comes great responsibility.

We want to be able to change the configuration of our apps in the easiest way, so we thought we should have an easily
accessible key-value storage where we would put those config values that will be used by the apps: for example, products
per page, cache lifetime, and so on and so forth.
We eventually figured out that Redis would be a very good candidate for storing our configuration.

The problem comes when you think of **how** you would update that configuration values:

* ssh into your server
* log into redis
* change a value

Even though this might sound simple to you should consider that it might be a **slow and repetitive task** and that
**you need to be a developer / sysadmin** for doing it.

This means that if your PM wants to change the cache lifetime of your homepage, the number of articles you can show per
page, he has to ask you.
Call you. Wake you up in the night. Follow you. Stalk you.

**You're doomed**.

Or are you?
By storing your config into a google doc you can simply give access to it to anyone who's responsible enough
to understand what `products per page: 30` means!
They can update the doc, invoke a URL which will use this library to convert it to a key-value array and store it in
redis and you can happily delegate tasks and require no more deployments for a change in your configuration!

## Usage

Create a Google Spreadsheet organized in two columns: the first one will represent the configuration keys while the
second one the values:

![a simple google doc](https://github.com/namshi/gvalue/blob/master/bin/images/doc.png?raw=true)

At this point you will have to publish the Google Doc to the web so that it will become available at a (sort of) public
URL:

![publish google doc](https://github.com/namshi/gvalue/blob/master/bin/images/doc-publish.png?raw=true)

Then you simply have to run the following code and get the key-value configuration out of your google doc:

```
<?php

$googleDocKey = '...' //ie. 0Au4X4OwTcvrSdG5oZkFXMXM5SUl4YVF5bDV2NmZiSmc
$gvalue       = new Namshi\Gvalue();

$configuration = $gvalue->getDocument($googleDocKey);

var_dump($configuration); // [a: b, 123: 456, ...]
```

In order to get the document key simply look at the URL of the spreadsheet, which will be something similar to
`https://docs.google.com/spreadsheet/ccc?key=0Au4X4OwTcvrSdG5oZkFXMXM5SUl4YVF5bDV2NmZiSmc#gid=0`: the key for this
document would be `0Au4X4OwTcvrSdG5oZkFXMXM5SUl4YVF5bDV2NmZiSmc`.

## Security

If you are concerned about the security implications of this technique consider the following:

* the google doc link is not public, meaning that a malicious user would have to **guess it**
* you should store public configuration in the doc (ie. products per page) and not critical information like SSH keys
or  credentials for a service

## Updating configuration values

Every time a config value is updated you should republish the doc so that changes are immediately available.

## Tests

This library is tested with PHPUnit, just run `phpunit` from the root of the repo.