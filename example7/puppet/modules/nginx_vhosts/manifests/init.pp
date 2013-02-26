# == Class: nginx_vhosts
#
# Adds and enables virtual hosts.
#
class nginx_vhosts {
  nginx_vhosts::vhost { ['dynamic-site']: }
}
