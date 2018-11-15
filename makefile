.SILENT:
.PHONY: install
###########
# Install #
###########

## Install application
install:
	# Composer
	composer install --verbose
	# Db
	sudo mysql < dbconfig.sql
	php bin/console doctrine:database:create --if-not-exists
	php bin/console doctrine:schema:update --force
	php bin/console doctrine:fixture:load --no-interaction
	php bin/console se:ru