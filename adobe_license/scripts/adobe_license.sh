#!/bin/bash   

#AdobeExpiryCheck - Grep for your encrypted Adobe serial number

AdobeExpirySN=`/usr/local/bin/AdobeExpiryCheck |grep yourencryptedserial |  awk '{print $2}'`
AdobeExpiryDate=`/usr/local/bin/AdobeExpiryCheck |grep yourencryptedserial |  awk '{print $3}'`
AdobeExpiryStatus0="0"
AdobeExpiryStatus1="1"


echo ""
echo ""
echo "Adobe License Expiry Date: $AdobeExpiryDate"
echo ""

if [[ $AdobeExpirySN -ne yourencryptedserial ]]; then
        echo "* No expiring Adobe serial ..."
        /usr/bin/defaults delete /Library/Preferences/com.yourorg.adobe_license
        /usr/bin/defaults write /Library/Preferences/com.yourorg.adobe_license AdobeExpiryStatus "$AdobeExpiryStatus0"
else
	echo "* Expiring Adobe serial :-/ ..."
	/usr/bin/defaults write /Library/Preferences/com.yourorg.adobe_license.plist AdobeExpiryDate "$AdobeExpiryDate"
	/usr/bin/defaults write /Library/Preferences/com.yourorg.adobe_license.plist AdobeExpirySN "$AdobeExpirySN"
	/usr/bin/defaults write /Library/Preferences/com.yourorg.adobe_license.plist AdobeExpiryStatus "$AdobeExpiryStatus1"

fi
