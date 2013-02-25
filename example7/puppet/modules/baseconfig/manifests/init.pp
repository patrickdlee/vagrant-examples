# == Class: baseconfig
#
# Performs initial configuration tasks for all Vagrant boxes.
#
class baseconfig {
  exec { 'apt-get update':
    command => '/usr/bin/apt-get update';
  }

  host {
    'hostmachine':
      ip => '192.168.0.1';

    'proxy':
      ip => '192.168.0.42';

    'db':
      ip => '192.168.0.43';

    'web1':
      ip => '192.168.0.44';

    'web2':
      ip => '192.168.0.45';

    'static1':
      ip => '192.168.0.46';

    'static2':
      ip => '192.168.0.47';

    'cache':
      ip => '192.168.0.48';
  }

  file {
    '/home/vagrant/.bashrc':
      owner => 'vagrant',
      group => 'vagrant',
      mode  => '0644',
      source => 'puppet:///modules/baseconfig/bashrc';
  }
}
