# modxmigrate
MODx Revolution Site Migration Automation Script

# Usage

1. Copy contents of this project into a separate folder (for example `migrate`) in the root folder of your project.
2. Navigate to that folder via browser.
3. Change the data you want to be changed when performing migration and click on `Migrate to this server!` to complete migration.

# What does this do?

* It recalculates the core folder path (based on default MODx configuration) and sets it for root, connectors and manager folders.
* It removes cache folder so cache needs to rebuild.
* It recreates `core/config/config.inc.php` file with recalculated paths and other specified information from the form.

# Supported MODx versions:

* MODx Revolution 2.4