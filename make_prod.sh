#!/usr/bin/env bash
set -e

echo "Cleaning production directory..."
rm -Rf production

git clone -b master https://github.com/Limych/penati.git production
cd production/
#composer install --no-scripts --no-interaction
ln -sf ../vendor/
#npm install
ln -sf ../node_modules/
npm run production

vendor/bin/phpunit

rm -f vendor node_modules
rm -Rf resources/assets tests .editorconfig .phpstorm.meta.php _* after.sh aliases *install.sh deploy.sh make_prod.sh package.json phpunit.xml server.php Vagrantfile webpack.mix.js

git checkout -B stable
git add --all
git commit --author="Production Bot <no@email.com>" --message="Production version"
git push --force --set-upstream https://github.com/Limych/penati.git stable

#cd ..
#rm -Rf production

echo "Done."
