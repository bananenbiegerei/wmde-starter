#!/bin/sh
mkdir dist

# Update version number with build timestamp
TS=`date +%Y%m%d%H%M%S`
VERSION=`grep Version style.css | awk '{ print $3 }' | cut -d . -f -1,2`.$TS
sed  -i '' -e "s/Version:.*/Version:        $VERSION/" style.css

# Creates a zip file of the theme ready to upload to WordPress
cd ..
zip wmde-$TS.zip wmde -rv -x wmde/node_modules/\* -x wmde/package\*.json -x wmde/src/\* wmde/gulpfile.js -x wmde/.git\* -x  wmde/mktheme.sh -x wmde/acf-json_TBD/\* -x wmde/blocks.disabled/\* -x wmde/.env\* -x \*/.DS_Store -x wmde/.nova/\* -x wmde/README.md -x wmde/dist/\*
mv wmde-$TS.zip wmde/dist/
