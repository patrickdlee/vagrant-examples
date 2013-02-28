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

node 'ex7proxy' {
  include nginx, nginx_vhosts
}

node 'ex7db' {
  include mysql
}

node 'ex7web1', 'ex7web2' {
  include apache, apache_vhosts, php
}

node 'ex7static1', 'ex7static2' {
  include lighttpd
}

node 'ex7cache' {
  include memcache
}
