# == Class: lighttpd
#
# Installs and configures Lighttpd.
#
class lighttpd {
  package { 'lighttpd':
      ensure  => present;
  }

  service { 'lighttpd':
    ensure  => running,
    require => Package['lighttpd'];
  }
}
