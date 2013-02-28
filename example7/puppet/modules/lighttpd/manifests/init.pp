# == Class: lighttpd
#
# Installs and configures Lighttpd.
#
class lighttpd {
  package { 'lighttpd':
    ensure => present;
  }

  service { 'lighttpd':
    ensure  => running,
    require => Package['lighttpd'];
  }

  file {
    '/var/www':
      ensure => directory;
      
    '/var/www/static-site':
      ensure  => link,
      target  => '/vagrant/sites/static-site',
      require => File['/var/www'];

    '/var/www/dynamic-site':
      ensure  => link,
      target  => '/vagrant/sites/dynamic-site/public',
      require => File['/var/www'];

    '/etc/lighttpd/lighttpd.conf':
      source  => 'puppet:///modules/lighttpd/lighttpd.conf',
      require => Package['lighttpd'],
      notify  => Service['lighttpd'];
  }

  lighttpd::module { ['10-accesslog.conf']: }
}
