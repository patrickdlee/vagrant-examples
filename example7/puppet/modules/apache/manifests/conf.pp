# == Define: conf
#
# Adds an Apache configuration file.
#
define apache::conf() {
  file { "/etc/apache2/${name}":
    source  => "puppet:///modules/apache/${name}",
    require => Package['apache2'],
    notify  => Service['apache2'];
  }
}
