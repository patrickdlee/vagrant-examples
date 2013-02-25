# == Class: memcache
#
# Installs Memcached. No configuration needed.
#
class memcache {
  package { 'memcached':
    ensure => present;
  }

  service { 'memcached':
    ensure  => running,
    require => Package['memcached'];
  }
}
