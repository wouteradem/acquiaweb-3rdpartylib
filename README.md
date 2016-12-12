# Acquia Webinar: Using 3rd Party libraries

### Requirement
- `drupal console` must be installed
- http://drupalconsole.com

### Init project creation
- Create and init github repo
-  `drupal chain --file=quick-start.yml`
- Add/Commit/Push `docroot` and `quick-start.yml` to Github

### Clone the project
- `git clone https://github.com/wouteradem/acquiaweb-3rdpartylib.git`

### Module/Console Command setup 
- Go to docroot
- Create a custom Drupal module
-- `drupal generate:module`
-- `acquia_webinar_scrape`
- Create a custom Drupal Console command
-- `drupal generate:command`
- Enable the module
-- `drush en -y acquia_webinar_scrape`
- Test initial command
-- `drupal drupal acquia_webinar_scrape:goscrape`

### Download the 3rd Party library
- Go to Drupal 8 docroot 
- `composer require fabpot/goutte`
- https://github.com/FriendsOfPHP/Goutte

