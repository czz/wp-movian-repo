# wp-movian-repo

Wordpress Plugin for Movian Repository Json response


## How to publish plugins

Starting with Movian 6.0 supports multiple feed of plugins. For more information how to add new feeds to Movian see this article.

Note: There is no longer a central plugin repository hosted at this site. See this article for more info

The easiest way to publish plugins is to commit each of them to a public repo at github.

See https://github.com/andoma/movian-plugin-modarchive for an example how this should look.

Then you can use the movian-repo tool found at https://github.com/czz/movian-repo to generate plugin feeds.

Currently this tool only work with github hosted plugins.


## How to install

unzip to plugins directory and activate from plugin admin page


## Where is the url of json response ?

http://example.com/wp-admin/admin-ajax.php?action=movian_repo

