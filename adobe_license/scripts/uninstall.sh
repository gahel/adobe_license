#!/bin/bash

# Remove adobe license script
rm -f "${MUNKIPATH}preflight.d/adobe_license.{sh,py}"

# Remove adobe license.txt file
rm -f "${CACHEPATH}adobe_license.{txt,plist}"
