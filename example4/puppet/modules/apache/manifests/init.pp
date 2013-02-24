# == Class: apache
#
# Installs packages for Apache and sets config files.
#
class apache {
  package { ['apache2', 'apache2-mpm-prefork']:
    ensure => present;
  }

  service { 'apache2':
    ensure  => running,
    require => Package['apache2'];
  }

  apache::conf { ['apache2.conf', 'envvars', 'ports.conf']: }
}
