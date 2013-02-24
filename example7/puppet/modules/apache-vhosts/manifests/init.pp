# == Class: apache-vhosts
#
# Adds and enables virtual hosts. Sets up /var/www symlinks.
#
class apache-vhosts {
  file { '/var/www':
    ensure => directory;
  }

  apache-vhosts::vhost { ['static-site', 'dynamic-site']: }
}
