#!/usr/bin/env bash
set -e

rm -Rf production

git clone -b master https://github.com/Limych/penati.git production
cd production/
composer install --no-scripts --no-interaction
npm install
npm run production

phpunit

rm -Rf resources/assets tests .editorconfig .phpstorm.meta.php _* after.sh aliases *install.sh make_prod.sh package.json phpunit.xml server.php Vagrantfile webpack.mix.js

git checkout -B stable
git add --all
git commit --author="Production Bot <no@email.com>" --message="Production version"
git push --set-upstream https://github.com/Limych/penati.git stable

#cd ..
#rm -Rf production
