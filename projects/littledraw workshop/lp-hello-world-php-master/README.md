# Little Printer Hello World Example (PHP)

This is an example publication, written in PHP. The same example can also be
seen in:

* [Python](https://github.com/bergcloud/lp-hello-world-python)
* [Ruby](https://github.com/bergcloud/lp-publication-hello-world)

This example shows how to set up and validate a form for a subscriber to
configure the publication.

Read more about this example [on the developer site](http://remote.bergcloud.com/developers/littleprinter/examples/hello_world). 

## Run it

Requires PHP >= 5.2.0.

Upload these files to your server, then you should be able to visit these URLs:

* `/edition/?lang=english&name=Phil&local_delivery_time=2013-11-11T12:20:30-08:00`
* `/icon.png`
* `/meta.json`
* `/sample/`

In addition, the `/validate_config/` URL should accept a POST request with
a field named `config` containing a string like:

    {"lang":"english","name":"Phil"}
    

----

BERG Cloud Developer documentation: http://remote.bergcloud.com/developers/

