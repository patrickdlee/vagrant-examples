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

  file { '/etc/lighttpd/lighttpd.conf':
    source  => 'puppet:///modules/lighttpd/lighttpd.conf',
    require => Package['lighttpd'],
    notify  => Service['lighttpd'];
  }
}
