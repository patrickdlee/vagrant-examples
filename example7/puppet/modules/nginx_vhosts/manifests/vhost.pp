# == Define: vhost
#
# Adds and enables an Nginx virtual host
#
define nginx_vhosts::vhost() {
  file {
    "/etc/nginx/sites-available/${name}":
      ensure  => present,
      source  => "puppet:///modules/nginx_vhosts/${name}",
      require => Package['nginx'];

    "/etc/nginx/sites-enabled/${name}":
      ensure => link,
      target => "/etc/nginx/sites-available/${name}",
      notify => Service['nginx'];
  }
}
