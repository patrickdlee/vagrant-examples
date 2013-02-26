# == Define: module
#
# Enables a Lighttpd module.
#
define lighttpd::module() {
  file { "/etc/lighttpd/conf-enabled/${name}":
    ensure  => link,
    target  => "/etc/lighttpd/conf-available/${name}",
    require => Package['lighttpd'],
    notify  => Service['lighttpd'];
  }
}
