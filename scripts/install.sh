#!/bin/bash

# adobe license controller
CTL="${BASEURL}index.php?/module/adobe_license/"

# Get the scripts in the proper directories
${CURL} "${CTL}get_script/adobe_license.sh" -o "${MUNKIPATH}preflight.d/adobe_license.sh"
# Make executable
chmod a+x "${MUNKIPATH}preflight.d/adobe_license.sh"

setreportpref "adobe_license" "/Library/Preferences/com.yourorg.adobe_license.plist"
