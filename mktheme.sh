#!/bin/sh
mkdir -p dist

# Update version number with build timestamp
TS=`date +%y%j%H%M`
VERSION=`grep Version style.css | awk '{ print $3 }' | cut -d . -f -1,2`.$TS
sed  -i '' -e "s/Version:.*/Version:        $VERSION/" style.css

# Delete symlinks in acf-json
 find acf-json -type link -exec rm {} \;

# Creates a zip file of the theme ready to upload to WordPress
cd ..
zip wmde-$TS.zip wmde -rv \
	-x \*/.DS_Store \
	-x wmde/.babelrc \
	-x wmde/.env\* \
	-x wmde/.git\* \
	-x wmde/.nova/\* \
	-x wmde/blocks/.git\* \
	-x wmde/blocks/\*/style.scss \
	-x wmde/dist/\* \
	-x wmde/gulpfile.js \
	-x wmde/mktheme.sh \
	-x wmde/node_modules/\* \
	-x wmde/package\*.json \
	-x wmde/\*.md \
	-x wmde/\*/\*.md \
	-x wmde/src/\*
mv wmde-$TS.zip wmde/dist/
cp wmde/dist/wmde-$TS.zip wmde/dist/wmde.zip
