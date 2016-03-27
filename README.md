# FlamesPanel v2 Source Code

Great news: I just finished the installer :)

Anyways, installing FlamesPanel is very easy - all you have to do is execute the following:

    cd /usr/src
    wget https://raw.githubusercontent.com/FlamesRunner/FlamesPanel-v2/master/installers/installer.sh
    chmod 755 installer.sh
    ./installer.sh

That's all to it - here's how you can use some of the command-line utilities once you've installed FlamesPanel.

###Create an account:
   /sbin/www-createacct username password

###Terminate an account:
   /sbin/killacct username

###Change password for an user:
   /sbin/changepassword username newpassword
   
If there are any bugs, please open up an issue or if you know the fix to the problem, feel free to commit the patch :)
