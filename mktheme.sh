#!/bin/sh
mkdir -p dist

SLUG=$(basename "$(pwd)")

# Update version number with build timestamp
TS=`date +%y%j%H%M`
VERSION=`grep Version style.css | awk '{ print $3 }' | cut -d . -f -1,2`.$TS
sed  -i '' -e "s/Version:.*/Version:        $VERSION/" style.css

# Delete symlinks in acf-json
 find acf-json -type link -exec rm {} \;

# Creates a zip file of the theme ready to upload to WordPress
cd ..
zip $SLUG-$TS.zip $SLUG -rv \
  -x \*/.DS_Store \
  -x $SLUG/.babelrc \
  -x $SLUG/.env\* \
  -x $SLUG/.git\* \
  -x $SLUG/.nova/\* \
  -x $SLUG/blocks/.git\* \
  -x $SLUG/blocks/\*/style.scss \
  -x $SLUG/dist/\* \
  -x $SLUG/gulpfile.js \
  -x $SLUG/mktheme.sh \
  -x $SLUG/node_modules/\* \
  -x $SLUG/package\*.json \
  -x $SLUG/\*.md \
  -x $SLUG/\*/\*.md \
  -x $SLUG/src/\*
mv $SLUG-$TS.zip $SLUG/dist/
cp $SLUG/dist/$SLUG-$TS.zip $SLUG/dist/$SLUG.zip
