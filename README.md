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

The problem comes when you think of **how** you would update that configuration values: ssh into your server, log into
redis, change a value; even though this might sound simple to you consider the following:

* it might be a slow and repetitive task
* you have to be a developer for doing that

Meaning that if your PM wants to change the cache lifetime of your homepage, the number of articles you can show per page,
he has to ask you. Call you. Wake you up in the night. Follow you. Stalk you.

You're doomed.

Or are you? By storing your config into a google doc you can simply give access to it to anyone who's responsible enough
to understand what `products per page: 30` means! They can update the doc, invoke a URL which will use this library
to convert it to a key-value array and store it in redis and you can happily delegate tasks and require no more
deployments for a change in your configuration!

## Usage

![a simple google doc](https://github.com/namshi/gvalue/blob/master/bin/images/doc.png?raw=true)


TBD