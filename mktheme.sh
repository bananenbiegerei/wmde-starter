#!/bin/sh

cd ..
rm -f wmde.zip
zip wmde.zip wmde -rv -x wmde/node_modules/\* -x wmde/package\*.json -x wmde/src/\* wmde/gulpfile.js -x wmde/.git\* -x  wmde/mktheme.sh -x wmde/acf-json_TBD/\* -x wmde/blocks.disabled/\* -x wmde/.env\* -x \*/.DS_Store -x wmde/.nova/\* 
