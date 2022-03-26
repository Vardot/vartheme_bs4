# Creating Your Own Theme

After building and installing the project with the [**Varbase Project**](https://github.com/Vardot/varbase-project) template, use the create new Vartheme sub theme command. 

Before that have a look at:

* [Understanding The Vartheme Base Theme](https://docs.varbase.vardot.com/dev-docs/theme-development-with-varbase/understanding-the-vartheme-base-theme))

Learn more about Bootstrap standard build tools documentation, compile source code, run tests, and more.
[https://getbootstrap.com/docs/4.0/getting-started/build-tools/](https://getbootstrap.com/docs/4.0/getting-started/build-tools/)

## Install Needed Tools Command

1. Open a terminal window.
2. Change directory in the terminal to `docroot/themes/contrib/vartheme_bs4/scripts` in the project.
3. Run the `bash ./install-needed-tools.sh`
4. Follow with the list of instructions.

```
cd PROJECT_DIR_NAME/docroot/themes/contrib/vartheme_bs4/scripts
bash ./install-needed-tools.sh
```

## Install Needed Tools Manually

### **1. Install** [**sed**](https://www.gnu.org/software/sed/manual/sed.html) **and** [**gawk**](https://www.gnu.org/software/gawk/manual/gawk.html)

Helps with string replace and re-naming files.

```
sudo apt install -y sed gawk;
```

### **2. Install npm** and [**nodejs**](https://nodejs.org/en/)

 Helps getting more development tools and the **Bootstrap** and **popper** packages. 

```
curl -sL https://deb.nodesource.com/setup_17.x | sudo -E bash -
sudo apt update
sudo apt install nodejs
sudo apt install build-essential

curl -L https://npmjs.com/install.sh | sudo -E bash -
sudo apt update
sudo apt install npm
```

### 3. Install [Yarn](https://yarnpkg.com/getting-started)

```
sudo apt install yarn
```

Install **Yarn** as a global by **npm**

```
sudo npm install -g yarn
```

### **4. Install** [**Gulp**](https://gulpjs.com/)

Helps in managing tasks when compiling SASS/SCSS to CSS

```
sudo npm install gulp-cli -g
sudo npm install gulp -D
```

## Create new Vartheme BS4 sub theme

### Create with Bash script

1. Open a terminal to run commands
2. Change directory in the terminal to `docroot/themes/contrib/vartheme_bs4/scripts`
3. Run the `create-new-vartheme-bs4.sh "THEME_NAME"`. Change the `THEME_NAME` to the project name or any selected theme name.

```
cd PROJECT_DIR_NAME/docroot/themes/contrib/vartheme_bs4/scripts
bash ./create-new-vartheme-bs4.sh "THEME_NAME"
```

### Create with **Yarn**

```
cd PROJECT_DIR_NAME/docroot/themes/contrib/vartheme_bs4
yarn theme:create-sub-theme "THEME_NAME"
```

### 

## Example mythem for mysite

If a **Varbase** site named _"mysite"_  was built using the following command:

```
cd /var/www/html
composer create-project Vardot/varbase-project:~9 mysite --no-dev --no-interaction
```

The folder _mysite_  for the project is located at _"/var/www/html/mysite"_

Change directory to `docroot/themes/contrib/vartheme_bs4/scripts`

```
cd /var/www/html/mysite/docroot/themes/contrib/vartheme_bs4/scripts
```

Run the following `bash`command to create a custom theme named "_mytheme"_ 

```
bash ./create-new-vartheme-bs4.sh "mytheme"
```

The new theme will be located at _"/var/www/html/mysite/docroot/themes/custom/mytheme"_

When the finishes the following message will show up in the terminal

```
---------------------------------------------------------------------------
   The new Vartheme BS4 Sub-Theme were created at "/var/www/html/mysite/docroot/themes/custom/mytheme :)" 
---------------------------------------------------------------------------
```

## Activate the new theme

* Go to Appearance in the administration of the **Varbase** site.
* Search for the name of the newly generated theme
* Click on Install and set as default.
* Navigate to the home page to check if the new theme is the default theme.

## Initiation commands

First step to do after creating a new theme.

Change directory to the new theme in the terminal then run only `gulp` without arguments.

Run this command ones after creating a new sub theme

Run it again ones after updating the **Bootstrap 4** library with `yarn install`

```
cd PROJECT_DIR_NAME/docroot/themes/custom/THEME_NAME
gulp
[10:55:40] Using gulpfile PROJECT_DIR_NAME/docroot/themes/custom/THEME_NAME/gulpfile.js
[10:55:40] Starting 'default'...
[10:55:40] Starting 'compile'...
[10:55:42] Finished 'compile' after 2.44 s
[10:55:42] Starting 'move_bootstrap_js_files'...
[10:55:43] Finished 'move_bootstrap_js_files' after 18 ms
[10:55:43] Starting 'move_popper_js_files'...
[10:55:43] Finished 'move_popper_js_files' after 3.89 ms
[10:55:43] Starting 'watch'...
```

or with **Yarn**

```
yarn theme:init
```

## Compiling SCSS to CSS

* For example change the color value for the primary color in `scss/bootstrap-variables.scss`   file to test compiling SASS files to CSS

Then run `gulp compile` ones to compile every time the SCSS source changes.

```
cd PROJECT_DIR_NAME/docroot/themes/custom/THEME_NAME
gulp compile
[11:22:30] Using gulpfile PROJECT_DIR_NAME/docroot/themes/custom/THEME_NAME/gulpfile.js
[11:22:30] Starting 'compile'...
[11:22:33] Finished 'compile' after 2.54 s
```

or with **Yarn**

```
yarn theme:build
```

## Watching SCSS changes

Increase maximum watched SASS files by

```
echo fs.inotify.max_user_watches=524288
 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p
```

Run `gulp watch` to keep watching for changes. This command will auto compile on each save of changes for SCSS files.

```
cd PROJECT_DIR_NAME/docroot/themes/custom/THEME_NAME
gulp watch
[11:25:53] Using gulpfile PROJECT_DIR_NAME/docroot/themes/custom/THEME_NAME/gulpfile.js
[11:25:53] Starting 'watch'...
```

or with **Yarn**

```
yarn theme:watch
```

## Cloning a project

On the state of working in a team in a project, the created theme could be don by other member of the team.

When the theme get committed by git for example, the `node_modules` folder will not be committed. As it is listed in the `.gitignore` file.

After cloning a project with a Vartheme Sub theme.

Run the following commands to get all development tools

```
cd PROJECT_DIR_NAME/docroot/themes/custom/THEME_NAME
yarn install
gulp
```
