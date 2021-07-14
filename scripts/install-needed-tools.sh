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
echo '--------------------------------------------';
echo '  Install sed and awk';
echo '--------------------------------------------';
sudo apt install -y sed awk;

### Install npm and nodejs
# Helps getting more development tools and the Bootstrap and popper packages.
echo '--------------------------------------------';
echo '  Install npm and nodejs';
echo '--------------------------------------------'; 
curl -sL https://deb.nodesource.com/setup_14.x | sudo -E bash - ;
sudo apt update ;
sudo apt install -y nodejs ;
sudo apt install -y build-essential ;

curl -L https://npmjs.com/install.sh | sh ;
sudo apt install -y npm ;

### 3. Install Yarn
echo '--------------------------------------------';
echo '  Install Yarn';
echo '--------------------------------------------';
sudo apt install -y yarn ;
# Install Yarn as a global by npm
sudo npm install -y -g yarn ;

### 4. Install Gulp
# Helps in managing tasks when compiling SASS/SCSS to CSS
echo '--------------------------------------------';
echo '  Install Gulp';
echo '--------------------------------------------';
sudo npm install -y gulp-cli -g ;
sudo npm install -y gulp -D ;