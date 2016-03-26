#!/bin/bash
echo "Installation will begin in 15 seconds."
echo "Please enter [CTRL+C] to abort the installation of FlamesPanel."
sleep 15
clear
echo "Please enter a hostname that points to the current server's IP address."
read serverhostname
sleep 3
clear
echo "===================================================="
echo "=                                                  ="
echo "=               /-------------------/              ="
echo "=              /    _______________/               ="
echo "=             /    /                               ="
echo "=            /    /______________                  ="     
echo "=           /                   /                  ="
echo "=          /    /---------------                   ="
echo "=         /    /                                   ="
echo "=        /____/                                    =" 
echo "=                                                  ="
echo "=                                                  ="
echo "=                  INSTALLING...                   ="
echo "=                                                  ="
echo "===================================================="
sleep 3
cd /tmp
chmod 111 /home
mkdir -p /home/root/public_html
chmod -R 700 /home/root
git clone https://github.com/FlamesRunner/FlamesPanel-v2.git


