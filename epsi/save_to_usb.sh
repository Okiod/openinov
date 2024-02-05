#!/bin/bash

# Emplacement de montage de la clé USB
USB_MOUNT="/media/usb"

# Vérifiez si la clé USB est montée
if mount | grep -q $USB_MOUNT; then
    DATE=$(date +%Y-%m-%d)
    FILENAME="data_$DATE.csv"
    cp /chemin/vers/data.csv $USB_MOUNT/$FILENAME
    echo "Fichier sauvegardé sur USB: $FILENAME"
else
    echo "Clé USB non trouvée."
fi
