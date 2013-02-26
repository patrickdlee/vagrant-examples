# create a new run stage to ensure certain modules are included first
stage { 'pre':
  before => Stage['main']
}

# add the baseconfig module to the new 'pre' run stage
class { 'baseconfig':
  stage => 'pre'
}

# set defaults for file ownership/permissions
File {
  owner => 'root',
  group => 'root',
  mode  => '0644',
}

# all boxes get the base config
include baseconfig

node 'proxy' {
  include nginx, nginx_vhosts
}

node 'db' {
  include mysql
}

node 'web1', 'web2' {
  include apache, apache_vhosts, php
}

node 'static1', 'static2' {
  include lighttpd
}

node 'cache' {
  include memcache
}
