#!/bin/sh
slugify () {
    echo "$1" | iconv -c -t ascii//TRANSLIT | sed -E 's/[~^]+//g' | sed -E 's/[^a-zA-Z0-9]+/-/g' | sed -E 's/^-+|-+$//g' | tr A-Z a-z
}

read -p "What is the plugin's name? " plugin_name

read -p "What is the plugin's description? " plugin_description

read -p "What is the plugin's URI? " plugin_uri

read -p "What is the name of the plugin's author [Highfivery LLC]? " plugin_author
plugin_author=${plugin_author:-Highfivery LLC}

read -p "What is the name of the plugin's author URI [https://www.highfivery.com]? " plugin_author_uri
plugin_author_uri=${plugin_author_uri:-https://www.highfivery.com}

read -p "What license should the plugin use [MIT]? " plugin_license
plugin_license=${plugin_license:-MIT}

read -p "What's the license URI [https://choosealicense.com/licenses/mit/]? " plugin_license_uri
plugin_license_uri=${plugin_license_uri:-https://choosealicense.com/licenses/mit/}

plugin_slug=$(slugify "$plugin_name")
read -p "What is the plugin's text domain [$plugin_slug]? " text_domain
text_domain=${text_domain:-${plugin_slug}}

read -p "What is the name of the plugin's function prefix? " function_prefix

read -p "What is the plugin's contant name? " plugin_constant

read -p "What is the plugin's package name? " package_name

echo "\n"
echo "Name: $plugin_name"
echo "Description: $plugin_description"
echo "URI: $plugin_uri"
echo "Author: $plugin_author"
echo "Author URI: $plugin_author_uri"
echo "Plugin License: $plugin_license"
echo "Text Domain: $text_domain"
echo "Function Prefix: $function_prefix"
echo "Constant: $plugin_constant"
echo "Package Name: $package_name"
echo "\n"

read -r -p "Does this all look right? [y/N] " response
case "$response" in
  [yY][eE][sS]|[yY])
    mkdir -p $text_domain
    rsync -av --exclude='.git' --exclude=$text_domain --exclude='LICENSE' --exclude='README.md' --exclude='setup.sh' . $text_domain
    cd $text_domain
    mv wordpress-plugin-starter.php "$text_domain.php"
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_NAME~$plugin_name~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_PACKAGE~$package_name~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_DESCRIPTION~$plugin_description~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_TEXT_DOMAIN~$text_domain~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_AUTHOR_URI~$plugin_author_uri~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_AUTHOR~$plugin_author~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_URI~$plugin_uri~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_CONSTANT~$plugin_constant~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~FUNCTION_PREFIX~$function_prefix~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_LICENSE_URI~$plugin_license_uri~g" {} \;
    find ./ -type f -exec sed -i '' -e "s~PLUGIN_LICENSE~$plugin_license~g" {} \;
    cd ..
    mv $text_domain ../
    ;;
  *)
    false
    ;;
esac
