#!/bin/usr/env bash

################################################################################
## Create new Vartheme BS4 Sub-Theme.
################################################################################
##
## Quick tip on how to use this script command file.
##
## By Bash:
## -----------------------------------------------------------------------------
## cd PROJECT_DIR_NAME/docroot/themes/contrib/vartheme_bs4/scripts
## bash ./install-needed-tools.sh
##------------------------------------------------------------------------------
##
##
################################################################################

### 1. Install sed and awk
# Helps with string replace and re-naming files.
echo '                                            ';
echo '--------------------------------------------';
echo '  Install sed and gawk';
echo '--------------------------------------------';
echo '                                            ';
sudo apt install -y sed gawk;

### Install npm and nodejs
# Helps getting more development tools and the Bootstrap and popper packages.
echo '                                            ';
echo '--------------------------------------------';
echo '  Install npm and nodejs';
echo '--------------------------------------------';
echo '                                            ';
curl -sL https://deb.nodesource.com/setup_16.x | sudo -E bash - ;
sudo apt update ;
sudo apt install -y nodejs ;
sudo apt install -y build-essential ;

curl -L https://npmjs.com/install.sh | sudo -E bash - ;
sudo apt install -y npm ;

### 3. Install Yarn
echo '                                            ';
echo '--------------------------------------------';
echo '  Install Yarn';
echo '--------------------------------------------';
echo '                                            ';
sudo apt install -y yarn ;
# Install Yarn as a global by npm
sudo npm install -y -g yarn ;

### 4. Install Gulp
# Helps in managing tasks when compiling SASS/SCSS to CSS
echo '                                            ';
echo '--------------------------------------------';
echo '  Install Gulp';
echo '--------------------------------------------';
echo '                                            ';
sudo npm install -y gulp-cli -g ;
sudo npm install -y gulp -D ;