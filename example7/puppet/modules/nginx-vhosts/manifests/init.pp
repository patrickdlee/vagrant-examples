# == Class: nginx-vhosts
#
# Adds and enables virtual hosts.
#
class nginx-vhosts {
  nginx-vhosts::vhost { ['dynamic-site']: }
}
