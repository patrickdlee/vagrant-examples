# == Define: vhost
#
# Adds and enables an Apache virtual host
#
define apache_vhosts::vhost() {
  file {
    "/etc/apache2/sites-available/${name}":
      source  => "puppet:///modules/apache_vhosts/${name}",
      require => Package['apache2'],
      notify  => Service['apache2'];

    "/etc/apache2/sites-enabled/${name}":
      ensure => link,
      target => "/etc/apache2/sites-available/${name}",
      notify => Service['apache2'];

    "/var/www/${name}":
      ensure => link,
      target => "/vagrant/sites/${name}";
  }
}
