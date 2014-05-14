export COMPOSER_PROCESS_TIMEOUT=1200

composer self-update
cd /vagrant
composer install
ant -propertyfile build.vagrant.properties moodle-automation-install
