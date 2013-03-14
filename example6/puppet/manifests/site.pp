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

node 'ex6proxy' {
  include nginx, nginx_vhosts
}

node 'ex6db' {
  include mysql
}

node 'ex6web1', 'ex6web2' {
  include apache, apache_vhosts, php
}

node 'ex6static1', 'ex6static2' {
  include lighttpd
}

node 'ex6cache' {
  include memcache
}
