# == Class: nginx
#
# Installs and configures Nginx.
#
class nginx {
  package { 'nginx':
    ensure => present;
  }

  service { 'nginx':
    ensure  => running,
    require => Package['nginx'];
  }

  file {
    '/etc/nginx/nginx.conf':
      ensure  => present,
      source  => 'puppet:///modules/nginx/nginx.conf',
      require => Package['nginx'],
      notify  => Service['nginx'];

    '/etc/nginx/proxy_params':
      ensure  => present,
      source  => 'puppet:///modules/nginx/proxy_params',
      require => Package['nginx'],
      notify  => Service['nginx'];

    '/etc/nginx/sites-enabled/default':
      ensure  => absent,
      require => Package['nginx'],
      notify  => Service['nginx'];
  }
}
